<?php
class ListController extends BaseController {

    public function index()
    {
        $group_news = Groups::listNew(6);
        $user_post_news = Postss::listUserNew(6);
        $service_news = Services::listNew(6);
        return View::make('list.index',array(
                                        'group_news'=>$group_news,                    
                                        'user_post_news'=>$user_post_news,                    
                                        'service_news'=>$service_news                    
                                        ));
    }
    public function groupNews()
    {
        $group_news = Groups::listNew(36);
        return View::make('list.group-news',array(
                                        'group_news'=>$group_news                    
                                        ));
    }

    public function serviceNews()
    {
        $service_news = Services::listNew(36);
        return View::make('list.service-news',array(
                                        'service_news'=>$service_news                    
                                        ));
    }

    public function postNews()
    {
        $user_post_news = Postss::listUserNew(36);
        return View::make('list.post-news',array(
                                        'user_post_news'=>$user_post_news                    
                                        ));
    }
}