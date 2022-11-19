<?php
    include "../../config/baseurl.php";
    session_start();
    session_destroy();
    header("Location:$BASE_URL/");