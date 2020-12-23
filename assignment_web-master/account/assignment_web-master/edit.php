<?php
 
require './libs/function.php';
// Lấy thông tin hiển thị lên để người dùng sửa
$account_id = isset($_GET['account_id']) ? (int)$_GET['account_id'] : '';
if ($account_id){
    $data = get($account_id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit']))
{
    // Lay data
    $data['account_id']        = isset($_POST['account_id']) ? $_POST['account_id'] : '';
    $data['username']         = isset($_POST['username']) ? $_POST['username'] : '';
    $data['password']    = isset($_POST['password']) ? $_POST['password'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['role']    = isset($_POST['role']) ? $_POST['role'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['account_id'])){
        $errors['account_id'] = 'Ban chua nhap id';
    }
    
    if (empty($data['username'])){
        $errors['username'] = 'Ban chua nhap username';
    }
    if (empty($data['password'])){
        $errors['password'] = 'Ban chua nhap password';
    }
    if (empty($data['email'])){
        $errors['email'] = 'Ban chua nhap email';
    }
    if (empty($data['role'])){
        $errors['role'] = 'Ban chua nhap role';
    }
    // Neu ko co loi thi insert
    if (!$errors){
        edit($data['account_id'], $data['username'], $data['password'],$data['email'],$data['role']);
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

        <title>Thêm sinh vien</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Update </h1>
        <hr style="width:70%;text-align:center;">

        <form method="post" action="edit.php?id=<?php echo $data['account_id']; ?>">
            <table cellspacing="0" cellpadding="10">
            <tr>
                    <td>ID</td>
                    <td>
                        <input type="text" name="account_id" value="<?php echo !empty($data['account_id']) ? $data['account_id'] : ''; ?>"/>
                        <?php if (!empty($errors['account_id'])) echo $errors['account_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td>username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo !empty($data['username']) ? $data['username'] : ''; ?>"/>
                        <?php if (!empty($errors['username'])) echo $errors['username']; ?>
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="text" name="password" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>"/>
                        <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>"/>
                        <?php if (!empty($errors['email'])) echo $errors['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td>role</td>
                    <td>
                        <select name="role">
                            <option value='Admin'>Admin</option>
                            <option value='User'>User</option>
                        </select>
                        <?php if (!empty($errors['role'])) echo $errors['role']; ?>
                    </td>
                </tr>
                
                   
            </table>
            <hr style="width:70%;text-align:center;">
            <input id="add" onclick="window.location = 'list.php'" type="button" value="Back to account list"/>
            <input id="save" type="submit" name="edit" value="Save"/>

        </form>
    </body>
</html>