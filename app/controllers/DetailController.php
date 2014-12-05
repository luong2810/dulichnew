<?php
class DetailController extends BaseController {

    public function group($id)
    {
        $group = Groups::detail($id);
        if (!$group) {
            return 'Error: Not found group';
        }
        $group_refers = Groups::refers(8);
        $my_action['upVote'] = 0;
        $my_action['downVote'] = 0;
        $my_action['share'] = 0;
        $my_action['register'] = 0;

        if (Session::has('user')) {
            $user = Session::get('user');
            $my_action = MemberActions::actionGroup($user['id'],$id);
        }
        return View::make('detail.group',array(
                                        'group'=>$group,                    
                                        'my_action'=>$my_action,                    
                                        'group_refers'=>$group_refers                    
                                        ));
    }

    public function service($id)
    {
        $service = Services::detail($id);

        if (!$service) {
            return 'Error: Not found service';
        }

        $service_refers = Services::refers(8);
        $my_action['upVote'] = 0;
        $my_action['downVote'] = 0;
        $my_action['share'] = 0;

        if (Session::has('user')) {
            $user = Session::get('user');
            $my_action = MemberActions::actionService($user['id'],$id);
        }
        // var_dump($my_action); exit();
        return View::make('detail.service',array(
                                        'service'=>$service,                    
                                        'my_action'=>$my_action,                    
                                        'service_refers'=>$service_refers                    
                                        ));
    }

    public function posts($pId)
    {
        $check = Postss::find($pId);
        if (!$check) {
            return 'Error: Not found group';
        }

        $posts = Postss::detail($pId);
        $posts_comments = Postss::comments($pId);

        $posts_refers = Postss::refers(8);

        // var_dump($posts_comments); exit();
        $my_action['upVote'] = 0;
        $my_action['downVote'] = 0;
        $my_action['share'] = 0;

        if (Session::has('user')) {
            $user = Session::get('user');
            $my_action = MemberActions::actionPost($user['id'],$pId);
        }

       return View::make('detail.posts',array(
                                        'posts'=>$posts,
                                        'my_action'=>$my_action,
                                        'posts_comments'=>$posts_comments,                  
                                        'posts_refers'=>$posts_refers                    
                                        ));
       
    }

}