@include('layouts.header')

<div class="wrapper row-offcanvas row-offcanvas-left">
@include('layouts.sidebar')
  <aside class="right-side">
  <section class="content" style="overflow: visible;padding-left: 15px;padding-top: 70px;">

	<div class="modal fade" id="dangki" tabindex="-1" role="dialog" aria-labelledby="dangki" aria-hidden="true">
      <div class="form-box" id="login-box">
            <div class="header">Đăng kí tài khoản đơn giản</div>
            <form action="" method="post" id='box-dangki'>
                <div class="body bg-gray">
                    <div id="error-dangki">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Tên đầy đủ..." required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Tài khoản..." required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email..." required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="pass1" placeholder="Password..." required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" id="pass2" placeholder="Retype password..." required>
                    </div>
                    <div class="form-group">
                        <label>Phân Loại</label>
                        <select class="form-control" name="typemember">
                            <option selected>Thành Viên</option>
                            <option>Thương Hiệu</option>
                        </select>
                    </div>
                </div>
                <div class="footer">                    

                    <button type="submit" class="btn bg-olive btn-block">Sign me up</button>

                </div>
            </form>
        </div>
    </div>

	 <div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-labelledby="dangnhap" aria-hidden="true">
      <div class="modal-dialog modal-sm">
       <div class="form-box" id="login-box">
            <div class="header">Tài khoản</div>
            <form action="" method="post" id="box-dangnhap">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Tên đăng nhập hoặc email...." required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password..." required>
                    </div> 
                    <div id="error-signin">
                    </div>         
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Đăng nhập</button>  
                    
                    <p><a href="#">Tôi quên mật khẩu</a></p>
                </div>
            </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="create-group" tabindex="-1" role="dialog" aria-labelledby="create-group" aria-hidden="true">
      <div class="modal-dialog modal-sm">
       <div class="form-box" id="login-box">
            <div class="header">Thông tin nhóm mới</div>
            <form action="" method="post" id="box-create-group">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="group-name" class="form-control" placeholder="Tên nhóm...." required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name ="description" rows="3" placeholder="Mô tả nhóm ..." required></textarea>
                    </div> 
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Tạo nhóm</button>  
                    
                </div>
            </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="create-post" aria-hidden="true">
      <div class="modal-dialog modal-sm">
       <div class="form-box" id="login-box">
            <div class="header">Nội dung bài chia sẻ</div>
            <form action="ajax/create-post" method="post" id="box-create-post" enctype="multipart/form-data">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Tiêu đề...." required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name ="content" rows="3" placeholder="Nội dung ..." required></textarea>
                    </div> 
                     <div class="form-group">
                        <input type="text" name="location" class="form-control" placeholder="Địa điểm ...." required>
                    </div>
                    <div class="form-group">
                        <input name='uploads[]' type="file" multiple>
                    </div> 
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Chia sẻ</button>  
                </div>
            </form>

        </div>
      </div>
    </div>


@yield('content')
  </section>
  </aside>
</div>

@include('layouts.footer')
