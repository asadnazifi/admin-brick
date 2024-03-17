<?php include_once "hedaer.php";include_once "../functions/functions.php"; ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">لیست محصولات</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      <?php display_flash_message(); ?>
    </div>
<div class="row">
         <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/create-products.php" class="btn btn-info float-right bg-primary"><i class="fa fa-plus"></i>افزودن محصول</a></h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ایدی محصول</th>
                            <th>نام محصول</th>
                            <th>قیمت محصول</th>
                            <th>عکس محصول</th>
                            <th>دسته بندی</th>
                            <th>نمایش در اسلایدر</th>
                            <th>عملیات</th>
                        
                        </tr>
                        <?php $results= join_date_in_db("products","*","caetgories","name_categore","categories_id","categore_id");?>
                            
                        <?php while($row = $results->fetch_assoc()):?>
                        <tr>
                            
                            <td><?php echo $row['product_id'];?></td>
                            <td><?php echo $row['name_product'];?></td>
                            <td><?php echo number_format($row['price']);?></td>
                            <td><img width="40" height="40" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/uploads_img_product/<?php echo $row['img_url'];?>" alt=""></td>
                            <td><span class="badge badge-success"><?php echo $row['name_categore'];?></span></td>
                            <?php if ($row['slider']=="on"):?>
                            <td><i class="nav-icon fa fa-check"></i></td>
                            <?php else:?>
                            <td><i class="nav-icon fa fa-remove"></i></td>
                            <?php endif;?>
                            <td>
                                <a href="edit-product.php?edit_product=<?php echo $row['product_id']; ?>"><i class="nav-icon fa fa-edit"></i></a>
                                <a href="../functions/functions.php?product_delete=<?php echo $row['product_id']; ?>"><i class="nav-icon fa fa-trash"></i></a>
                            </td>
                            
                        </tr>
                        <?php endwhile;?>

                        </tbody>
                      </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?php include_once "footer.php"?>