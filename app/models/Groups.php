<?php


class Groups extends Eloquent {

    protected $table = 'group';

    public function groupMember()
    {
        return $this->hasMany('GroupMembers', 'group_id', 'id');
    } 

    public function memberAction()
    {
        return $this->hasMany('MemberActions', 'group_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('Postss', 'group_id', 'id');
    }
    public static function countNews()
    {
        $weekback = date('Y-m-d H:I:s', time() + (60 * 60 * 24 * -3)); 
        $number = Groups::where('created_at','>=',$weekback)
                        ->get()
                        ->count();
        return $number;     
    }

    public static function listNew($number)
    {
    	$groups = new Groups;

    	$datas = $groups->where('group.privacy','public')
        ->with('groupMember','memberAction','posts.image')  
    	->orderBy('group.created_at','desc')
    	->take($number)
        ->get()
        ->toArray() ;

        foreach ($datas as $key => $value) {
            $datas[$key]['group_member'] = count($value['group_member']); 
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

    	return $datas ;
    }

    public static function detail($id)
    {
        $groups = new Groups;

        $datas = $groups->where('group.id',$id)
        ->with('groupMember','memberAction','posts.image','posts.memberAction','posts.image.memberAction')  
        ->get();

        if (!count($datas)) {
            return 0;
        } else{
            $datas = $datas->toArray();
            $datas = $datas[0];
        }

        $datas['group_member'] = count($datas['group_member']); 
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
        $groups = new Groups;

        $datas = $groups->where('group.privacy','public')
        ->with('groupMember','memberAction','posts.image')  
        ->orderBy('group.created_at','desc')
        ->skip(28)
        ->take($number)
        ->get()
        ->toArray() ; 

        foreach ($datas as $key => $value) {
            $datas[$key]['group_member'] = count($value['group_member']); 
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