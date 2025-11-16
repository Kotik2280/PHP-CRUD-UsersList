CREATE DATABASE IF NOT EXISTS testdb1;
USE testdb1;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT
);

INSERT INTO users (name, age) VALUES 
('Tom', 26),
('Sam', 18),
('Ted', 21);