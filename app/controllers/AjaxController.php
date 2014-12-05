<?php
class AjaxController extends BaseController {

    public function postSignin()
    {
        $userid = Input::get('userid');
        $password = Input::get('password');

        $check = MemberAccounts::signin($userid,$password);
        if (count($check)) {
            $user = $check->toArray();
            $user = $user[0];
            Session::put('user',$user);
            return 'true';
        } else {
            return 'false';       
        }
    }

    public static function getSignout()
    {
        Session::forget('user');
        return 'true';
    }

    public static function postReply()
    {
        $user = Session::get('user');

        $new_reply = new Comments;

        $data_padding = Input::get('data-padding');

        $new_reply->content = Input::get('content');
        $new_reply->user_id = $user['id'];
        $new_reply->reply_of_id = Input::get('data-id');
        $new_reply->posts_id = Input::get('data-post-id');
        $new_reply->save();
        $new_reply = $new_reply->toArray();

        return View::make('detail.reply',array(
                                        'user'=>$user,                    
                                        'new_reply'=>$new_reply,
                                        'data_padding'=>$data_padding,
                                        ));
    }

    public static function postComment()
    {
        $user = Session::get('user');

        $new_comment = new Comments;

        $new_comment->content = Input::get('content');
        $new_comment->user_id = $user['id'];
        $new_comment->posts_id = Input::get('data-post-id');
        $new_comment->save();
        $new_comment = $new_comment->toArray();

        return View::make('detail.comment',array(
                                        'user'=>$user,                    
                                        'new_comment'=>$new_comment
                                        ));
    }

    public static function postDangki()
    {
        $new_member = new MemberAccounts;
        $new_member->user_name = Input::get('userid');
        $new_member->full_name = Input::get('name');
        $new_member->email = Input::get('email');
        $new_member->password = Input::get('password');
        if (Input::get('typemember')=='Thành Viên') {
            $new_member->type_member='member';
        } else{
            $new_member->type_member='trademark';
        }
        $new_member->save();
        $user = MemberAccounts::find($new_member->id)->toArray();
        Session::put('user',$user);
    }

    public static function postCreateGroup()
    {
        $user = Session::get('user');
        $group = new Groups;
        $group_member = new GroupMembers;

        $group->group_name = Input::get('group-name');
        $group->description = Input::get('description');
        $group->save();

        $group_member->office = 'admin';
        $group_member->status = 'joined';
        $group_member->user_id = $user['id'];
        $group_member->group_id = $group->id;
        $group_member->save();

        return url('group/'.$group->id);
    }

    public static function postCreatePost()
    {
        var_dump(Input::all());
    }

    public static function postAction()
    {
        $user = Session::get('user');
        if(Input::get('data-action')=='register'){
            $new_apply = new GroupMembers;
            $new_apply->office = 'register';
            $new_apply->status = 'wait';
            $new_apply->group_id = Input::get('data-id');
            $new_apply->user_id = $user['id'];
            $new_apply->save();
        } else {
            $check = MemberActions::where('user_id',$user['id'])
                                ->where(Input::get('data-type'),Input::get('data-id'))
                                ->where('type_action',Input::get('data-action'))
                                ->get()
                                ->count();
            if ($check) {
                return 'false';
            }

            $new_action = new MemberActions;
            $new_action->type_action = Input::get('data-action');
            switch (Input::get('data-type')) {
                case 'group_id':
                    $new_action->group_id = Input::get('data-id');
                    break;
                case 'posts_id':
                    $new_action->posts_id = Input::get('data-id');
                    break;
                case 'comment_id':
                    $new_action->comment_id = Input::get('data-id');
                    break;
                case 'service_id':
                    $new_action->service_id = Input::get('data-id');
                    break;
                
                default:
                    # code...
                    break;
            }
            $new_action->user_id = $user['id'];
            $new_action->save();
        }
        return 'true';
    }
}