<?php 

    include("includes/header.php"); 

    if(!$session->is_signed_in()){

        redirect("login.php");

    }

    if(isset($_GET['id'])){

        redirect("comments.php");

    }

    $comment = Comment::find_by_id($_GET['id']);

    if($comment){

        $comment->delete();

    } else {

        redirect("comments.php");

    }

?>