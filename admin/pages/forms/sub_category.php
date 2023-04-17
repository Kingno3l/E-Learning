<?php
include "../includes/header.php";
include "../code/add-sub-category.php"
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show col-md-12 mx-auto" role="alert">
                        <?php echo $_GET['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show col-md-12 mx-auto" role="alert">
                        <?php echo $_GET['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <div class="card card-body">
                    <?php if (isset($_GET['edit_sub_cat'])) {
                        echo edit_cat();
                    } //else {
                    ?>
                    <p>
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add Category
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <form method="POST" action="../code/add-sub-category.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control select2" name="cat_id" style="width: 100%;">
                                        <option value="">Select Category</option>
                                        <?php echo select_cat() ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sub_cat_name" class="form-control" id="sub-categoryName" placeholder="Enter Category Name" required>
                                </div>
                                <button name="add_sub_cat" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table id="example2" class="table table-bordered table-hover col-md-12">
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
                        <?php
                        include "../includes/db.php";
                        $get_cat = $con->prepare("select * from sub_cat");
                        $get_cat->setFetchMode(PDO::FETCH_ASSOC);
                        $get_cat->execute();
                        $i = 1;
                        while ($row = $get_cat->fetch()) :
                            $id = $row['cat_id'];
                            $get_c = $con->prepare("select * from cat where cat_id = '$id'");
                            $get_c->setFetchMode(PDO::FETCH_ASSOC);
                            $get_c->execute();
                            $row_cat = $get_c->fetch();
                            echo "<tr>
                <td>" . $i++ . "</td>     
                 <td>" . $row['sub_cat_name'] . "</td>
                <td>" . $row_cat['cat_name'] . "</td>
                <td><a href='edit.php?id=" . $row['cat_id'] . "' class='btn btn-warning'>
  <i class='fas fa-edit' ></i> Edit</a></td>
                <td><a href='../code/delete-sub-cat.php?id=" . $row['cat_id'] . "' class='btn btn-danger'>
  <i class='fas fa-trash'></i> Delete</a></td>
              </tr>";
                        endwhile;

                        $con = null;
                        ?>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php

include "../includes/footer.php";

?>