<?php 
  if (Session::has('user')) {
    $user = Session::get('user');
    $avatar = $user['avatar'];
    $user_name = $user['user_name'];

    $check = true;
  } else{
    $avatar = 'default.jpg';
    $user_name = 'User name';
    $check = false; 
  }

 ?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{url('img/avarta')}}/{{$avatar}}" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>Hi, {{$user_name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
<!--
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
          <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      @if($check)
      <li  class="active" >
        <div class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#create-group" >Tạo nhóm</button>
            <button type="button" class="btn btn-default" >Dịch Vụ</button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#create-post">Post</button>
        </div>
      </li>
      @endif
      <li  class="active" >
        <a href="{{ url('/group-news') }}">
          <i class="fa fa-users"></i> <span>Nhóm mới thành lập</span>
          <span style="float: right;padding-right: 15px;">{{Session::get('group-count-news')}}</span>
        </a>
      </li>

      <li  class="active" >
        <a href="{{ url('/service-news') }}">
          <i class="fa fa-map-marker"></i> <span>Dịch vụ mới cung cấp</span>
          <span style="float: right;padding-right: 15px;">{{Session::get('service-count-news')}}</span>
        </a>
      </li>
      <li  class="active" >
        <a href="{{ url('/post-news') }}">
          <i class="fa fa-tags"></i> <span>Bài chia sẻ mới</span>
          <span style="float: right;padding-right: 15px;">{{Session::get('post-count-news')}}</span>
        </a>
      </li>
      
      @if($check)
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-table"></i>
                <span>Nhóm của tôi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @foreach(Session::get('my-groups') as $key => $value)
                    <li><a href="{{url('/group')}}/{{$value['group_id']}}" title="{{$value['group']['group_name']}}">
                      <i class="fa fa-angle-double-right" >
                    </i>
                    @if(strlen($value['group']['group_name'])>28)
                    {{substr($value['group']['group_name'],0,28).' ...'}}
                    @else
                    {{$value['group']['group_name']}}
                    @endif
                      </a> 
                    </li>
                @endforeach
                <!-- <li><a href="link"><i class="fa fa-angle-double-right"></i>Muối Biển<span style="float: right;padding-right: 15px;">3</span></a>   </li> -->
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-table"></i>
                <span>Nhóm đã tham gia</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @foreach(Session::get('join-groups') as $key => $value)
                    <li><a href="{{url('/group')}}/{{$value['group_id']}}" title="{{$value['group']['group_name']}}">
                      <i class="fa fa-angle-double-right" >
                    </i>
                    @if(strlen($value['group']['group_name'])>28)
                    {{substr($value['group']['group_name'],0,28).' ...'}}
                    @else
                    {{$value['group']['group_name']}}
                    @endif
                      </a> 
                    </li>
                @endforeach
                <!-- <li><a href="link"><i class="fa fa-angle-double-right"></i>36 phố phường<span style="float: right;padding-right: 15px;">3</span></a>   </li> -->
              </ul>
            </li>      

             <li class="treeview active">
              <a href="#">
                <i class="fa fa-table"></i>
                <span>Dịch vụ yêu thích</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @foreach(Session::get('like-services') as $key => $value)
                   <li><a href="{{url('/service')}}/{{$value['service_id']}}" title="{{$value['service']['service_name']}}">
                      <i class="fa fa-angle-double-right" >
                    </i>
                    @if(strlen($value['service']['service_name'])>28)
                    {{substr($value['service']['service_name'],0,28).' ...'}}
                    @else
                    {{$value['service']['service_name']}}
                    @endif
                      </a> 
                    </li>
                @endforeach
                <!-- <li><a href="link"><i class="fa fa-angle-double-right"></i>Củi trại<span style="float: right;padding-right: 15px;">20+</span></a>  </li> -->
              </ul>
            </li>
        @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
