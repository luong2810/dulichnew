<div class="item" style="padding-left:0px">
  <img src="{{url('img/avarta')}}/{{$user['avatar']}}" alt="user image" class="online">
  <p class="message">
      <a href="#" class="name">
          {{$user['user_name']}}
      </a>
      <?php $date=date_format(date_create($new_comment['created_at']),'Y-m-d'); ?>
      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>{{$date}}</small>
      {{$new_comment['content']}}
  </p>
  <small class="text-muted " style="padding-left:56px">
    <a href="#" class="btn-reply" style="margin-right: 10px;">Reply</a>
    <a href="#" class="btn-action" data-id="{{$new_comment['id']}}" data-type="comment_id" data-action="upVote" sytle="margin-left: 10px;"> <span class="action-number">0</span><i class="fa fa-fw fa-thumbs-o-up"></i></a>
    <a href="#" class="btn-action" data-id="{{$new_comment['id']}}" data-type="comment_id" data-action="downVote" sytle="margin-left: 10px;"> <span class="action-number">0</span><i class="fa fa-fw fa-thumbs-o-down"></i></a>
  </small>
  <div class="input-reply" style="padding-left:54px;display: none;">
    <div class="input-group input-group-sm">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-info btn-flat btn-reply-comment" type="button" data-id="{{$new_comment['id']}}">Reply</button>
        </span>
    </div>
  </div>
</div>