<?php

if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
elseif(isset($_GET['id'])) {
    echo $_GET['id'];
    $delete_order_id = $_GET['id'];
    $delete_order = "delete from orders where id='$delete_order_id'";
    $run_order = mysqli_query($con,$delete_order);
    if ($run_order) {
        echo "<script>alert('Delete one order successfully.')</script>";
        echo "<script>window.open('index.php?orders=view','_self')</script>";
    }
   
}


?>
