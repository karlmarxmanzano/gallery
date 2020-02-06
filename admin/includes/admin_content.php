<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            <?php

                // $result = User::find_all_users();

                // while($rows = mysqli_fetch_assoc($result)){
                //     echo $rows['first_name'] . "<br/>";
                // }

                // $found_user = User::find_user_by_id(1);

                // $user = new User();

                // $user->id = $found_user["id"];
                // $user->username = $found_user["username"];
                // $user->password = $found_user["password"];
                // $user->first_name = $found_user["first_name"];
                // $user->last_name = $found_user["last_name"];

                // echo $found_user["first_name"];

                // $user = User::instantation($found_user);

                // echo $user->id;

                // echo $user->username;

                // $users = $result = User::find_all_users();

                // foreach ($users as $user) {
                    
                //     echo $user->username . "<br/>";

                // }

                // $user = $result = User::find_user_by_id(1);

                // echo $user->username;

                // $user = new User();

                // $user->username = "cmanzano";
                // $user->password = "123123123";
                // $user->first_name = "New User";
                // $user->last_name = "Manzano";

                // $user->create();

                // $user = User::find_by_id(4);
                // $user->last_name = "Macato - Manzano";

                // $user->update();

                // $user = User::find_by_id(5);

                // $user->delete();

                // $photo = new Photo();

                // $photo->title = "Image from Udemy";
                // $photo->description = "This is a sample description again";
                // $photo->filename = "new_image.jpeg";
                // $photo->type = "image";
                // $photo->size = "12";

                // $photo->create();

                // $photos = Photo::find_all();

                // foreach ($photos as $photo) {
                //     echo $photo->title;
                // }

                echo DS . "<br>";
                echo SITE_ROOT . "<br>";
                echo INCLUDES_PATH . "<br>";

            ?>
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

</div>
