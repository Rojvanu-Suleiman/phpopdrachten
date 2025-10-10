-- ====================================================
-- DATABASE LOGIN SYSTEM
-- ====================================================

-- Create database
CREATE DATABASE IF NOT EXISTS login CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Use database
USE login;

-- ====================================================
-- Create table 'user'
-- ====================================================

DROP TABLE IF EXISTS user;
CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  gebruikersnaam VARCHAR(50) NOT NULL UNIQUE,
  wachtwoord VARCHAR(255) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  rol VARCHAR(20) NOT NULL DEFAULT 'gebruiker'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ====================================================
-- Insert example test users (already hashed passwords)
-- ====================================================

-- Passwords for these users are all: 12345
INSERT INTO user (gebruikersnaam, wachtwoord, email, rol) VALUES
('test1', '$2y$10$FqOnh3sTT1pylgN2VbKj5u8e.1xv2F.KfQ6s7iHjZxBzqlFtycRzS', 'test1@mail.com', 'gebruiker'),
('admin1', '$2y$10$FqOnh3sTT1pylgN2VbKj5u8e.1xv2F.KfQ6s7iHjZxBzqlFtycRzS', 'admin1@mail.com', 'admin');
