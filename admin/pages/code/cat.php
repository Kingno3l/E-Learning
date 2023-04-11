
<?php

$message = '';
$error = '';
$formdata = array();




// Execute SQL queries here
// if (isset($_POST['add_cat'])) {

//     if (empty($_POST['cat_name'])) {
//         $error .= 'Category name required';
//     }


//     $cat_name = $_POST['cat_name'];

//     $add_cat = $con->prepare("INSERT INTO cat (cat_name) VALUES (:cat_name)");
//     $add_cat->bindParam(':cat_name', $cat_name);
//     if ($add_cat->execute()) {
//         echo "Category added successfully!";
//     } else {
//         $errorInfo = $add_cat->errorInfo();
//         die("Failed to add category: " . $errorInfo[2]);
//     }
// }



if (isset($_POST['add_cat'])) {

    if (empty($_POST['cat_name'])) {
        $error .= '<li>Category Name is required</li>';
    } else {
        $formdata['cat_name'] = trim($_POST['cat_name']);
    }

    if ($error == '') {
        $query = "SELECT * FROM cat WHERE cat_name = '" . $formdata['cat_name'] . "'";

        $statement = $con->prepare($query);

        $statement->execute();

        if ($statement->rowCount() > 0) {
            $error = '<li>Category Name Already Exists</li>';
        } else {
            $data = array(
                ':cat_name'            =>    $formdata['cat_name']
            );

            $query = "INSERT INTO cat (cat_name) VALUES (:cat_name)";

            $statement = $con->prepare($query);

            $statement->execute($data);

            header('location:category.php?msg=add');
        }
    }
}


// Close the database connection when you're done
$con = null;
?>