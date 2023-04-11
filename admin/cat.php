<h1 class="m-0">View All</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 offset-md-10">
            <div>
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
                                <button  name="add_cat" class="btn btn-primary">Submit</button>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//echo add_cat();

if (isset($_POST['add_cat'])) {
        $cat_name = $_POST['cat_name'];

$add_cat = $con->prepare("INSERT INTO cat (cat_name) VALUES (:cat_name)");
$add_cat->bindParam(':cat_name', $cat_name);
    if ($add_cat->execute()) {
        echo "yea";
    } else {
                echo "no yea";

    }
}
?>
