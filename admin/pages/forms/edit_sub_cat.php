<?php
include "../includes/header.php";
include "../code/add-category.php"
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

                <?php

                $id = $_GET['id'];

                $get_cat = $con->prepare("select * from sub_cat where sub_cat_id = '$id'");
                $get_cat->setFetchMode(PDO::FETCH_ASSOC);
                $get_cat->execute();
                $row = $get_cat->fetch();
                ?>

                <div class="card card-body">
                    <h3>Edit Category</h3>

                    <form method="post" action="../code/edit-sub-cat.php" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <select class="form-control select2" name="cat_id" style="width: 100%;">
                                    <?php
                                    // Get all categories
                                    $get_cats = $con->prepare("select * from cat");
                                    $get_cats->setFetchMode(PDO::FETCH_ASSOC);
                                    $get_cats->execute();

                                    // Loop through each category and create an option element
                                    while ($cat = $get_cats->fetch()) {
                                        $selected = ($cat['cat_id'] == $row['cat_id']) ? 'selected' : ''; // Check if this category is the current category
                                        echo "
                                                <option value='{$cat['cat_id']}' $selected>{$cat['cat_name']}</option>
                                            ";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="sub_cat_name" value="<?php echo $row['sub_cat_name']; ?>" class="form-control" id="categoryName" placeholder="Enter Category Name">
                                <input type="hidden" name="sub_cat_id" value="<?php echo $id; ?>">
                            </div>
                            <button name="edit_sub_cat" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>
            <!-- Table -->
        </div>
    </div>
</div>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php

include "../includes/footer.php";

?>