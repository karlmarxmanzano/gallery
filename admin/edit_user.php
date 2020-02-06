<?php 
    
    include("includes/header.php"); 

    if(!$session->is_signed_in()){

        redirect("login.php");

    }

    $msg = "";

    if(empty($_GET['id'])){

        redirect("users.php");

    } else {

        $user = User::find_by_id($_GET['id']);

        if($user){

            if(isset($_POST['update'])){

                $user->username = $_POST['username'];
                $user->password = $_POST['password'];
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];

                if(!empty($_FILES['user_image'])){

                    $user->set_file($_FILES['user_image']);
                    $user->uploadUserPhoto();

                }

                $user->updateOrCreate();


                // if($user->updateOrCreate()){

                //     $msg = "User updated successfully.";

                // } else {

                //     $msg =  join("<br>", $user->custom_err);

                // }

            }

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

                <div class="col-md-6">
                        
                    <img src="<?php echo $user->img_path(); ?>" alt="" class="img-responsive">

                </div>

                <div class="col-md-6">

                    <form enctype="multipart/form-data" method="post">
                    
                            <div class="form-group">
                                <p><?php echo $msg; ?></p>
                            </div>

                            <div class="form-group">
                                <label for="user_image">Image</label>
                                <input type="file" name="user_image">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>

                            <div class="form-group">
                                <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger pull-left">Delete</a>
                                <button class="btn btn-primary pull-right" type="submit" name="update">Update</button>
                            </div>

                    </form>

                </div>
                <!-- /.col-md-8 -->

            </div>
            <!-- /.row-->

        </div>
        <!-- /.container-fluid -->
        
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>