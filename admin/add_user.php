<?php 
    
    include("includes/header.php"); 

    if(!$session->is_signed_in()){

        redirect("login.php");

    }

    $msg = "";

    if(isset($_POST['submit'])){

        $user = new User();

        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        $user->set_file($_FILES['user_image']);

        if($user->updateOrCreate() && $user->uploadUserPhoto()){

            $msg = "File uploaded successfully.";

        } else {

            $msg =  join("<br>", $user->custom_err);

        }

    }

?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include("includes/top_nav.php"); ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php"); ?>

        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <form enctype="multipart/form-data" method="post">
                
                    <div class="col-md-6 col-md-offset-3">

                        <div class="form-group">
                            <p><?php echo $msg; ?></p>
                        </div>

                        <div class="form-group">
                            <label for="user_image">Image</label>
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit" name="submit">Submit</button>
                        </div>
                    
                    </div>
                    <!-- /.col-md-8 -->

                </form>

            </div>
            <!-- /.row-->

        </div>
        <!-- /.container-fluid -->
        
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>