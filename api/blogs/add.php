<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["title"] , $_POST["description"] , $_POST["category_id"]) &&
        strlen($_POST["title"]) > 2 && 
        strlen($_POST["description"]) > 2 && 
        intval($_POST["category_id"]))
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $categ_id = $_POST["category_id"];
        session_start();
        $author_id = $_SESSION["id"];
        if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 2){
            $ext = end(explode("." , $_FILES["image"]["name"]));
            $image_name = time().".".$ext;
            move_uploaded_file($_FILES["image"]["tmp_name"] , "../../images/blogs/$image_name");
            $path = "images/blogs/$image_name";
            mysqli_query($con , "INSERT INTO blogs (title , description , author_id , category_id , image)
            VALUES ('$title' , '$description' , '$author_id' , '$categ_id' , '$path')");
        }else{
            mysqli_query($con , "INSERT INTO blogs (title , description , author_id , category_id)
            VALUES ('$title' , '$description' , '$author_id' , '$categ_id')");
        }
        $nickname = $_SESSION["nickname"];
        header("Location: $BASE_URL/profile.php?nickname=$nickname");
    }else{
        header("Location: $BASE_URL/newblog.php?error=1");
    }