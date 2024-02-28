<?php include_once "hedaer.php";include_once "../functions/functions.php"; ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">لیست دسته بندی ها</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      <?php display_flash_message(); ?>
    </div>
<div class="row">
         <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin-brick/template/create-categoreis.php" class="btn btn-info float-right bg-primary"><i class="fa fa-plus"></i>افزودن دسته بندی</a></h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ایدی دسته بندی</th>
                            <th>نام دسته بندی</th>
                            <th>عملیات</th>
                        
                        </tr>
                        <?php $results= export_to_db("caetgories");?>
                            
                        <?php while($row = $results->fetch_assoc()):?>
                        <tr>
                            
                            <td><?php echo $row['categore_id'];?></td>
                            <td><?php echo $row['name_categore'];?></td>
                            <td>
                                <a href="edit_categore.php?edit_categories=<?php echo $row['categore_id']; ?>"><i class="nav-icon fa fa-edit"></i></a>
                                <a href="../functions/functions.php?categories_delete=<?php echo $row['categore_id']; ?>"><i class="nav-icon fa fa-trash"></i></a>
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