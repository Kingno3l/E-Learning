<?php
include "../includes/db.php";

if (isset($_POST['add_sub_cat'])) {

    $formdata['sub_cat_name'] = trim($_POST['sub_cat_name']);

    if (empty($formdata['sub_cat_name'])) {
        header('location:../forms/sub_category.php?error=A Valid Sub Category Name is required');
        exit;
    }

    $query = "SELECT * FROM sub_cat WHERE sub_cat_name = :sub_cat_name";
    $statement = $con->prepare($query);
    $statement->bindParam(':sub_cat_name', $formdata['sub_cat_name']);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        header('location:../forms/sub_category.php?error=sub_Category "<strong>' . $_POST['sub_cat_name'] . '</strong>" Already Exist');
    } else {
        $data = array(
            ':sub_cat_name' => $formdata['sub_cat_name'],
            ':cat_id' => $_POST['cat_id'] // add cat_id parameter
        );

        $query = "INSERT INTO sub_cat (sub_cat_name, cat_id) VALUES (:sub_cat_name, :cat_id)";
        $statement = $con->prepare($query);
        $statement->execute($data);

        header('location:../forms/sub_category.php?success=Sub Category "<strong>' . $_POST['sub_cat_name'] . '</strong>" Added Successfully');
        $con = null;
    }
}

function select_cat()
{
    include "../includes/db.php";
    $get_cat = $con->prepare("select * from cat");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    while ($row = $get_cat->fetch()) :
        echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
    endwhile;
}
?>


