<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
<?php 
                       if(isset($_GET['source'])){
                            $source = $_GET['source'];
                       } else {
                           $source = '';
                       }

                       switch($source) {
                            case 'add_comment';
                            echo "<h1 class=page-header>Add New Comment</h1>";
                            include "includes/add_comment.php";
                            break;

                            case 'edit_comment';
                            echo "<h1 class=page-header>Edit Comment</h1>";
                            include "includes/edit_comment.php";
                            break;

                            default:
                                echo "<h1 class=page-header>All Comments</h1>";
                                include "includes/view_all_comments.php";
                                break;
                       }
?>

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