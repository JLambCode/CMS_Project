<?php include "includes/admin_header.php"; ?>



    <div id="wrapper">

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

<!-- Add Category Form -->
<?php insert_categories(); ?>

                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            
<?php //Update Category
                            if(isset($_GET['update_cat'])){
                                $cat_id = $_GET['update_cat'];
                                include "includes/update_categories.php";
                            }
?>

                            
                        </div>

<!--  Category List -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category Title</th>
                                        <th>Change Category</th>
                                        <th>Remove Category</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php find_all_categories(); ?>

                                <?php delete_category(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"; ?>