<?php
if (!isset($conn))
    $conn = new PDO("mysql:host=localhost;dbname=guestbook", 'root', 'root');
