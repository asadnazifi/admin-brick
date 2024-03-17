<?php

function loginCheckAndRedirect($loginPage) {
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === 'admin'){
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
   global $conn;
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
    global $conn;
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
    global $conn;
    $query_edit ="SELECT * FROM $coulem_name WHERE $select_tabel = $equal_where_tabel";
    $query_result = $conn->query($query_edit);
    
    // بررسی نتیجه
    if ($query_result->num_rows > 0) {
        // عملیات استخراج داده‌ها
        $results = $query_result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }


    return $results;

}
function update_data_in_database($table_name, $primary_key,$name_primary_key, $form_data ,$not_to_form) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    global $conn ;
    $updates = [];

    if (array_key_exists('slider',$form_data)){
        foreach ($form_data as $key => $value) {
            $escaped_value = $conn->real_escape_string($value);
            if($key !=$not_to_form){
                $updates[] = "$key = '$escaped_value'";
            }

        }
    }else{
        foreach ($form_data as $key => $value) {
            $escaped_value = $conn->real_escape_string($value);
            if($key !=$not_to_form){
                $updates[] = "$key = '$escaped_value'";
            }
            $updates[] = "slider = 'null'";

        }

    }


    $set_clause = implode(", ", $updates);

    $query_update_data_in_db = "UPDATE $table_name SET $set_clause WHERE $name_primary_key = '$primary_key'";
    $result = $conn->query($query_update_data_in_db);

    return $result;
}
function join_date_in_db($name_tabel_one,$select_date_tabel_one,$name_tabel_to,$select_data_tabel_to,$primery_tabel_one,$primery_tabel_to){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    global $conn;
    $query_join = "SELECT $name_tabel_one.$select_date_tabel_one, $name_tabel_to.$select_data_tabel_to FROM $name_tabel_one JOIN $name_tabel_to ON $name_tabel_one.$primery_tabel_one = $name_tabel_to.$primery_tabel_to";
    $query_result = $conn->query($query_join);
    
    // بررسی نتیجه
    if ($query_result->num_rows > 0) {
        // عملیات استخراج داده‌ها
        $results = $query_result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }

    //بستن اتصال به دیتابیس

    //ریترن نتیجه یا هر چیزی که نیاز است
    return $results;
}
function uplode_file($name_file){
    $target_dir = "../uploads_img_product/"; 
    $target_file = $target_dir . basename($name_file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    

    if ($name_file["size"] > 5000000) {
        session_start();
        set_flash_message("اندازه فایل بیشتز ار حد مجاز");
        $uploadOk = 0;
        reddirckt_back_url();
    }

    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
        session_start();
        set_flash_message("تنها فایل‌های JPG, JPEG, PNG یا GIF مجاز هستند.");
        $uploadOk = 0;
        reddirckt_back_url();
        
    }

     if (move_uploaded_file($name_file["tmp_name"], $target_file)) {
        return basename($name_file["name"]);
        } else {
            return false;
        }
    
}
function join_data_to_data_select_db(){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query_select_join = "SELECT * FROM orders JOIN products ON orders.product_id = products.product_id JOIN users ON orders.user_id = users.user_id";
    global $conn;
    $query_result = $conn->query($query_select_join);
    
    if ($query_result->num_rows > 0) {
        $results = $query_result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }

    return $results;
}

