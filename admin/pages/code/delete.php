<?php
include "../includes/db.php";

$id = $_GET['id'];

// Get the category name from the database
$statement = $con->prepare("SELECT cat_name FROM cat WHERE cat_id = :id");
$statement->bindParam(':id', $id);
$statement->execute();

if ($statement->rowCount() > 0) {
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $cat_name = $result['cat_name'];

    // Delete the category from the database
    $del = $con->prepare("DELETE FROM cat WHERE cat_id = :id");
    $del->bindParam(':id', $id);

    if ($del->execute()) {
        header('location:../forms/category.php?success=' . urlencode('Category "<strong>' . $cat_name . '</strong>" Deleted Successfully'));
    } else {
        header('location:../forms/category.php?danger=' . urlencode('Failed to delete category. Please try again.'));
    }
} else {
    header('location:../forms/category.php?danger=' . urlencode('Category not found.'));
}
?>