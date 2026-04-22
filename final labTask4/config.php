<?php
    session_start();
    $admin_id       = "admin";
    $admin_password = "1122";
    if(!isset($_SESSION['products'])){
        $_SESSION['products'] = [
            ["id" => 1, "name" => "Book",   "price" => 500],
            ["id" => 2, "name" => "Pen",    "price" => 10],
            ["id" => 3, "name" => "NoteBook", "price" => 120],
            ["id" => 4, "name" => "Manga",  "price" => 1500000],
        ];
    }
    if(!isset($_SESSION['customers'])){
        $_SESSION['customers'] = [];
    }
    if(!isset($_SESSION['next_id'])){
        $_SESSION['next_id'] = 5;
    }
?>
