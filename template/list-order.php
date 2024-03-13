<?php include_once "hedaer.php";include_once "../functions/functions.php"; ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">لیست سفارشات</h1>
          </div><!-- /.col -->
      
      </div><!-- /.container-fluid -->
      <?php display_flash_message(); ?>
    </div>
<div class="row">
         <div class="col-12">
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>شناسه خرید</th>
                            <th>نام کاربر</th>
                            <th>نام محصول</th>
                            <th>قیمت محصول</th>
                            <th>آدرس خرید</th>
                            <th>شماره تماس </th>
                            <th>وضعیت خرید</th>
                            <th>عملیات</th>
                        
                        </tr>
                        <?php $results= join_data_to_data_select_db();?>
                            
                        <?php while($row = $results->fetch_assoc()):?>
                        <tr>
                            
                            <td><?php echo $row['order_id'];?></td>
                            <td><?php echo $row['firstname'].$row['lastname'];?></td>
                            <td><?php echo $row['name_product'];?></td>
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $row['adress_sent'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <?php if ($row['statuus']=='pade'):?>
                                <td><span class="badge badge-success">تکمیل شده</span></td>
                            <?php else:?>
                                <td><span class="badge badge-danger">تکمیل نشده</span></td>

                            <?php endif;?>


                            <td>
                                <?php if ($row['statuus']=="unpade"):?>
                                    <a href="edit-product.php?update_order=<?php echo $row['order_id']; ?>"><i class="nav-icon fa fa-check"></i></a>
                                <?php endif;?>
                                <a href="../functions/functions.php?order_delete=<?php echo $row['order_id']; ?>"><i class="nav-icon fa fa-trash"></i></a>
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