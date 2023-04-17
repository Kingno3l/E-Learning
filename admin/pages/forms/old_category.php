<?php

include "../includes/header.php";

$message = '';
$error = '';
$formdata = array();

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
                ':cat_name' => $formdata['cat_name']
            );

            $query = "INSERT INTO cat (cat_name) VALUES (:cat_name)";

            $statement = $con->prepare($query);

            $statement->execute($data);

            header('location:category.php?msg=add');
        }
    }
}

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
                <td><a href='category.php?edit_cat=" . $row['cat_id'] . "' class='btn btn-warning'>
  <i class='fas fa-edit' ></i> Edit</a></td>
                <td><a href='category.php?edit_cat=" . $row['cat_id'] . "' class='btn btn-danger'>
  <i class='fas fa-trash'></i> Delete</a></td>
              </tr>";
    endwhile;
}

function edit_cat()
{
    $error = '';
    include "../includes/db.php";
    $id = $_GET['edit_cat'];

    $get_cat = $con->prepare("select * from cat where cat_id = '$id'");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    $row = $get_cat->fetch();
    
    


    echo '
    <h3>Edit Category</h3>
    
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" name="cat_name" value="' . $row['cat_name'] . '" class="form-control" id="categoryName" placeholder="Enter Category Name">
                                            </div>
                                            <button name="edit_cat" class="btn btn-primary">Submit</button>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
';

    if (isset($_POST['edit_cat'])) {


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
                    ':cat_name' => $formdata['cat_name']
                );

                $query = "UPDATE cat SET cat_name = :cat_name WHERE cat_id = $id";

                $statement = $con->prepare($query);

                $statement->execute($data);

                header('location:sub-category.php');
            }
        }
    }
}


// Close the database connection when you're done
$con = null;
?>






<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php

        include "../includes/navbar.php"
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php

        include "../includes/main-sidebar.php"
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php

            $formdata['cat_name'] = $_POST['cat_name'];
            header('location:category.php?msg=add&cat_name=' . urlencode($formdata['cat_name']));
            ?>
            <!-- Main content -->

            <?php

            if ($error != '') {
                echo '<div class="alert alert-warning alert-dismissible fade show col-md-6 mx-auto" role="alert"><ul class="list-unstyled">' . $error . '</ul> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';
            }
            ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div>

                            <div class="card card-body">
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php if (isset($_GET['edit_cat'])) {

                                    echo edit_cat();
                                } else {
                                ?>

                                    <p>
                                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Add Category
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <input type="text" name="cat_name" class="form-control" id="categoryName" placeholder="Enter Category Name">
                                                    </div>
                                                    <button name="add_cat" class="btn btn-primary">Submit</button>
                                                </div>
                                                <!-- /.card-body -->
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TABLES -->
                <table id="example2" class="table table-bordered table-hover col-md-6">
                    <thead>
                        <tr>
                            <th>SR Number</th>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php echo show_cat(); ?>
                        </tr>

                    </tbody>

                </table>

                <?php


                                    if (isset($_GET['msg'])) {
                                        if ($_GET['msg'] == 'add') {
                                            echo '<div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto" role="alert">New category ' . $formdata['cat_name'] . ' added 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
                                        }
                                    }


                ?>


                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        <?php
                                    include "../includes/footer.php";
                                }
        ?>