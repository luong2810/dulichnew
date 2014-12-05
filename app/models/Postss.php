<?php


class Postss extends Eloquent {

    protected $table = 'posts';

    public function image()
    {
        return $this->hasMany('Images', 'posts_id', 'id');
    }

 	public function memberAction()
    {
        return $this->hasMany('MemberActions', 'posts_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany('Comments', 'posts_id', 'id');
    }

    public static function countNews()
    {
        $weekback = date('Y-m-d H:I:s', time() + (60 * 60 * 24 * -3)); 
        $number = Postss::where('created_at','>=',$weekback)
                        ->get()
                        ->count();
        return $number;     
    }

    public static function listUserNew($number)
    {
    	$postss = new Postss;

    	$datas = $postss->where('posts.type_posts','user')
        ->with('image','memberAction')  
    	->orderBy('posts.created_at','desc')
    	->take($number)
        ->get()
        ->toArray() ;

        foreach ($datas as $key => $value) {
        	$datas[$key]['member_action']['share']=0;
            $datas[$key]['member_action']['upVote']=0;
            $datas[$key]['member_action']['downVote']=0;
            
            foreach (array_pluck($value['member_action'],'type_action') as $subKey => $subValue) {
                $datas[$key]['member_action'][$subValue]++;
                unset($datas[$key]['member_action'][$subKey]);
            }

            foreach ($value['image'] as $subKeyI => $subValueI) {
                $datas[$key]['image'][$subKeyI]=$subValueI['link'];
            }
        }

    	return $datas ;
    }

    public static function detail($pId)
    {
        $datas = Postss::where('id',$pId)
                       ->with('memberAction','image','image.memberAction')
                       ->get()
                       ->toArray(); 
        $datas = $datas[0];

        $datas['member_action']['share']=0;
        $datas['member_action']['upVote']=0;
        $datas['member_action']['downVote']=0;
        
        foreach (array_pluck($datas['member_action'],'type_action') as $subKey => $subValue) {
             if ($subValue) {
                $datas['member_action'][$subValue]++;
                unset($datas['member_action'][$subKey]);
             }
        }

        foreach ($datas['image'] as $subKeyI => $subValueI) {
            $datas['image'][$subKeyI]['member_action']['share']=0;
            $datas['image'][$subKeyI]['member_action']['upVote']=0;
            $datas['image'][$subKeyI]['member_action']['downVote']=0;
            foreach (array_pluck($subValueI['member_action'],'type_action') as $subKey => $subValue) {
                 if ($subValue) {
                    $datas['image'][$subKeyI]['member_action'][$subValue]++;
                    unset($datas['image'][$subKeyI]['member_action'][$subKey]);
                 }
            }
        }
        return $datas ;
    }

    public static function comments($pId)
    {
        $datas = Comments::where('comment.posts_id',$pId)
                        ->with('memberAccount','memberAction')
                        ->orderBy('comment.created_at','desc')
                        ->get();
        
        if (!count($datas)) {
            return array();
        }          

        $datas = $datas->toArray();
        
        foreach ($datas as $key => $value) {
            $datas[$value['id']]['value'] = $value;
            if ($value['reply_of_id']) {
                $datas[$value['reply_of_id']]['reply'][]=$value['id'];   
            }
            unset($datas[$key]);          
        } 

        $result = array();

        foreach ($datas as $keyC => $valueC) {
            if(!isset($result[$keyC])&&!$valueC['value']['reply_of_id']){
                $result[$keyC]['value']=$valueC['value'];
                $result[$keyC]['level']=0;
            }
            if (isset($valueC['reply'])&&!$valueC['value']['reply_of_id']) {
                $tmp = Postss::showComments($datas,$result,$keyC,0);
                foreach ($tmp as $keyTmp => $valueTmp) {
                        $result[$keyTmp]=$tmp[$keyTmp];
                }
            } 
        }

        foreach ($result as $key => $value) {
            $result[$key]['value']['member_action']['share']=0;
            $result[$key]['value']['member_action']['upVote']=0;
            $result[$key]['value']['member_action']['downVote']=0;
            
            foreach (array_pluck($value['value']['member_action'],'type_action') as $subKey => $subValue) {
                if ($subValue) {
                    $result[$key]['value']['member_action'][$subValue]++;
                }
                unset($result[$key]['value']['member_action'][$subKey]);
            }

        }
        return $result;
    }

    public static function showComments($datas,$result,$pId,$level)
    {
        $result[$pId]['value']=$datas[$pId]['value'];
        $result[$pId]['level']=$level;

        if (!isset($datas[$pId]['reply'])) {
            return $result;
        }
        $tmp[$pId] = $result[$pId];
        foreach ($datas[$pId]['reply'] as $key => $value) {
            $tmp = Postss::showComments($datas,$result,$value,$level+1);
            foreach ($tmp as $keyC => $valueC) {
                $result[$keyC] = $valueC;
            }
        }
        return $result;
    }

    public static function refers($number)
    {
        $datas = Postss::orderBy('posts.created_at','asc')
                        ->with('memberAction','image')
                        ->take($number)
                        ->get()
                        ->toArray() ; 
        foreach ($datas as $key => $value) {
            $datas[$key]['member_action']['share']=0;
            $datas[$key]['member_action']['upVote']=0;
            $datas[$key]['member_action']['downVote']=0;
            
            foreach (array_pluck($value['member_action'],'type_action') as $subKey => $subValue) {
                if ($subValue) {
                    $datas[$key]['member_action'][$subValue]++;
                }
                unset($datas[$key]['member_action'][$subKey]);
            }

        }

        return $datas;
    }   

}