<?php

    function confirm_query($query){
        global $connection;
        if(!$query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }

    function insert_categories(){
        global $connection;

        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)){
                echo "ERROR: This field cannot be empty, please try again.";
            } else {
                $query = "INSERT INTO categories(cat_title)";
                $query .= "VALUE('{$cat_title}')";

                $create_category_query = mysqli_query($connection, $query);

                confirm_query($create_category_query);
            }

        }

    }

    function find_all_categories(){
        global $connection;

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?update_cat={$cat_id}'>Update</a></td>";
            echo "<td><a href='categories.php?delete_cat={$cat_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }

    function find_all_posts(){
        global $connection;

        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];

            echo "<tr>";
            echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>";
            echo "<td><a href='../post.php?post_id={$post_id}'>$post_title</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_date</td>";

            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";
            }

            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../img/$post_image' alt='image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit Post</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Confirm Delete?');\" href='posts.php?delete={$post_id}'>Delete Post</a></td>";
            echo "</tr>";
        }
    }

    function find_all_comments(){
        global $connection;

        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            echo "<td>$comment_date</td>";

            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
            $select_post_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_post_id)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</td>";
            }

            echo "<td><a href='comments.php?approve_comment={$comment_id}'>Approve Comment</a></td>";
            echo "<td><a href='comments.php?pend_comment={$comment_id}'>Pend Comment</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Confirm Delete?'); \" href='comments.php?delete_comment={$comment_id}'>Delete Comment</a></td>";
            echo "</tr>";
        }
    }

    function find_all_users(){
        global $connection;

        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>$user_name</td>";
            echo "<td>$user_first_name</td>";
            echo "<td>$user_last_name</td>";
            echo "<td>$user_email</td>";
            echo "<td><img width='100' src='../img/$user_image' alt='image'></td>";
            echo "<td>$user_role</td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit User</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Confirm Delete?');\" href='users.php?delete_user={$user_id}'>Delete User</a></td>";
            echo "</tr>";
        }
    }

    function delete_user(){
        global $connection;

        if(isset($_GET['delete_user'])){
            $deleted_user_id = $_GET['delete_user'];
            $query = "DELETE FROM users WHERE user_id = {$deleted_user_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);

            header("Location: users.php");
        }
    }

    function delete_category(){
        global $connection;

        if(isset($_GET['delete_cat'])){
            $deleted_cat_id = $_GET['delete_cat'];
            $query = "DELETE FROM categories WHERE cat_id = {$deleted_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);

            header("Location: categories.php");
        }
    }

    function delete_comment(){
        global $connection;

        if(isset($_GET['delete_comment'])){
            $deleted_comment_id = $_GET['delete_comment'];
            $query = "DELETE FROM comments WHERE comment_id = {$deleted_comment_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);

            header("Location: comments.php");
        }
    }
    function approve_comment(){
        global $connection;

        if(isset($_GET['approve_comment'])){
            $approved_comment_id = $_GET['approve_comment'];
            $query = "UPDATE comments SET comment_status = 'APPROVED' WHERE comment_id = $approved_comment_id";
            $approve_query = mysqli_query($connection, $query);
            confirm_query($approve_query);

            header("Location: comments.php");
        }
    }

    function pend_comment(){
        global $connection;

        if(isset($_GET['pend_comment'])){
            $pending_comment_id = $_GET['pend_comment'];
            $query = "UPDATE comments SET comment_status = 'PENDING' WHERE comment_id = $pending_comment_id";
            $pend_query = mysqli_query($connection, $query);
            confirm_query($pend_query);

            header("Location: comments.php");
        }
    }

    function delete_post(){
        global $connection;

        if(isset($_GET['delete'])){
            $deleted_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$deleted_post_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);

            header("Location: posts.php");
        }
    }

    

?>