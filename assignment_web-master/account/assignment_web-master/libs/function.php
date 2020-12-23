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
    $sql = "select * from account";
    $query = mysqli_query($conn, $sql);
    $result = array();
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
}

function get_page()
{
    global $conn;
    connect_db();
    $sql = "select count(account_id) as total from account";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];

    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 3;

    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    
    $result = mysqli_query($conn, "SELECT * FROM account LIMIT $start, $limit");
    return $result;
}

function get($account_id)
{
    global $conn;
    connect_db();
    $sql = "select * from account where account_id = {$account_id}";
    $query = mysqli_query($conn, $sql);
    $result = array();
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
}

function add($account_id, $username, $password,$email,$role)
{
    global $conn;
    connect_db();
    $account_id = addslashes($account_id);
    $username = addslashes($username);
    $password = addslashes($password);
    $email = addslashes($email);
    $role = addslashes($role);
    $sql = "
            INSERT INTO account(account_id,username,password,email,role) VALUES
            ('$account_id','$username','$password','$email','$role')
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}

function edit($account_id, $username, $password,$email,$role)
{
    global $conn;
    connect_db();
    $account_id = addslashes($account_id);
    $username = addslashes($username);
    $password = addslashes($password);
    $email = addslashes($email);
    $role = addslashes($role);
 
    $sql = "
            UPDATE account SET
            username = '$username',
            password = '$password',
            email = '$email',
            role = '$role'
            WHERE account_id=$account_id
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}
function delete($account_id)
{
    global $conn;
    connect_db();
    $sql = "
            DELETE FROM account
            WHERE account_id = $account_id
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}