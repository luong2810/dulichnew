@extends('layouts.application')

@section('content')
  <div class="row">
      <div class="col-md-8">
          <div class="callout callout-info">
            <h4>{{$posts['title']}}</h4>
            <p>{{$posts['content']}}</p>
             <button class="btn  btn-sm btn-action {{$my_action['upVote']?'btn-actioned':'btn-success'}}" data-id="{{$posts['id']}}" data-type="posts_id" data-action="upVote"> <span class="action-number">{{$posts['member_action']['upVote']}} </span><i class="fa fa-fw fa-thumbs-o-up"></i> Up Vote</button>
            <button class="btn  btn-sm btn-action {{$my_action['downVote']?'btn-actioned':'btn-success'}}" data-id="{{$posts['id']}}" data-type="posts_id" data-action="downVote"> <span class="action-number">{{$posts['member_action']['downVote']}}</span> <i class="fa fa-fw fa-thumbs-o-down"></i> Down Vote</button>
            <button class="btn  btn-sm btn-action {{$my_action['share']?'btn-actioned':'btn-success'}}" data-id="{{$posts['id']}}" data-type="posts_id" data-action="share"> <span class="action-number">{{$posts['member_action']['share']}} </span><i class="fa fa-fw fa-share-square-o"></i> Share</button>
          </div>

          <div class='row'>
            <div class="box box-solid">
                                <div class="box-header">
                                    <i class="fa  fa-camera-retro"></i>
                                    <h3 class="box-title">Picture</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div id="carousel-example-generic" class="carousel slide full-slider" data-ride="carousel">
                                        <div class="carousel-inner full-slider-inner">
                                             @foreach($posts['image'] as $subKey => $subValue)
                                                    @if($subKey==0)
                                                      <div class="item active">
                                                    @else
                                                      <div class="item">
                                                    @endif
                                                      <img src="{{url('img/image')}}/{{$subValue['link']}}" class="image-align">
                                                    </div>
                                                  @endforeach
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
          </div>

          <div>
            <div class="box box-success">
                  <div class="box-header" style="cursor: move;">
                      <i class="fa fa-comments-o"></i>
                      <h3 class="box-title">Comment</h3>
                      <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                          
                      </div>
                  </div>
                  <div class="box-footer">
                      <div class="form-group">
                          <label>My Comment</label>
                          <textarea class="form-control" rows="3" placeholder="Cảm nhận về bài viết ..."></textarea>
                          <button type="submit" class="btn btn-primary btn-send-comment" style="float:right" data-post-id="{{$posts['id']}}" >Comment</button>
                      </div>
                                        
                  </div>
                  
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;padding-top: 20px;">
                    <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto;">
                      <!-- chat item -->
                      @foreach($posts_comments as $key => $value)
                      <?php $padding = $value['level']*54;?>
                      <div class="item" style="padding-left:{{$padding}}px">
                          <img src="{{url('img/avarta')}}/{{$value['value']['member_account']['avatar']}}" alt="user image" class="online">
                          <p class="message">
                              <a href="#" class="name">
                                  {{$value['value']['member_account']['user_name']}}
                              </a>
                              <?php $date=date_format(date_create($value['value']['created_at']),'Y-m-d'); ?>
                              <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>{{$date}}</small>
                              {{$value['value']['content']}}
                          </p>
                          <small class="text-muted " style="padding-left:56px">
                            <a href="#" class="btn-reply" style='margin-right: 10px;'>Reply</a>
                            <a href="#" class="btn-action" data-id="{{$value['value']['id']}}" data-type="comment_id" data-action="upVote" sytle='margin-left: 10px;'> <span class="action-number">{{$value['value']['member_action']['upVote']}}</span><i class="fa fa-fw fa-thumbs-o-up"></i></a>
                            <a href="#" class="btn-action" data-id="{{$value['value']['id']}}"  data-type="comment_id" data-action="downVote" sytle='margin-left: 10px;'> <span class="action-number">{{$value['value']['member_action']['downVote']}}</span><i class="fa fa-fw fa-thumbs-o-down"></i></a>
                          </small>
                          <div class="input-reply" style="padding-left:54px;display: none;">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat btn-reply-comment" type="button" data-post-id="{{$posts['id']}}" data-id="{{$value['value']['id']}}" data-padding="{{$padding+54}}">Reply</button>
                                </span>
                            </div>
                          </div>
                      </div><!-- /.item -->
                      @endforeach
                      <!-- chat item -->
                      <!-- chat item -->
                  </div></div>
              </div>
          </div>
      </div>
      <div class="col-md-4">
             @foreach($posts_refers as $key => $value)
                <div class="row">
                    <a href="#">
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
                              <div class="carousel-caption">
                                    <div class="statistic">
                                      <i class="fa fa-fw fa-thumbs-o-up"> </i> {{$value['member_action']['upVote']}}
                                      <i class="fa fa-fw fa-thumbs-o-down"> </i> {{$value['member_action']['downVote']}}
                                      <i class="fa fa-fw fa-share-square-o"> </i> {{$value['member_action']['share']}}
                                    </div>
                                      <h4> {{$value['title']}} </h4>
                                    <div class="carousel-detail">
                                      {{$value['content']}}
                                    </div>
                              </div>
                        </div>
                    </a>
                </div>
              @endforeach
      </div>
  </div>
@stop
