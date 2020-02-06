<?php include("includes/header.php"); ?>

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

            <div>

                <a href="add_user.php" class="btn btn-primary">Add New User</a>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $users = User::find_all();

                            foreach ($users as $user) : 

                        ?>

                            <tr>
                                <td>
                                    <img src="<?php echo $user->img_path(); ?>" alt="" class="admin-photo-thumbnail">
                                </td>
                                <td>
                                    <?php echo $user->id; ?>
                                </td>
                                <td>
                                    <?php echo $user->username; ?>
                                    <div class="actions-link">
                                        <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                        <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <?php echo $user->password; ?>
                                </td>
                                <td>
                                    <?php echo $user->first_name; ?>
                                </td>
                                <td>
                                    <?php echo $user->last_name; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>

        </div>
        <!-- /.container-fluid -->
        
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>