-- Create Database
--CREATE DATABASE fdp_certificate2;

-- Use Database
USE fdp_certificate;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100)
);

-- Admin Table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(100)
);

-- Certificates Table
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_name VARCHAR(200),
    organizer VARCHAR(200),
    academic_year VARCHAR(20),
    program_type VARCHAR(10),
    start_date DATE,
    end_date DATE,
    duration INT,
    file_name VARCHAR(255),
    status VARCHAR(20) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert Default Admin
INSERT INTO admin (username, password)
VALUES ('admin', 'admin123');