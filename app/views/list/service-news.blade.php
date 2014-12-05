@extends('layouts.application')

@section('content')
	
	
    <h2 class="page-header" style="color: inherit;font-size: xx-large;">Dịch vụ mới cung cấp </h2>

  <div class="row">
        @foreach($service_news as $key => $value)
            <div class="col-md-4">
                <a href="{{url('/service')}}/{{$value['id']}}">
                     <div id="carousel_fade" class="list carousel slide carousel-fade">
                          <div class="carousel-inner">
                              @foreach($value['image'] as $subKey => $subValue)
                                @if($subKey==0)
                                  <div class="item active">
                                @else
                                  <div class="item">
                                @endif
                                  <img src="img/image/{{$subValue}}">
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

@stop
