<?php include "includes/admin_header.php"; ?>

<?php

    $query = "SELECT * FROM posts";
    $select_all_posts = mysqli_query($connection, $query);
    confirm_query($select_all_posts);
    $post_count = mysqli_num_rows($select_all_posts);

    $query = "SELECT * FROM comments";
    $select_all_comments = mysqli_query($connection, $query);
    confirm_query($select_all_comments);
    $comment_count = mysqli_num_rows($select_all_comments);

    $query = "SELECT * FROM users";
    $select_all_users = mysqli_query($connection, $query);
    confirm_query($select_all_users);
    $user_count = mysqli_num_rows($select_all_users);

    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);
    confirm_query($select_all_categories);
    $cat_count = mysqli_num_rows($select_all_categories);

?>

    <div id="wrapper">

        <?php include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['user_first_name']; ?> <?php echo $_SESSION['user_last_name']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $post_count; ?></div>
                                        <h4>
                                            <div>Posts</div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comment_count; ?></div>
                                        <h4>
                                            <div>Comments</div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_count; ?></div>
                                        <h4>
                                            <div> Users</div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $cat_count; ?></div>
                                        <h4>
                                            <div>Categories</div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php

                    $query = "SELECT * FROM posts WHERE post_status = 'DRAFT'";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    confirm_query($select_all_draft_posts);
                    $post_draft_count = mysqli_num_rows($select_all_draft_posts);

                    $query = "SELECT * FROM posts WHERE post_status = 'PUBLISHED'";
                    $select_all_published_posts = mysqli_query($connection, $query);
                    confirm_query($select_all_published_posts);
                    $post_active_count = mysqli_num_rows($select_all_published_posts);

                    $query = "SELECT * FROM comments WHERE comment_status = 'APPROVED'";
                    $select_all_approved_comments = mysqli_query($connection, $query);
                    confirm_query($select_all_approved_comments);
                    $approved_comment_count = mysqli_num_rows($select_all_approved_comments);

                    $query = "SELECT * FROM comments WHERE comment_status = 'PENDING'";
                    $select_all_pending_comments = mysqli_query($connection, $query);
                    confirm_query($select_all_pending_comments);
                    $pending_comment_count = mysqli_num_rows($select_all_pending_comments);

                    $query = "SELECT * FROM users WHERE user_role = 'User'";
                    $select_all_subscribers = mysqli_query($connection, $query);
                    confirm_query($select_all_subscribers);
                    $subscriber_count = mysqli_num_rows($select_all_subscribers);

                ?>

                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php 
                            $element_text = ['Active Posts', 'Draft Posts', 'Approved Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_active_count, $post_draft_count, $approved_comment_count, $pending_comment_count, $user_count, $subscriber_count, $cat_count];

                            for($i=0; $i<sizeof($element_text); $i++){
                                echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]}],";
                            }
                        ?>

                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>