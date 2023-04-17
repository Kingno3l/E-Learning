
<?php
include "../includes/db.php";

$id = $_GET['id'];

if (isset($_POST['edit_cat'])) {
    $formdata['cat_name'] = trim($_POST['cat_name']);

    if (empty($formdata['cat_name'])) {
        header('location:../forms/category.php?error=A Valid Category Name is required');
        exit;
    }

    $id = intval($_POST['cat_id']);

    $query = "SELECT * FROM cat WHERE cat_name = :cat_name AND cat_id != :id";

    $statement = $con->prepare($query);

    $statement->bindParam(':cat_name', $formdata['cat_name']);
    $statement->bindParam(':id', $id);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        header('location:../forms/category.php?error=Category "<strong>' . $_POST['cat_name'] . '</strong>" Already Exists');
        exit;
    } else {
        $data = array(
            ':cat_name' => $formdata['cat_name'],
            ':id' => $id
        );

        $query = "UPDATE cat SET cat_name = :cat_name WHERE cat_id = :id";

        $statement = $con->prepare($query);

        if ($statement->execute($data)) {
            header('location:../forms/category.php?success=Category "<strong>' . $_POST['cat_name'] . '</strong>" Updated Successfully');
            exit;
        } else {
            header('location:../forms/category.php?error=Failed to update category. Please try again.');
            exit;
        }
    }
}
?>