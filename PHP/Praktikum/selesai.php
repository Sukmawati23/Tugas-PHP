<?php
session_start();
require 'koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $stmt = $conn->prepare("UPDATE todos SET selesai = NOT selesai WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: todo.php");
