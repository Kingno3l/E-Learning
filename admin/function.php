<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function add_cat()
{
    include("inc/db.php");
    if (isset($_POST['add_cat'])) {
        $cat_name = $_POST['cat_name'];
        echo $cat_name;

        $add_cat = $con->prepare("insert into cat(cat_name) values ('$cat_name')");
        if ($add_cat->execute()) {
            echo "<script>alert('cat added')</script>";
            echo "<script>window.open('index.php?cat','_self')</script>";
        } else {
            echo "<script>alert('cat not added')</script>";
            echo "<script>window.open('index.php?cat','_self')</script>";
        }
    }
}
