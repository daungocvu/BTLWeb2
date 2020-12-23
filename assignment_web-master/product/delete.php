<?php

require './libs/function.php';

// Thực hiện xóa
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : '';
if ($product_id){
    delete($product_id);
}

// Trở về trang danh sách
header("location: list.php");