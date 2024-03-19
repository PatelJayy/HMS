-- Create a new database connection
CREATE DATABASE IF NOT EXISTS data;

-- Select the database
USE data;

-- Create the necessary tables
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
