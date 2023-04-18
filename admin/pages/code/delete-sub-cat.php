<?php
include "../includes/db.php";

$id = $_GET['id'];

// Get the subcategory name from the database
$statement = $con->prepare("SELECT sub_cat_name FROM sub_cat WHERE cat_id = :id");
$statement->bindParam(':id', $id);
$statement->execute();

echo $id;

if ($statement->rowCount() > 0) {
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $sub_cat_name = $result['sub_cat_name'];

    // Delete the subcategory from the database
    $del = $con->prepare("DELETE FROM sub_cat WHERE cat_id = :id");
    $del->bindParam(':id', $id);

    if ($del->execute()) {
        header('location:../forms/sub_category.php?success=' . urlencode('Subcategory "<strong>' . $sub_cat_name . '</strong>" Deleted Successfully'));
    } else {
        header('location:../forms/sub_category.php?error=' . urlencode('Failed to delete subcategory. Please try again.'));
    }
} else {
    header('location:../forms/sub_category.php?error=' . urlencode('Subcategory not found.'));
}
?>