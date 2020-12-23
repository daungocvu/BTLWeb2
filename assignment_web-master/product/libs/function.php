<?php
global $conn;
function connect_db()
{
    global $conn;
    if (!$conn){
        $servername = "localhost";
        $database = "web_ass_2";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database) or die ('connect fail');
        mysqli_set_charset($conn, 'utf8');
    }
}
function disconnect_db()
{
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
function get_all()
{
    global $conn;
    connect_db();
    $sql = "select * from products";
    $query = mysqli_query($conn, $sql);
    $result = array();
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
}

function get($product_id)
{
    global $conn;
    connect_db();
    $sql = "select * from products where product_id = {$product_id}";
    $query = mysqli_query($conn, $sql);
    $result = array();
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
}

function add($product_id, $product_name, $product_img,$product_description,$product_startdate,$product_enddate,$product_price)
{
    global $conn;
    connect_db();
    $product_id = addslashes($product_id);
    $product_name = addslashes($product_name);
    $product_description = addslashes($product_description);
    $product_startdate = addslashes($product_startdate);
    $product_enddate = addslashes($product_enddate);
    $product_price = addslashes($product_price);
    $sql = "
            INSERT INTO products(product_id, product_name, product_img,product_description,product_startdate,product_enddate,product_price) VALUES
            ('$product_id','$product_name','$product_img','$product_description','$product_startdate','$product_enddate','$product_price')
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}

function edit($product_id, $product_name,$product_description,$product_startdate,$product_enddate,$product_price)
{
    global $conn;
    connect_db();
    $product_id = addslashes($product_id);
    $product_name = addslashes($product_name);
    $product_description = addslashes($product_description);
    $product_startdate = addslashes($product_startdate);
    $product_enddate = addslashes($product_enddate);
    $product_price = addslashes($product_price);
 
    $sql = "
            UPDATE products SET
            product_name = '$product_name',
            product_description = '$product_description',
            product_startdate = '$product_startdate',
            product_enddate = '$product_enddate',
            product_price = '$product_price'
            WHERE product_id='$product_id'
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}
function delete($product_id)
{
    global $conn;
    connect_db();
    $sql = "
            DELETE FROM products
            WHERE product_id = $product_id
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}