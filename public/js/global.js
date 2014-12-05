jQuery(document).ready(function() {
   jQuery('.carousel').carousel({
		interval: 8000
	}) ;

    jQuery('.carousel').hover(function(){
    	jQuery(this).find('.carousel-detail').fadeIn(100);
    });

    jQuery('.carousel').mouseout(function(){
    	jQuery(this).find('.carousel-detail').fadeOut(100);
    });

     jQuery('#box-create-group').submit(function(){
        var url = '/ajax/create-group';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#box-create-group").serialize(),
           success: function(data)
           {
                window.location=data;
           }
        });
      return false;
    });

    //  jQuery('#box-create-post').submit(function(){
    //     var url = '/ajax/create-post';
    //     $.ajax({
    //        type: "POST",
    //        url: url,
    //        data: $("#box-create-post").serialize(),
    //        success: function(data)
    //        {
    //             alert(data);
    //        }
    //     });
    //   return false;
    // });

    jQuery('#box-dangnhap').submit(function(){
        var url = '/ajax/signin';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#box-dangnhap").serialize(),
           success: function(data)
           {
                if (data=='true') {
                    $('#error-signin').html('');
                    location.reload();
                } else {
                    $('#error-signin').html('<p class="text-red">Tài khoản hoặc mật khẩu không đúng !</p>');
                }
           }
        });
    	return false;
    });

    jQuery('#box-dangki').submit(function(){
        if($("#pass1").val()!=$('#pass2').val()){
            $('#error-dangki').html('<p class="text-red">Mật khẩu xác nhận không đúng!</p>')
        } else{
            $('#error-dangki').html('');
        };
        var url = '/ajax/dangki';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#box-dangki").serialize(),
           success: function(data)
           {
                location.reload();
           }
        });
        return false;
    });

    $('#dang-xuat').click(function(){
        var url = '/ajax/signout';
        $.ajax({
           type: "GET",
           url: url,
           success: function(data)
           {
                location.reload();
           }
        });
        return false;
    });

    $('.btn-reply').click(function(){
        $(this).parent().parent().find('.input-reply').toggle();
        return false;
    });

    $('.btn-reply-comment').click(function(){
        if(!$(this).parent().parent().find('.form-control').val()){
          $(this).parent().parent().parent().hide();
          return false;
        };

        var data =  { "content": $(this).parent().parent().find('.form-control').val(),
                      "data-id": $(this).attr('data-id'),
                      "data-post-id": $(this).attr('data-post-id'),
                      "data-padding": $(this).attr('data-padding')
                    };
        var url = '/ajax/reply';
        gthis = this;
        $.ajax({
           type: "POST",
           url: url,
           data: data,
           success: function(data)
           {
              $(gthis).parent().parent().parent().hide();
              $(gthis).parent().parent().find('.form-control').val('');
              $(gthis).parent().parent().parent().parent().after(data);
           }
        });

        return false;
    });

    $('.btn-send-comment').click(function(){
        if(!$(this).parent().parent().find('.form-control').val()){
          return false;
        };

        // alert($(this).parent().parent().find('.form-control').val());
        var data =  { "content": $(this).parent().parent().find('.form-control').val(),
                      "data-post-id": $(this).attr('data-post-id'),
                    };
        var url = '/ajax/comment';
        gthis = this;
        $.ajax({
           type: "POST",
           url: url,
           data: data,
           success: function(data)
           {
              // $(gthis).parent().parent().parent().hide();
              $(gthis).parent().parent().parent().find('#chat-box').prepend(data);
           }
        });

        $(this).parent().parent().find('.form-control').val('');
        return false;
    });

    $('.btn-action').click(function(){
      if($(this).hasClass('btn-actioned')) return false;
      if($('#logo').attr('signed')){
        var data =  { "data-id": $(this).attr('data-id'),
                      "data-type": $(this).attr('data-type'), 
                      "data-action": $(this).attr('data-action'), 
                    };
        var url = '/ajax/action';
        gthis = this;
        $.ajax({
           type: "POST",
           url: url,
           data: data,
           success: function(data)
           {
              if (data=="true") {
                $(gthis).find('.action-number').html(parseInt($(gthis).find('.action-number').html())+1);
                $(gthis).removeClass('btn-success');
                $(gthis).addClass('btn-actioned');
              };
           }
        });
        return false;
      }else{
        alert('Đăng nhập để sử dụng chức năng này.');
        return false;
      };
    });
});

