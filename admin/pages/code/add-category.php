<?php

include "../includes/db.php";


if (isset($_POST['add_cat'])) {

    $formdata['cat_name'] = trim($_POST['cat_name']);

    if (empty($formdata['cat_name'])) {
        header('location:../forms/category.php?error=A Valid Category Name is required');
        exit;
    }

    $query = "SELECT * FROM cat WHERE cat_name = '" . $formdata['cat_name'] . "'";

    $statement = $con->prepare($query);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        header('location:../forms/category.php?error=Category "<strong>' . $_POST['cat_name'] . '</strong>" Already Exist');
    } else {
        $data = array(
            ':cat_name' => $formdata['cat_name']
        );

        $query = "INSERT INTO cat (cat_name) VALUES (:cat_name)";

        $statement = $con->prepare($query);

        $statement->execute($data);

        header('location:../forms/category.php?success=Category "<strong>' . $_POST['cat_name'] . '</strong>" Added Successfully');

        $con = null;
    }
}

// Show Category Function
function show_cat()
{
    include "../includes/db.php";
    $get_cat = $con->prepare("select * from cat");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    $i = 1;
    while ($row = $get_cat->fetch()) :
        echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $row['cat_name'] . "</td>
                <td><a href='edit.php?id=" . $row['cat_id'] . "' class='btn btn-warning'>
  <i class='fas fa-edit' ></i> Edit</a></td>
                <td><a href='delete.php?id=" . $row['cat_id'] . "' class='btn btn-danger'>
  <i class='fas fa-trash'></i> Delete</a></td>
              </tr>";
    endwhile;

    
    $con = null;
}


// Edit Category Function
function edit_cat()
{
    include "../includes/db.php";

    if (isset($_POST['edit_cat'])) {
        $formdata['cat_name'] = trim($_POST['cat_name']);

        if (empty($formdata['cat_name'])) {
            header('location:../forms/category.php?error=A Valid Category Name is required');
            exit;
        }

        $query = "SELECT * FROM cat WHERE cat_name = '" . $formdata['cat_name'] . "'";

        $statement = $con->prepare($query);

        $statement->execute();

        if ($statement->rowCount() > 0) {
            header('location:../forms/category.php?error=Category "<strong>' . $_POST['cat_name'] . '</strong>" Already Exist');
        } else {
            $data = array(
                ':cat_name' => $formdata['cat_name']
            );
        }
    }

    $formdata['cat_name'] = trim($_POST['cat_name']);

    if (empty($formdata['cat_name'])) {
        header('location:../forms/category.php?error=A Valid Category Name is required');
        exit;
    }

    $query = "SELECT * FROM cat WHERE cat_name = '" . $formdata['cat_name'] . "'";

    $statement = $con->prepare($query);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        header('location:../forms/category.php?error=Category "<strong>' . $_POST['cat_name'] . '</strong>" Already Exist');
    } else {
        $data = array(
            ':cat_name' => $formdata['cat_name']
        );

        $query = "UPDATE cat SET cat_name = :cat_name WHERE cat_id = $id";
        echo $formdata['cat_name'];

        $statement = $con->prepare($query);

        $statement->execute($data);

        header('location:../forms/category.php?success=Category "<strong>' . $_POST['cat_name'] . '</strong>" Updated Successfully');
    }
    edit_cat();
}



