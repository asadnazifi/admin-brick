<?php include_once ("hedaer.php");?>
<?php if(isset($_GET['edit_user'])):?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش کاربر</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      
    </div>
    <?php display_flash_message_error();?>
    <div class="col-12">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">کاربر جاری</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php $resulte = edit_data_db('users','user_id',$_GET['edit_user']);?>
              <?php while($row = $resulte->fetch_assoc()):?>
              <form class="form-horizontal" action = "../functions/functions.php" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">نام کاربر</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="نام را وارد کنید" value = "<?php echo $row['firstname'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">نام خانوادگی</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="نام خانوادگی را وارد کنید" value = "<?php echo $row['lastname'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" name = "gmail" id="inputEmail3" placeholder="ایمیل را وارد کنید" value = "<?php echo $row['gmail'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name = "password"  id="inputPassword3" placeholder="پسورد را وارد کنید" value = "<?php echo $row['password'];?>">
                      <input type="hidden" name= "user_id" value = "<?php echo $row['user_id'];?>">
                    </div>
                  </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = "update_user_to_db" class="btn btn-info">ویرایش</button>
                </div>
                <!-- /.card-footer -->
              </form>
              <?php endwhile;?>
            </div>
    </div>
    <?php endif;?>


<?php include_once ("footer.php") ?>
