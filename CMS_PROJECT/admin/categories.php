
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
                        Blank Page
                        <small>Subheading</small>
                    </h1>

                   <div class="col-xs-6">
                    <?php  insert_categories(); ?>
    
                   <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Category"> 
                        </div>
                   </form>

                    <?php 
                   if(isset($_GET['edit'])){
                    if(isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] == 'admin'){
                       $cat_id = $_GET['edit'];
                       require "update_category.php";
                        }
                    }
                   }
                   ?>

                   </div>

                   <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Category Title</td>
                                <td>Delete</td>
                                <td>Edit</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php findAllCategories(); ?>
                        

                            

                        <?php deleteCategories(); ?>
                            
                           
                        </tbody>
                    </table>
                   </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
