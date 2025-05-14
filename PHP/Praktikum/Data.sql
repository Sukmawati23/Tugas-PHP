CREATE DATABASE IF NOT EXISTS tugas5;
USE tugas5;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tugas TEXT NOT NULL,
    selesai BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert user admin (ganti 'hash-password' dengan hasil password_hash('nim-anda'))
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$QUX7D3YaKMQt3hCamHdkBOPuSXD4XRlU8nl8XUjbxR2oXFgtEQeUS');
