<?php
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $post_value_id){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'PUBLISHED':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_value_id}";
                    $update_to_published_status = mysqli_query($connection, $query);
                    confirm_query($update_to_published_status);

                    break;

                case 'DRAFT':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_value_id}";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confirm_query($update_to_draft_status);

                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$post_value_id}";
                    $delete_selected_posts = mysqli_query($connection, $query);
                    confirm_query($delete_selected_posts);

                    break;

                case 'clone' :
                    $query = "SELECT * FROM posts WHERE post_id = '{postValueID}' ";
                    $select_post_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_post_query)){
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    
                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_status, post_image, post_tags, post_content) ";
                        $query.= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                        $clone_selected_posts = mysqli_query($connection, $query);
                        confirm_query($clone_selected_posts);

                    }

                    break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <h4>Bulk Options</h4>
        <div id="bulkOptionsContainer" class="col-xs-1" style="padding:">
            <select class="form-control" name="bulk_options" id="">
                <option value="PUBLISHED">Publish</option>
                <option value="DRAFT">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Edit Post</th>
                <th>Delete Post</th>
            </tr>
        </thead>
        <tbody>
            <?php

                    find_all_posts();

                    delete_post();

            ?>
        </tbody>
        
    </table>
</form>
