<?php include "includes/admin_header.php"; ?>
<?php

    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];
        $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
        $find_user_query = mysqli_query($connection, $query);
        confirm_query($find_user_query);

        while($row = mysqli_fetch_assoc($find_user_query)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }

    if(isset($_POST['edit_user'])){
        
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../img/$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_image)){
                $user_image = $row['user_image'];
            }
        }

        $query = "UPDATE users SET ";
        $query.= "user_name = '{$user_name}', ";
        $query.= "user_password = '{$user_password}', ";
        $query.= "user_first_name = '{$user_first_name}', ";
        $query.= "user_last_name = '{$user_last_name}', ";
        $query.= "user_email = '{$user_email}', ";
        $query.= "user_image = '{$user_image}', ";
        $query.= "user_role = '{$user_role}' ";
        $query.= "WHERE user_id = {$user_id}";

        $update_user = mysqli_query($connection, $query);

        confirm_query($update_user);

        header("Location: ../admin");
        
    }

?>
    <div id="wrapper">

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $user_first_name; ?>'s Profile
                        </h1>
                       <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name">
                            </div>

                            <div class="form-group">
                                <label for="user_password">New Password</label>
                                <input type="password" class="form-control" name="user_password">
                            </div>

                            <div class="form-group">
                                <label for="user_first_name">First Name</label>
                                <input type="text" value="<?php echo $user_first_name; ?>" class="form-control" name="user_first_name">
                            </div>

                            <div class="form-group">
                                <label for="user_last_name">Last Name</label>
                                <input type="text" value="<?php echo $user_last_name; ?>" class="form-control" name="user_last_name">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="user_image">User Image</label>
                                <img width="100" src="../img/<?php echo $user_image; ?>" alt="">
                                <input type="file" name="image">
                            </div>

                        <?php 

                            if($user_role == 'Admin'){
                        ?>
                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <select name="user_role" id="user_role">
                                    <option value="Admin" selected="selected">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        <?php
                            } else {
                        ?>
                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <select name="user_role" id="user_role">
                                    <option value="Admin">Admin</option>
                                    <option value="User" selected="selected">User</option>
                                </select>
                            </div>
                        <?php
                            }
                        ?>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Save Changes">
                            </div>

                        </form>


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