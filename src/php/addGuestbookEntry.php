<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["fullName"], $_POST["message"])) {
    require "db.php";

    $stmt = $conn->prepare("INSERT INTO posts (`author`, `time`, `message`) VALUES (:fullName, :time, :message)");
    $stmt->bindParam(":fullName", $fullName);
    $stmt->bindParam(":time", $time);
    $stmt->bindParam(":message", $message);

    $message = nl2br($_POST["message"]);
    $time = date("Y-m-d H-i-s"); // 2000-01-01 10:10:10
    $fullName = $_POST["fullName"];
    $stmt->execute();
    header("Location: ../index.php?q=guestbook");
}