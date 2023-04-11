<?php

include "../includes/header.php";

$message = '';
$error = '';
$formdata = array();

if (isset($_POST['add_sub_cat'])) {

    if (empty($_POST['sub_cat_name'])) {
        $error .= '<li>Sub Category Name is required</li>';
    } else {
        $formdata['sub_cat_name'] = trim($_POST['sub_cat_name']);
        $formdata['cat_id'] = trim($_POST['cat_id']);
    }

    if ($error == '') {
        $query = "SELECT * FROM sub_cat WHERE sub_cat_name = '" . $formdata['sub_cat_name'] . "'";

        $statement = $con->prepare($query);

        $statement->execute();

        if ($statement->rowCount() > 0) {
            $error = '<li>Sub Category Name Already Exists</li>';
        } else {
            $data = array(
                ':sub_cat_name' => $formdata['sub_cat_name'],
                ':cat_id' => $formdata['cat_id']

            );

            $query = "INSERT INTO sub_cat (sub_cat_name, cat_id) VALUES (:sub_cat_name, :cat_id)";

            $statement = $con->prepare($query);

            $statement->execute($data);

            header('location:sub-category.php?msg=add');
        }
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

function show_sub_cat()
{
    include "../includes/db.php";
    $get_cat = $con->prepare("select * from sub_cat");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    $i = 1;
    while ($row = $get_cat->fetch()):
        $id = $row['cat_id'];
        $get_c = $con->prepare("select * from cat where cat_id = '$id'");
        $get_c->setFetchMode(PDO::FETCH_ASSOC);
        $get_c->execute();
        $row_cat = $get_c->fetch();
        echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $row['sub_cat_name'] . "</td>
                <td>" . $row_cat['cat_name'] . "</td>
                <td><a href='#'class='btn btn-warning'>
  <i class='fas fa-edit'></i> Edit</a></td>
                <td><a href='#'class='btn btn-danger'>
  <i class='fas fa-trash'></i> Delete</a></td>
              </tr>";
    endwhile;
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

            $formdata['sub_cat_name'] = $_POST['sub_cat_name'];
            header('location:sub-category.php?msg=add&sub_cat_name=' . urlencode($formdata['sub_cat_name']));
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
                            <p>
                                <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Add Sub Category
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select class="form-control select2" name="cat_id" style="width: 100%;">
                                                    <option value="">Select Category</option>
                                                    <?php echo select_cat() ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="sub_cat_name" class="form-control" id="categoryName" placeholder="Enter Category Name">
                                            </div>
                                            <button name="add_sub_cat" class="btn btn-primary">Submit</button>
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
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php echo show_sub_cat(); ?>
                    </tr>

                </tbody>

            </table>


            <?php

            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'add') {
                    echo '<div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto" role="alert">New sub category ' . $_POST['sub_cat_name'] . ' added 
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
        include "../includes/footer.php"
        ?>