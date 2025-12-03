CREATE DATABASE kursus_db;
USE kursus_db;

CREATE TABLE kursus (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  duration INT NOT NULL,
  image_path VARCHAR(255),
  status ENUM('aktif','nonaktif') NOT NULL
);