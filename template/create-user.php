<?php include_once ("hedaer.php");?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد کاربر</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      
    </div>
    <?php display_flash_message_error();?>
    <div class="col-12">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">فرم ایجاد کاربر</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action = "../functions/functions.php" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">نام کاربر</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="نام را وارد کنید">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">نام خانوادگی</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="نام خانوادگی را وارد کنید">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" name = "gmail" id="inputEmail3" placeholder="ایمیل را وارد کنید">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name = "passwords"  id="inputPassword3" placeholder="پسورد را وارد کنید">
                    </div>
                  </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = "insert_user_to_db" class="btn btn-info">ایجاد کردن</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
    </div>


<?php include_once ("footer.php") ?>
