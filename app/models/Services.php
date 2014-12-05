<?php


class Services extends Eloquent {

    protected $table = 'service';

    public function memberAction()
    {
        return $this->hasMany('MemberActions', 'service_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('Postss', 'service_id', 'id');
    }

    public static function listNew($number)
    {
    	$services = new Services;

    	$datas = $services->with('memberAction','posts.image')  
    	->orderBy('service.created_at','desc')
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

            foreach ($datas[$key]['posts'] as $suKkeyP => $subValueP) {
                foreach ($subValueP['image'] as $subKeyI => $subValueI) {
                    if($subValueI['privacy']=='public'){
                        $datas[$key]['image'][]=$subValueI['link'];
                    }
                }
            }

            unset($datas[$key]['posts']);
        }

    	return $datas ;
    }

    public static function countNews()
    {
        $weekback = date('Y-m-d H:I:s', time() + (60 * 60 * 24 * -3)); 
        $number = Services::where('created_at','>=',$weekback)
                        ->get()
                        ->count();
        return $number;     
    }

        public static function detail($id)
    {
        $groups = new Services;

        $datas = $groups->where('service.id',$id)
        ->with('memberAction','posts.image','posts.memberAction','posts.image.memberAction')  
        ->get();

        if (!count($datas)) {
            return 0;
        } else{
            $datas = $datas->toArray();
            $datas = $datas[0];
        }

        $datas['member_action']['share']=0;
        $datas['member_action']['upVote']=0;
        $datas['member_action']['downVote']=0;
        
        foreach (array_pluck($datas['member_action'],'type_action') as $subKey => $subValue) {
             if ($subValue) {
                $datas['member_action'][$subValue]++;
                unset($datas['member_action'][$subKey]);
             }
        }

        foreach ($datas['posts'] as $subKeyP => $subValueP) {

            $datas['posts'][$subKeyP]['member_action']['share']=0;
            $datas['posts'][$subKeyP]['member_action']['upVote']=0;
            $datas['posts'][$subKeyP]['member_action']['downVote']=0;
            
            foreach (array_pluck($datas['posts'][$subKeyP]['member_action'],'type_action') as $subKey => $subValue) {
                 if ($subValue) {
                    $datas['posts'][$subKeyP]['member_action'][$subValue]++;
                    unset($datas['posts'][$subKeyP]['member_action'][$subKey]);
                 }
            }

            foreach ($subValueP['image'] as $subKeyI => $subValueI) {
                $datas['posts'][$subKeyP]['image'][$subKeyI]['member_action']['share']=0;
                $datas['posts'][$subKeyP]['image'][$subKeyI]['member_action']['upVote']=0;
                $datas['posts'][$subKeyP]['image'][$subKeyI]['member_action']['downVote']=0;
                foreach (array_pluck($subValueI['member_action'],'type_action') as $subKey => $subValue) {
                     if ($subValue) {
                        $datas['posts'][$subKeyP]['image'][$subKeyI]['member_action'][$subValue]++;
                        unset($datas['posts'][$subKeyP]['image'][$subKeyI]['member_action'][$subKey]);
                     }
                }
            }
        }

        return $datas ;
    }

    public static function refers($number)
    {
        $groups = new Services;

        $datas = $groups->with('memberAction','posts.image')  
        ->orderBy('service.created_at','desc')
        ->skip(28)
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

            foreach ($datas[$key]['posts'] as $suKkeyP => $subValueP) {
                foreach ($subValueP['image'] as $subKeyI => $subValueI) {
                    if($subValueI['privacy']=='public'){
                        $datas[$key]['image'][]=$subValueI['link'];
                    }
                }
            }

            unset($datas[$key]['posts']);
        }

        return $datas;
    }
}