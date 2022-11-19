<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_GET["id"]) && intval($_GET["id"])){
        $id = $_GET["id"];
        session_start();
        $author_id = $_SESSION["id"];
        mysqli_query($con , "DELETE FROM blogs WHERE id='$id' AND author_id='$author_id'");
        $nickname = $_SESSION["nickname"];
        header("Location:$BASE_URL/profile.php?nickname=$nickname");
    }