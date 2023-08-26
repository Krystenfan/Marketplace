<?php

if (!isset($_SESSION['can302'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
elseif(isset($_GET['name'])) {
    echo $_GET['name'];
    $delete_p_cat_name = $_GET['name'];
    $delete_p_cat = "delete from product_category where name='$delete_p_cat_name'";
    $run_p_cat = mysqli_query($con,$delete_p_cat);
    if ($run_p_cat) {
        echo "<script>alert('Delete one product category successfully.')</script>";
        echo "<script>window.open('index.php?category=view','_self')</script>";
    }
   
}


?>
