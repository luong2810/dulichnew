@extends('layouts.application')

@section('content')
  <div class="row">
      <div class="col-md-8">

        <div class="callout callout-info">
            <h4>{{$service['service_name']}}</h4>
            <p>{{$service['description']}}</p>
            <button class="btn  btn-sm btn-action {{$my_action['upVote']?'btn-actioned':'btn-success'}}" data-id="{{$service['id']}}" data-type="service_id" data-action="upVote"> <span class="action-number">{{$service['member_action']['upVote']}} </span><i class="fa fa-fw fa-thumbs-o-up"></i> Up Vote</button>
            <button class="btn  btn-sm btn-action {{$my_action['downVote']?'btn-actioned':'btn-success'}}" data-id="{{$service['id']}}" data-type="service_id" data-action="downVote"> <span class="action-number">{{$service['member_action']['downVote']}}</span> <i class="fa fa-fw fa-thumbs-o-down"></i> Down Vote</button>
            <button class="btn  btn-sm btn-action {{$my_action['share']?'btn-actioned':'btn-success'}}" data-id="{{$service['id']}}" data-type="service_id" data-action="share"> <span class="action-number">{{$service['member_action']['share']}} </span><i class="fa fa-fw fa-share-square-o"></i> Share</button>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">
                    <!-- timeline time label -->
                      @foreach($service['posts'] as $key => $value)
                          <li class="time-label">
                              <span class="bg-red">
                                  {{$value['created_at']}}
                              </span>
                          </li>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <li>
                            <i class="fa  fa-pencil-square-o bg-aqua"></i>
                              <div class="timeline-item">
                                  <span class="time">đăng bởi <a href="#">Thành Viên {{rand(2,1000)}}</a></span>
                                  <h3 class="timeline-header"><a href="{{url('/posts')}}/{{$value['id']}}">{{$value['title']}}</a></h3>
                                  <div class="timeline-body">
                                      <div class="row">
                                        <div class="col-md-7">
                                          <div id="carousel_fade" class="list carousel slide carousel-fade">
                                              <div class="carousel-inner">
                                                  @foreach($value['image'] as $subKey => $subValue)
                                                    @if($subKey==0)
                                                      <div class="item active">
                                                    @else
                                                      <div class="item">
                                                    @endif
                                                      <img src="{{url('img/image')}}/{{$subValue['link']}}">
                                                    </div>
                                                  @endforeach
                                              </div>
                                          </div>
                                        </div>
                                         <div class="col-md-5">
                                                    <blockquote>
                                                        <p class="pColor">{{$value['content']}}</p>
                                                        <a class="btn btn-warning btn-flat btn-xs" href="{{url('/posts')}}/{{$value['id']}}">View full</a>
                                                    </blockquote>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <!-- END timeline item -->
                      @endforeach

                       <li>
                          <i class="fa fa-clock-o"></i>
                      </li>
                </ul>
            </div><!-- /.col -->
        </div>

      </div>
      <div class="col-md-4">
             @foreach($service_refers as $key => $value)
                <div class="row">
                    <a href="{{url('/service')}}/{{$value['id']}}">
                         <div id="carousel_fade" class="list carousel slide carousel-fade">
                              <div class="carousel-inner">
                                  @foreach($value['image'] as $subKey => $subValue)
                                    @if($subKey==0)
                                      <div class="item active">
                                    @else
                                      <div class="item">
                                    @endif
                                      <img src="{{url('img/image')}}/{{$subValue}}">
                                    </div>
                                  @endforeach
                              </div>
                              <div class="carousel-caption">
                                    <div class="statistic">
                                      <i class="fa fa-fw fa-thumbs-o-up"> </i> {{$value['member_action']['upVote']}}
                                      <i class="fa fa-fw fa-thumbs-o-down"> </i> {{$value['member_action']['downVote']}}
                                      <i class="fa fa-fw fa-share-square-o"> </i> {{$value['member_action']['share']}}
                                    </div>
                                      <h4> {{$value['service_name']}} </h4>
                                    <div class="carousel-detail">
                                      {{$value['description']}}
                                    </div>
                              </div>
                        </div>
                    </a>
                </div>
              @endforeach
      </div>
  </div>
@stop
