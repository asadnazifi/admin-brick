<?php include_once ("hedaer.php");?>
<?php if(isset($_GET['edit_categories'])):?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش دسته بندی</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      
    </div>
    <?php display_flash_message_error();?>
    <div class="col-12">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">دسته بندی جاری</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php $resulte = edit_data_db('caetgories','categore_id',$_GET['edit_categories']);?>
              <?php while($row = $resulte->fetch_assoc()):?>
              <form class="form-horizontal" action = "../functions/functions.php" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="name_categore" class="col-sm-2 control-label">نام دسته بندی</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name_categore" id="name_categore" placeholder="نام دسته بندی را وارد کنید" value = "<?php echo $row['name_categore'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                      <input type="hidden" name= "categore_id" value = "<?php echo $row['categore_id'];?>">
                  </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = "update_categorie_to_db" class="btn btn-info">ویرایش</button>
                </div>
                <!-- /.card-footer -->
              </form>
              <?php endwhile;?>
            </div>
    </div>
    <?php endif;?>


<?php include_once ("footer.php") ?>
