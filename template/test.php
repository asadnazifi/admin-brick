<?php
// URL مورد نظر
$url = 'https://www.amazon.ae/Soundcore-Bluetooth-Earphones-Wireless-Customization/dp/B0BTYDLTM3/ref=pd_day0_d_sccl_3_2/260-1536542-8817666?pd_rd_w=LCqjl&content-id=amzn1.sym.0f8b5c78-bef2-4995-a2a2-12a1821132e8&pf_rd_p=0f8b5c78-bef2-4995-a2a2-12a1821132e8&pf_rd_r=4681J8YRMFK84SH3T9PF&pd_rd_wg=OYq90&pd_rd_r=ef943b5b-1380-4176-8060-8471cd739ebc&pd_rd_i=B0BTYDLTM3&psc=1';

// از تابع file_get_contents برای دریافت محتوای URL استفاده می‌کنیم
$content = file_get_contents($url);

if ($content === false) {
    // در صورت عدم موفقیت در دریافت محتوا
    echo 'مشکل در دریافت اطلاعات از URL';
} else {
    // در صورت موفقیت در دریافت محتوا
    echo $content;
}
?>
