<?php 

    include("includes/header.php"); 

    if(!$session->is_signed_in()){

        redirect("login.php");

    }

    $msg = "";

    if(isset($_POST['submit'])){

        $photo = new Photo();

        $photo->title = $_POST['title'];
        $photo->set_file($_FILES['file_upload']);

        if($photo->updateOrCreate()){

            $msg = "File uploaded successfully.";

        } else {

            $msg =  join("<br>", $photo->custom_err);

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
                        Uploads
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

            <p><?php echo $msg; ?></p>
            <div class="col-md-5">
                <form enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label for="file_upload">File</label>
                        <input type="file" name="file_upload">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.container-fluid -->
        
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>