function retrieveRecord($input) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    global $conn;
    if ($input === NULL) {
        $query = "SELECT * FROM caetgories LIMIT 1";
        $result = $conn->query($query);
    } else {
        $query = "SELECT * FROM caetgories WHERE categore_id = '$input'";
        $result = $conn->query($query);
    }
    return $result;
}
function export_data_where($tabelname, $primery_key,$weher){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    global $conn;
    $query = "SELECT * FROM $tabelname WHERE $primery_key = $weher";
   
        $result = $conn->query($query);
        
    
    if ($result->num_rows > 0) {
        $results = $result;
           
    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }
   

    return $results;
}
function single_product($product_id){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query = "SELECT * FROM products JOIN caetgories ON products.categories_id=caetgories.categore_id WHERE product_id =$product_id";
    global $conn;
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        $results = $result;

    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }


    return $results;
}
function select_where($name_tabel,$prymery,$value){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query = "SELECT * FROM `$name_tabel` WHERE `$prymery`=$value";
    global $conn;
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        $results = $result;

    } else {
        echo "هیچ نتیجه‌ای یافت نشد";
    }


    return $results;
}
function count_order_new(){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query = "SELECT COUNT(*) AS unpade_count FROM orders WHERE statuus = 'unpade'";
    global $conn;
    $result = $conn->query($query);

    return $result;
}function count_user(){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query = "SELECT COUNT(*) AS user_count FROM users ";
    global $conn;
    $result = $conn->query($query);

    return $result;
}
function count_visits(){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query = "SELECT COUNT(*) AS visits_count FROM visits ";
    global $conn;
    $result = $conn->query($query);

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

// اتصال به پایگاه داده
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
global $conn;

function check_ip_exists($ip)
{
    global $conn;

    $query = "SELECT * FROM visits WHERE ip_address = '$ip'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return true; // IP تکراری وجود دارد
    } else {
        return false; // IP تکراری وجود ندارد
    }
}

