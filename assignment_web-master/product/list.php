<?php
require './libs/function.php';
global $conn;
connect_db();
$sql = "select count(product_id) as total from products";
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
$result = mysqli_query($conn, "SELECT * FROM products LIMIT $start, $limit");

$function=$result;
?>

<!DOCrole html>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>PRODUCT LIST</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>PRODUCT LIST</h1>
        <hr style="width:70%;text-align:center;">
        <div class="flex">
            <input id="add" onclick="window.location = 'add.php'" type="button" value="Add account"/>
        </div>
        <div>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Product ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Price</td>
                <th>Option</th>
            </tr>
            <?php foreach ($function as $item){ ?>
            <tr>
                <td><?php echo $item['product_id']; ?></td>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['product_description']; ?></td>
                <td><?php echo $item['product_startdate']; ?></td>
                <td><?php echo $item['product_enddate']; ?></td>
                <td><?php echo $item['product_price']; ?></td>
                <td>
                        <form class="option" method="post" action="delete.php">
                            <input id="fix" onclick="window.location = 'edit.php?product_id=<?php echo $item['product_id']; ?>'" type="button" value="Update"/>
                            <input id="fix" type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>"/>
                            <input id="delete" onclick="return confirm('Are you sure?');" type="submit" name="delete" value="Delete"/>
                        </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        </div>
        
        <br>
    </body>
<div class="page">
    <?php
        echo '<a href="list.php?page='.($current_page-1).'">&laquo;</a>  ';
    
    
    // Lặp khoảng giữa
    for ($i = 1; $i <= $total_page; $i++){
        // Nếu là trang hiện tại thì hiển thị thẻ span
        // ngược lại hiển thị thẻ a
        if ($i == $current_page){
            echo '<span>'.$i.'</span>  ';
        }
        else{
            echo '<a href="list.php?page='.$i.'">'.$i.'</a> ';
        }
    }
    
    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
        echo '<a href="list.php?page='.($current_page+1).'">&raquo;</a>  ';
    
    disconnect_db();
    ?>
</div>
</html>
