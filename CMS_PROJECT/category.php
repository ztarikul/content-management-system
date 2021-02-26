<?php require 'header.php'; ?>

 <!-- Navigation -->
<?php  require 'nav.php'; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php


                if(isset($_GET['category'])){

                    $post_category_id = $_GET['category'];
                }
                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100);
                 
                    ?>
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_title ?></p>
                <hr>
                <img class="img-responsive" style="width:900px; height:300px;" src="image/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } ?>
                
             
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php require 'slidebar.php'; ?>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                

            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php require 'footer.php' ?>