function log_visit()
{
    global $conn;

    $ip_address = $_SERVER['REMOTE_ADDR']; // آدرس IP کاربر
    $visit_time = date('Y-m-d H:i:s'); // زمان بازدید

    // بررسی وجود IP در جدول visits
    if (!check_ip_exists($ip_address)) {
        // ثبت بازدید در صورت عدم وجود IP تکراری
        $query = "INSERT INTO visits (ip_address, visit_time) VALUES ('$ip_address', '$visit_time')";

        if ($conn->query($query) === TRUE) {

        } else {
            echo "خطا در ثبت بازدید: " . $conn->error;
        }
    } else {

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
if(isset($_POST['insert_product_to_db'])){
    if(!isset($_POST['name_product']) || empty($_POST['name_product'])){
        session_start();
        set_flash_message("نام محصول الزامی است");
        reddirckt_back_url();

    }elseif(!isset($_POST['price']) || empty($_POST['price'])){
        session_start();
        set_flash_message("قیمت محصول  الزامی می باشد");
        reddirckt_back_url();
    }elseif(!isset($_POST['description_long_text']) || empty($_POST['description_long_text'])){
        session_start();
        set_flash_message("توضیحات کوتاه الزامی می باشد");
        reddirckt_back_url();
    }elseif(!isset($_POST['description_text']) || empty($_POST['description_text'])){
        session_start();
        set_flash_message("توضیحات الزامی می باشد");
        reddirckt_back_url();
    }
    elseif(!isset($_FILES['img_url']) || empty($_FILES['img_url'])){
        session_start();
        set_flash_message("عکس محصول الزامی می باشد");
        reddirckt_back_url();
    }
    $img_url = uplode_file($_FILES['img_url']);
    $coulemn = ['name_product','price','img_url','categories_id','description','description_long','slider'];
    $value = [$_POST['name_product'],$_POST['price'],$img_url,$_POST['categories'],$_POST['description_text'],$_POST['description_long_text'],$_POST['slider']];
    $resulte = insert_date_in_to_db("products",$coulemn,$value);
    if($resulte){
        session_start();
        set_flash_message("محصول با موفقیت ایجاد شد");
        header('Location: http://localhost/admin-brick/template/list-products.php');

    }
}
if(isset($_GET['product_delete'])){
    $product_id = intval($_GET['product_delete']);
    $query_result = delete_data_in_db($product_id ,"products","product_id");
    if($query_result){
        session_start();
        set_flash_message("محصول با موفقیت حذف شد");
        header('Location: http://localhost/admin-brick/template/list-products.php');
    }
}
if(isset($_POST['update_product_to_db'])){
    $form_data = $_POST;
    $primary_key = $_POST['product_id'];
    $table_name = 'products'; 
    if(isset($_FILES['img_url'])&!empty($_FILES['img_url']['name'])){
        $adres_url = uplode_file($_FILES['img_url']);
        $form_data['img_url']=$adres_url;
        $update_result = update_data_in_database($table_name, $primary_key, "product_id",$form_data,'update_product_to_db');
        if($update_result){
            session_start();
            set_flash_message("محصول با موفقیت ویرایش شد");
            header("Location: http://localhost/admin-brick/template/list-products.php");
    
        }
    }

    $update_result = update_data_in_database($table_name, $primary_key, "product_id",$form_data,'update_product_to_db');
    if($update_result){
        session_start();
        set_flash_message("محصول با موفقیت ویرایش شد");
        header("Location: http://localhost/admin-brick/template/list-products.php");

    }
}
if (isset($_POST['user_login'])){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE gmail = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // کاربر اعتبارسنجی شده است
            $row = mysqli_fetch_assoc($result);
            if ($row['role'] === 'admin') {
                // اگر کاربر ادمین است، ورود انجام می‌شود
                session_start();
                $_SESSION['loggedin'] = "admin";
                $_SESSION['username'] = $username;
                header("Location: http://localhost/admin-brick");
            } else {
                // اگر کاربر معمولی است، ورود انجام می‌شود
                session_start();
                $_SESSION['loggedin'] = 'user';
                $_SESSION['username'] = $row['firstname'];
                $_SESSION['user_id'] = $row['user_id'];
                header("Location: http://localhost/brick");
            }
        } else {
            session_start();
            set_flash_message("نام کاربری یا کلمه عبور اشتباه است");
            reddirckt_back_url();
        }
        mysqli_close($conn);
    }

}
if (isset($_POST['register_user'])){
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
    }elseif($_POST['passwords'][0]!== $_POST['passwords'][1]){
        session_start();
        set_flash_message("رمزعبور باهم مطابقت ندارد");
        reddirckt_back_url();
    }
    $coulemn = ['firstname','lastname','gmail','password'];
    $value = [$_POST['firstname'],$_POST['lastname'],$_POST['gmail'],$_POST['passwords'][0]];
    $resulte = insert_date_in_to_db("users",$coulemn,$value);
    if($resulte){
        session_start();
        $_SESSION['loggedin'] = 'user';
        $_SESSION['username'] = $_POST['firstname'];
        $_SESSION['user_id'] = $resulte;
        header("Location: http://localhost/brick");

    }
}
if (isset($_POST['order_submit'])){
    session_start();
    if (isset($_SESSION['loggedin'])){
        if(!isset($_POST['name_product']) || empty($_POST['name_product'])){
            session_start();
            set_flash_message("نام محصول الزامی می باشد");
            reddirckt_back_url();

        }elseif(!isset($_POST['count_product']) || empty($_POST['count_product'])){
            session_start();
            set_flash_message("مقدار محصول الزامی می باشد");
            reddirckt_back_url();
        }elseif(!isset($_POST['adres']) || empty($_POST['adres'])){
            session_start();
            set_flash_message("آدرس الزامی می باشد");
            reddirckt_back_url();
        }elseif(!isset($_POST['phone']) || empty($_POST['phone'])){
            session_start();
            set_flash_message("شماره تماس الزامی می باشد");
            reddirckt_back_url();
        }
        $coulemn = ['product_id','adress_sent','phone','user_id','count'];
        $value = [$_POST['product_id'],$_POST['adres'],$_POST['phone'],$_POST['user_id'],$_POST['count_product']];
        $resulte = insert_date_in_to_db("orders",$coulemn,$value);
        if($resulte){
            session_start();
            set_flash_message("سفارش با موفقیت ثبت شد");
            reddirckt_back_url();
        }
    }else{
        session_start();
        set_flash_message("برای ثبت سفارش حتما باید وارد شوید");
        reddirckt_back_url();
    }

}
if (isset($_GET['session_delete'])){
    session_start();
    session_destroy();
    reddirckt_back_url();

}
if (isset($_GET['update_order'])){
    $order_id = $_GET['update_order'];
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-brick/functions/contect-to-db.php";
    $query_upadete = "UPDATE `orders` SET `statuus` = 'pade' WHERE `orders`.`order_id` =$order_id ";
    $resulte = $conn->query($query_upadete);
    if ($resulte){
        session_start();
        set_flash_message("وضعیت سفارش تایید شد");
        reddirckt_back_url();
    }

}
if(isset($_GET['order_delete'])){
    $order_id = intval($_GET['order_delete']);
    $query_result = delete_data_in_db($order_id ,"orders","order_id");
    if($query_result){
        session_start();
        set_flash_message("سفارش با موفقیت حذف شد");
        reddirckt_back_url();
    }
}


