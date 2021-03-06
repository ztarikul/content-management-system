
<?php require 'header.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php require'nav.php' ?>
    
    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome Admin
                    <small>Author</small>
                </h1>
                <?php 
                if(isset($_GET['source'])){
                    $source = $_GET['source'];

                }
                else{
                    $source = '';
                }
                switch($source){
                    case 'add_post';
                    require 'add_post.php';
                    break;

                    case 'edit_post';
                    require 'edit_post.php';
                    break;

                    case '200';
                    echo "NICE 200";
                    break;
                    default:
                    require 'view_all_comments.php';
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
    <?php require 'footer.php'; ?>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
