<?php 
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];

        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $select_post_by_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post_by_id)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_content = $row['post_content'];
        }
    }

    if(isset($_POST['edit_post'])){
        
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];

        move_uploaded_file($post_image_temp, "../img/$post_image");

        $post_content = filter_var($post_content, FILTER_SANITIZE_STRING);
        $post_title = filter_var($post_title, FILTER_SANITIZE_STRING);

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query.= "post_title = '{$post_title}', ";
        $query.= "post_category_id = '{$post_category_id}', ";
        $query.= "post_date = now(), ";
        $query.= "post_author = '{$post_author}', ";
        $query.= "post_status = '{$post_status}', ";
        $query.= "post_tags = '{$post_tags}', ";
        $query.= "post_content = '{$post_content}', ";
        $query.= "post_image = '{$post_image}' ";
        $query.= "WHERE post_id = {$post_id}";

        $update_post = mysqli_query($connection, $query);

        confirm_query($update_post);

        header("Location: posts.php");
        
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category" id="post_category" >
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                confirm_query($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
    </div>
<?php 

    if($post_status == 'PUBLISHED'){
?>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="PUBLISHED" selected="selected">PUBLISHED</option>
            <option value="DRAFT">DRAFT</option>
        </select>
    </div>
<?php
                } else {

?>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="PUBLISHED">PUBLISHED</option>
            <option value="DRAFT" selected="selected">DRAFT</option>
        </select>
    </div>
<?php
                }
?>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100" src="../img/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="summernote" name="post_content"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Save Changes">
    </div>

</form>