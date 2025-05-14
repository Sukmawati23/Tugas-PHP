<?php
session_start();
require 'koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tugas = $conn->real_escape_string($_POST['tugas']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO todos (user_id, tugas) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $tugas);
    $stmt->execute();
}

header("Location: todo.php");
