<?php include_once ("hedaer.php");?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش محصول</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      
    </div>
    <?php display_flash_message_error();?>
    <div class="col-12">
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">فرم ویرایش  محصول</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php $resulte = edit_data_db('products','product_id',$_GET['edit_product']);?>
              <?php while($row = $resulte->fetch_assoc()):?>
              <form class="form-horizontal" action = "../functions/functions.php" method="POST"  enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="name_product" class="col-sm-2 control-label">نام محصول</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name_product" id="name_product" value = "<?php echo $row['name_product'];?>" placeholder="نام محصول را وارد کنید">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">قیمت محصول</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="price" id="price" value = "<?php echo $row['price'];?>" placeholder="قیمت محصول را وارد کنید">
                      <input type="hidden" class="form-control" name="product_id" value = "<?php echo $row['product_id'];?>">

                    </div>
                  </div>
                  <div class="form-group">
                    <label for="description_long_text" class="col-sm-2 control-label">توضیحات کوتاه محصول</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name = "description_long"  id="description_long_text" cols="30" rows="10"><?php echo $row['description_long'];?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="description_text" class="col-sm-2 control-label">توضیحات محصول</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name = "description" id="description_text" cols="30" rows="50"><?php echo $row['description'];?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputFile">انتخاب عکس</label>
                    <div class="col-sm-10">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="img_url">
                        <label class="custom-file-label" for="exampleInputFile">انتخاب عکس</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">انتخاب عکس</span>
                      </div>
                    </div>                    
                    <div class="form-group">
                    <label>دسته بندی ها</label>
                    <select class="form-control" name= "categories_id">
                    

                    <?php $cate= export_to_db("caetgories");?>
                            
                    <?php while($categores = $cate->fetch_assoc()):?>
                      <option <?php if($categores['categore_id'] == $row['categories_id'])echo "selected";?> value = "<?php echo $categores['categore_id'];?>"><?php echo $categores['name_categore'];?></option>

                    <?php endwhile;?>
                    </select>
                  </div>

                  </div>
                  </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name = "update_product_to_db" class="btn btn-info">ویراش کردن</button>
                </div>
                <!-- /.card-footer -->
              </form>
              <?php endwhile;?>

            </div>
    </div>


<?php include_once ("footer.php") ?>
