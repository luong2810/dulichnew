<?php


class MemberActions extends Eloquent {

    protected $table = 'member_action';

    public function service()
	{
		return $this->belongsTo('Services', "service_id", "id");
	}

    public static function likeServices($user_id)
    {
    	$datas = MemberActions::where('type_action','upVote')
        					->where('user_id',$user_id)
        					->where('service_id','<>',0)
        					->with('service')
                        	->get();
        if (count($datas)) {
   			return $datas->toArray();
   		} else {
   			return array();
   		}
    }

    public static function actionGroup($user_id,$group_id)
    {
      $datas['upVote'] = MemberActions::where('type_action','upVote')
                        ->where('user_id',$user_id)
                        ->where('group_id',$group_id)
                        ->get()
                        ->count();
      $datas['downVote'] = MemberActions::where('type_action','downVote')
                        ->where('user_id',$user_id)
                        ->where('group_id',$group_id)
                        ->get()
                        ->count();
      $datas['share'] = MemberActions::where('type_action','share')
                        ->where('user_id',$user_id)
                        ->where('group_id',$group_id)
                        ->get()
                        ->count();
      $datas['register'] = GroupMembers::where('user_id',$user_id)
                        ->where('group_id',$group_id)
                        ->get()
                        ->count();
      return $datas;
    }

    public static function actionService($user_id,$service_id)
    {
      $datas['upVote'] = MemberActions::where('type_action','upVote')
                        ->where('user_id',$user_id)
                        ->where('service_id',$service_id)
                        ->get()
                        ->count();
      $datas['downVote'] = MemberActions::where('type_action','downVote')
                        ->where('user_id',$user_id)
                        ->where('service_id',$service_id)
                        ->get()
                        ->count();
      $datas['share'] = MemberActions::where('type_action','share')
                        ->where('user_id',$user_id)
                        ->where('service_id',$service_id)
                        ->get()
                        ->count();
      return $datas;
    }


    public static function actionPost($user_id,$posts_id)
    {
      $datas['upVote'] = MemberActions::where('type_action','upVote')
                        ->where('user_id',$user_id)
                        ->where('posts_id',$posts_id)
                        ->get()
                        ->count();
      $datas['downVote'] = MemberActions::where('type_action','downVote')
                        ->where('user_id',$user_id)
                        ->where('posts_id',$posts_id)
                        ->get()
                        ->count();
      $datas['share'] = MemberActions::where('type_action','share')
                        ->where('user_id',$user_id)
                        ->where('posts_id',$posts_id)
                        ->get()
                        ->count();
      return $datas;
    }
}