<?php
    if(isset($_POST['add_user'])){
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images");

        if(empty($user_name) || empty($user_password) || empty($user_first_name) || empty($user_last_name) || empty($user_email)){

            echo "<script>alert('Fields cannot be blank!');</script>";

        } else {

            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            if(!$select_randsalt_query){
                die("QUERY FAILED " . mysqli_error($connection));
            }

            $row = mysqli_fetch_assoc($select_randsalt_query);
            $salt = $row['randSalt'];

            $hashed_password = crypt($user_password, $salt);

            $query = "INSERT INTO users(user_name, user_password, user_first_name, user_last_name, user_email, user_image, user_role) ";
            $query .= "VALUES('{$user_name}','{$hashed_password}','{$user_first_name}','{$user_last_name}','{$user_email}','{$user_image}','{$user_role}')";
        
            $add_user_query = mysqli_query($connection, $query);

            confirm_query($add_user_query);
            header("Location: users.php");
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" name="user_first_name">
    </div>

    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" name="user_last_name">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role">
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
    </div>

</form>