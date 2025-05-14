<?php
session_start();
require 'koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$user_id = $_SESSION['user_id'];
$stmt_user = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$user_result = $stmt_user->get_result();
$user_data = $user_result->fetch_assoc();
$username = $user_data['username'];

// Ambil data todos
$stmt_todos = $conn->prepare("SELECT * FROM todos WHERE user_id = ? ORDER BY created_at DESC");
$stmt_todos->bind_param("i", $user_id);
$stmt_todos->execute();
$todos = $stmt_todos->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <?php if ($username === 'admin'): ?>
            <img src="Foto.jpg" alt="Foto Profil">
            <h1>Iis Sukmawati</h1>
            <p>NIM: 235314001</p>
        <?php else: ?>
            <img src="Gambar2.jpg" alt="Foto Profil">
            <h1><?= htmlspecialchars($username) ?></h1>
        <?php endif; ?>
    </header>

    <div class="container">
        <form action="tambah.php" method="POST" class="todo-form">
            <input type="text" name="tugas" placeholder="Teks to do" required>
            <button type="submit">Tambah</button>
        </form>

        <div class="todo-list">
            <?php foreach ($todos as $todo): ?>
                <div class="todo-item <?= $todo['selesai'] ? 'completed' : '' ?>">
                    <span><?= htmlspecialchars($todo['tugas']) ?></span>
                    <div class="actions">
                        <a href="selesai.php?id=<?= $todo['id'] ?>" class="btn">
                            <?= $todo['selesai'] ? 'Batal' : 'Selesai' ?>
                        </a>
                        <a href="hapus.php?id=<?= $todo['id'] ?>" class="btn hapus"
                            onclick="return confirm('Apakah anda yakin ingin menghapus tugas ini?')">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="logout.php" class="logout" onclick="return confirm('Apakah anda yakin ingin logout?')">Logout</a>
    </div>
</body>

</html>