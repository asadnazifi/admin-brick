<?php include_once ("hedaer.php");?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد دسته بندی</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      
    </div>
    <?php display_flash_message_error();?>
    <div class="col-12">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">فرم ایجاد دسته بندی</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action = "../functions/functions.php" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="categores" class="col-sm-2 control-label">نام دسته بندی</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="categore_name" id="categores" placeholder="نام دسته بندی  را وارد کنید">
                    </div>
                  </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = "insert_categoreis_to_db" class="btn btn-info">ایجاد کردن</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
    </div>


<?php include_once ("footer.php") ?>
