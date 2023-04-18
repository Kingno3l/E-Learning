<?php
include "../includes/db.php";

$id = $_POST['sub_cat_id'];
//echo $id;

if (isset($_POST['edit_sub_cat'])) {
    $formdata['sub_cat_name'] = trim($_POST['sub_cat_name']);
    $formdata['cat_id'] = intval($_POST['cat_id']);

    if (empty($formdata['sub_cat_name'])) {
        header('location:../forms/sub_category.php?id=' . $id . '&error=A Valid Sub Category Name is required');
        exit;
    }

    $query = "SELECT * FROM sub_cat WHERE sub_cat_name = :sub_cat_name AND cat_id = :cat_id AND sub_cat_id != :id";

    $statement = $con->prepare($query);

    $statement->bindParam(':sub_cat_name', $formdata['sub_cat_name']);
    $statement->bindParam(':cat_id', $formdata['cat_id']);
    $statement->bindParam(':id', $id);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        header('location:../forms/sub_category.php?id=' . $id . '&error=Sub Category "<strong>' . $_POST['sub_cat_name'] . '</strong>" Already Exists');
        exit;
    } else {
        $data = array(
            ':sub_cat_name' => $formdata['sub_cat_name'],
            ':cat_id' => $formdata['cat_id'],
            ':id' => $id
        );

        $query = "UPDATE sub_cat SET sub_cat_name = :sub_cat_name, cat_id = :cat_id WHERE sub_cat_id = :id";

        $statement = $con->prepare($query);

        if ($statement->execute($data)) {
            header('location:../forms/sub_category.php?id=' . $id . '&success=Sub Category "<strong>' . $_POST['sub_cat_name'] . '</strong>" Updated Successfully');
            exit;
        } else {
            header('location:../forms/sub_category.php?id=' . $id . '&error=Failed to update sub category. Please try again.');
            exit;
        }
    }
}
?>
