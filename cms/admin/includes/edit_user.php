<?php 
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $select_user_by_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user_by_id)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
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

            $query = "UPDATE users SET ";
            $query.= "user_name = '{$user_name}', ";
            $query.= "user_password = '{$hashed_password}', ";
            $query.= "user_first_name = '{$user_first_name}', ";
            $query.= "user_last_name = '{$user_last_name}', ";
            $query.= "user_email = '{$user_email}', ";
            $query.= "user_image = '{$user_image}', ";
            $query.= "user_role = '{$user_role}' ";
            $query.= "WHERE user_id = {$user_id}";

            $update_user = mysqli_query($connection, $query);

            confirm_query($update_user);

            header("Location: users.php");
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name">
    </div>

    <div class="form-group">
        <label for="user_password">New Password</label>
        <input type="password" value="" class="form-control" name="user_password">
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