<?php
require './libs/function.php';
// Lấy thông tin hiển thị lên để người dùng sửa
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : '';
if ($product_id){
    $data = get($product_id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit']))
{
    // Lay data
    $data['product_id']        = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $data['product_name']         = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $data['product_description']    = isset($_POST['product_description']) ? $_POST['product_description'] : '';
    $data['product_startdate']    = isset($_POST['product_startdate']) ? $_POST['product_startdate'] : '';  
    $data['product_enddate']    = isset($_POST['product_enddate']) ? $_POST['product_enddate'] : '';
    $data['product_price']    = isset($_POST['product_price']) ? $_POST['product_price'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['product_id'])){
        $errors['product_id'] = 'Ban chua nhap id';
    }
    
    if (empty($data['product_name'])){
        $errors['product_name'] = 'Ban chua nhap product_name';
    }
    if (empty($data['product_description'])){
        $errors['product_description'] = 'Ban chua nhap product_description';
    }
    if (empty($data['product_startdate'])){
        $errors['product_startdate'] = 'Ban chua nhap product_startdate';
    }
    if (empty($data['product_enddate'])){
        $errors['product_enddate'] = 'Ban chua nhap product_enddate';
    }
    if (empty($data['product_price'])){
        $errors['product_price'] = 'Ban chua nhap product_price';
    }
    // Neu ko co loi thi insert
    if (!$errors){
        edit($data['product_id'], $data['product_name'],$data['product_description'],$data['product_startdate'],$data['product_enddate'],$data['product_price']);
        // Trở về trang danh sách
        header("location: list.php");
    }
}
 
disconnect_db();
?>
 
<!DOCrole html>
<html>
    <head>
    <link rel="stylesheet" href="styleADD.css" />

        <title>Update</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Update </h1>
        <hr style="width:70%;text-align:center;">
        <form method="post" action="edit.php?id=<?php echo $data['product_id']; ?>">
            <table cellspacing="0" cellpadding="10">
            <tr>
                    <td>ID</td>
                    <td>
                        <input type="text" name="product_id" value="<?php echo !empty($data['product_id']) ? $data['product_id'] : ''; ?>"/>
                        <?php if (!empty($errors['product_id'])) echo $errors['product_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td>product_name</td>
                    <td>
                        <input type="text" name="product_name" value="<?php echo !empty($data['product_name']) ? $data['product_name'] : ''; ?>"/>
                        <?php if (!empty($errors['product_name'])) echo $errors['product_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>product_description</td>
                    <td>
                        <input type="text" name="product_description" value="<?php echo !empty($data['product_description']) ? $data['product_description'] : ''; ?>"/>
                        <?php if (!empty($errors['product_description'])) echo $errors['product_description']; ?>
                    </td>
                </tr>
                <tr>
                    <td>product_startdate</td>
                    <td>
                        <input type="text" name="product_startdate" value="<?php echo !empty($data['product_startdate']) ? $data['product_startdate'] : ''; ?>"/>
                        <?php if (!empty($errors['product_startdate'])) echo $errors['product_startdate']; ?>
                    </td>
                </tr>
                <tr>
                    <td>product_enddate</td>
                    <td>
                        <input type="text" name="product_enddate" value="<?php echo !empty($data['product_enddate']) ? $data['product_enddate'] : ''; ?>"/>
                        <?php if (!empty($errors['product_enddate'])) echo $errors['product_enddate']; ?>
                    </td>
                </tr>
                <tr>
                    <td>product_price</td>
                    <td>
                        <input type="text" name="product_price" value="<?php echo !empty($data['product_price']) ? $data['product_price'] : ''; ?>"/>
                        <?php if (!empty($errors['product_price'])) echo $errors['product_price']; ?>
                    </td>
                </tr>

            </table>
            <hr style="width:70%;text-align:center;">
            <input id="add" onclick="window.location = 'list.php'" type="button" value="Back to account list"/>
            <input id="save" type="submit" name="edit" value="Save"/>

        </form>
    </body>
</html>