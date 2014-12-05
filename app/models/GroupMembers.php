<?php


class GroupMembers extends Eloquent {

    protected $table = 'group_member';

    public function group()
  	{
  		return $this->belongsTo('Groups', "group_id", "id");
  	}

    public static function myGroups($user_id)
    {
        $datas = GroupMembers::where('office','admin')
        					->where('user_id',$user_id)
        					->with('group')
                        	->get();
        if (count($datas)) {
   			return $datas->toArray();
   		} else {
   			return array();
   		}
    }

    public static function joinGroups($user_id)
    {
        $datas = GroupMembers::where('office','!=','admin')
        					->where('user_id',$user_id)
        					->with('group')
                        	->get();
        if (count($datas)) {
   			return $datas->toArray();
   		} else {
   			return array();
   		}
    }
}