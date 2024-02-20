<?php

function loginCheckAndRedirect($loginPage) {
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        // کاربر لاگین کرده است، می‌توانید صفحه مورد نظر را نمایش دهید
        echo "Welcome to the member's area!";
    } else {
        // کاربر لاگین نکرده است، ریدایرکت به صفحه لاگین
        header("Location: $loginPage");
        exit;
    }
}
function export_to_db($db_name) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
   
    // اجرای کوئری مورد نظر
    $querys ="SELECT * FROM `$db_name` ";
    

    $query_result = $conn->query($querys);
    
    // بررسی نتیجه
    if ($query_result->num_rows > 0) {
        // عملیات استخراج داده‌ها
        $results = $query_result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }

    //بستن اتصال به دیتابیس
    $conn->close();

    //ریترن نتیجه یا هر چیزی که نیاز است
    return $results;
}
function set_flash_message($message) {
    $_SESSION['flash_message'] = $message;
}
function display_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="col-md-3">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">عملیات مفقیت آمیز بود</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            '.$_SESSION['flash_message'].'
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>';
        unset($_SESSION['flash_message']); // حذف Session Flash
    }
}
function display_flash_message_error() {
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="col-md-3">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">خطا</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            '.$_SESSION['flash_message'].'
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>';
        unset($_SESSION['flash_message']); // حذف Session Flash
    }
}
function reddirckt_back_url(){
    $previous_page = $_SERVER['HTTP_REFERER']; // آدرس صفحه قبلی را دریافت می‌کنیم

if (!empty($previous_page)) {
    header("Location: $previous_page"); // انجام ریدایرکت به صفحه قبلی
} else {
    // اگر آدرس صفحه قبلی خالی بود، می‌توانید به یک آدرس پیشفرض ریدایرکت کنید
    header("Location: default_page.php");
    exit; // متوقف کردن اجرای برنامه
}
}
function delete_data_in_db ($id , $coulem_name, $tabel_name){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query_delete_user = "DELETE FROM $coulem_name WHERE $tabel_name =$id";
    $query_result = $conn->query($query_delete_user);
    return $query_result;
}
function insert_date_in_to_db($column ,$taebal_names,$values){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";

   
    $table_names = implode(",", $taebal_names);

    $escaped_values = array_map(function($value) use ($conn) {
        return $conn->real_escape_string($value);
    }, $values);
    $escaped_values = implode("','", $escaped_values);

    $query_insert_data_to_db = "INSERT INTO $column ($table_names) VALUES ('$escaped_values')";
    $results = $conn->query($query_insert_data_to_db);

    return $results;

}
function edit_data_db($coulem_name,$select_tabel,$equal_where_tabel){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query_edit ="SELECT * FROM $coulem_name WHERE $select_tabel = $equal_where_tabel";
    $query_result = $conn->query($query_edit);
    
    // بررسی نتیجه
    if ($query_result->num_rows > 0) {
        // عملیات استخراج داده‌ها
        $results = $query_result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }

    //بستن اتصال به دیتابیس
    $conn->close();

    //ریترن نتیجه یا هر چیزی که نیاز است
    return $results;

}
function update_data_in_database($table_name, $primary_key,$name_primary_key, $form_data ,$not_to_form) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";

    $updates = [];
    foreach ($form_data as $key => $value) {
        $escaped_value = $conn->real_escape_string($value);
        if($key !=$not_to_form){
            $updates[] = "$key = '$escaped_value'";
        }
        
    }

    $set_clause = implode(", ", $updates);

    $query_update_data_in_db = "UPDATE $table_name SET $set_clause WHERE $name_primary_key = '$primary_key'";
    $result = $conn->query($query_update_data_in_db);

    return $result;
}

if(isset($_GET['user_delete'])){
    $user_id = intval($_GET['user_delete']);
    $query_result = delete_data_in_db($user_id ,"users","user_id");
    if($query_result){
        session_start();
        set_flash_message("کاربر با موفقیت حذف شد");
        header('Location: http://localhost/admin-brick/template/list-users.php');
    }
}
if(isset($_POST['insert_user_to_db'])){
    if(!isset($_POST['firstname']) || empty($_POST['firstname'])){
        session_start();
        set_flash_message("نام کاربری الزامی می باشد");
        reddirckt_back_url();

    }elseif(!isset($_POST['lastname']) || empty($_POST['lastname'])){
        session_start();
        set_flash_message("نام خانوادگی الزامی می باشد");
        reddirckt_back_url();
    }elseif(!isset($_POST['gmail']) || empty($_POST['gmail'])){
        session_start();
        set_flash_message("ایمیل الزامی می باشد");
        reddirckt_back_url();
    }elseif(!isset($_POST['passwords']) || empty($_POST['passwords'])){
        session_start();
        set_flash_message("رمزعبور الزامی می باشد");
        reddirckt_back_url();
    }
    $coulemn = ['firstname','lastname','gmail','password'];
    $value = [$_POST['firstname'],$_POST['lastname'],$_POST['gmail'],$_POST['passwords']];
    $resulte = insert_date_in_to_db("users",$coulemn,$value);
    if($resulte){
        session_start();
        set_flash_message("کاربر با موفقیت ایجاد شد");
        header('Location: http://localhost/admin-brick/template/list-users.php');

    }
    

}
if(isset($_POST['update_user_to_db'])){
    $form_data = $_POST;
    $primary_key = $_POST['user_id'];
    $table_name = 'users'; 

    $update_result = update_data_in_database($table_name, $primary_key, "user_id",$form_data,'update_user_to_db');
    if($update_result){
        session_start();
        set_flash_message("کاربر با موفقیت ویرایش شد");
        header("Location: http://localhost/admin-brick/template/list-users.php");

    }
}
if(isset($_POST['insert_categoreis_to_db'])){
    if(!isset($_POST['categore_name']) || empty($_POST['categore_name'])){
        session_start();
        set_flash_message("نام دسته بندی الزامی می باشد");
        reddirckt_back_url();

    }
    $coulemn = ['name_categore'];
    $value = [$_POST['categore_name']];
    $resulte = insert_date_in_to_db("caetgories",$coulemn,$value);
    if($resulte){
        session_start();
        set_flash_message("دسته بندی با موفقیت ایجاد شد");
        header('Location: http://localhost/admin-brick/template/list-categories.php');

    }

}
if(isset($_GET['categories_delete'])){
    $categorie_id = intval($_GET['categories_delete']);
    $query_result = delete_data_in_db($categorie_id ,"caetgories","categore_id");
    if($query_result){
        session_start();
        set_flash_message("دسته بندی با موفقیت حذف شد");
        header('Location: http://localhost/admin-brick/template/list-categories.php');
    }
}
if(isset($_POST['update_categorie_to_db'])){
    $form_data = $_POST;
    $primary_key = $_POST['categore_id'];
    $table_name = 'caetgories'; 

    $update_result = update_data_in_database($table_name, $primary_key, "categore_id",$form_data,'update_categorie_to_db');
    if($update_result){
        session_start();
        set_flash_message("دسته بندی با موفقیت ویرایش شد");
        header("Location: http://localhost/admin-brick/template/list-categories.php");

    }
}



