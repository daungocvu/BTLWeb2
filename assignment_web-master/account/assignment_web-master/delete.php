<?php

require './libs/function.php';

// Thực hiện xóa
$account_id = isset($_POST['account_id']) ? (int)$_POST['account_id'] : '';
if ($account_id){
    delete($account_id);
}

// Trở về trang danh sách
header("location: list.php");