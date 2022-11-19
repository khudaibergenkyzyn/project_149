<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["title"] , $_POST["description"] , $_POST["category_id"] , $_POST["blog_id"]) &&
        strlen($_POST["title"]) > 2 && 
        strlen($_POST["description"]) > 2 && 
        intval($_POST["category_id"]) &&
        intval($_POST["blog_id"])
    ) 
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $categ_id = $_POST["category_id"];
        $blog_id = $_POST["blog_id"];
        session_start();
        $author_id = $_SESSION["id"];
        if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 2){
            $ext = end(explode("." , $_FILES["image"]["name"]));
            $image_name = time().".".$ext;
            move_uploaded_file($_FILES["image"]["tmp_name"] , "../../images/blogs/$image_name");
            $path = "images/blogs/$image_name";
            mysqli_query($con , "UPDATE blogs SET title='$title' , description = '$description' , 
            image='$path' , category_id='$categ_id' WHERE id = '$blog_id'");
        }else{
            mysqli_query($con , "UPDATE blogs SET title='$title' , description = '$description' , 
            category_id='$categ_id' WHERE id = '$blog_id'");
        }
        $nickname = $_SESSION["nickname"];
        header("Location: $BASE_URL/profile.php?nickname=$nickname");
    }else{
        header("Location: $BASE_URL/editblog.php?error=1");
    }