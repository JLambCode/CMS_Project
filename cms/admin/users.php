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
                            case 'add_user';
                            echo "<h1 class=page-header>Add New User</h1>";
                            include "includes/add_user.php";
                            break;

                            case 'edit_user';
                            echo "<h1 class=page-header>Edit User</h1>";
                            include "includes/edit_user.php";
                            break;

                            default:
                                echo "<h1 class=page-header>All Users</h1>";
                                include "includes/view_all_users.php";
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