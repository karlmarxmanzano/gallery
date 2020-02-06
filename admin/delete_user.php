<?php 

    include("includes/header.php"); 

    if(!$session->is_signed_in()){

        redirect("login.php");

    }

    if(isset($_GET['id'])){

        redirect("users.php");

    }

    $user = User::find_by_id($_GET['id']);

    if($user){

        $user->delete();

    } else {

        redirect("users.php");

    }

?>