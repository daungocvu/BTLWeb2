<?php

require './libs/function.php';

// Nếu người dùng submit form
if (!empty($_POST['add']))
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
        $sql=add($data['product_id'], $data['product_name'],null,$data['product_description'],$data['product_startdate'],$data['product_enddate'],$data['product_price']);
        // Trở về trang danh sách
        header("location: list.php");
    }
}

disconnect_db();
?>
<?php
if (isset($_POST['up']) && isset($_FILES['fileUpload'])) {
    if ($_FILES['fileUpload']['error'] > 0)
        echo "Upload lỗi rồi!";
    else {
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'upload/' . $_FILES['fileUpload']['name']);
        echo "upload thành công <br/>";
        echo 'Dường dẫn: upload/' . $_FILES['fileUpload']['name'] . '<br>';
        echo 'Loại file: ' . $_FILES['fileUpload']['type'] . '<br>';
        echo 'Dung lượng: ' . ((int)$_FILES['fileUpload']['size'] / 1024) . 'KB';
    }
}
?>
<!DOCproduct_startdate html>
<html>
    <head>
    <link rel="stylesheet" href="styleADD.css" />
        <title>Add product</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Add product</h1>
        <hr style="width:70%;text-align:center;">
        <form method="post" action="add.php">
            <table cellspacing="0" cellpadding="10">
                <tr>
                    <td>ID</td>
                    <td>
                        <input type="text" name="product_id" value="<?php echo !empty($data['product_id']) ? $data['product_id'] : ''; ?>"/>
                        <?php if (!empty($errors['product_id'])) echo $errors['product_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Product name</td>
                    <td>
                        <input type="text" name="product_name" value="<?php echo !empty($data['product_name']) ? $data['product_name'] : ''; ?>"/>
                        <?php if (!empty($errors['product_name'])) echo $errors['product_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Product description</td>
                    <td>
                        <input type="text" name="product_description" value="<?php echo !empty($data['product_description']) ? $data['product_description'] : ''; ?>"/>
                        <?php if (!empty($errors['product_description'])) echo $errors['product_description']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Product startdate</td>
                    <td>
                        <input type="text" name="product_startdate" value="<?php echo !empty($data['product_startdate']) ? $data['product_startdate'] : ''; ?>"/>
                        <?php if (!empty($errors['product_startdate'])) echo $errors['product_startdate']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Product enddate</td>
                    <td>
                        <input type="text" name="product_enddate" value="<?php echo !empty($data['product_enddate']) ? $data['product_enddate'] : ''; ?>"/>
                        <?php if (!empty($errors['product_enddate'])) echo $errors['product_enddate']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Product price</td>
                    <td>
                        <input type="text" name="product_price" value="<?php echo !empty($data['product_price']) ? $data['product_price'] : ''; ?>"/>
                        <?php if (!empty($errors['product_price'])) echo $errors['product_price']; ?>
                    </td>
                </tr>

            </table>
            <hr style="width:70%;text-align:center;">
            <input id="add" onclick="window.location = 'list.php'" type="button" value="Back to account list"/>
            <input id="save" type="submit" name="add" value="Save"/>
        </form>
    </body>
</html>
