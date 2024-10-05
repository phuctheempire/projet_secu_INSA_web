CREATE DATABASE user_database;

USE user_database;

CREATE TABLE users (
    name VARCHAR(50) PRIMARY KEY,  -- 用户名作为主键
    full_name VARCHAR(100),
    phone_number VARCHAR(20),
    avatar_url VARCHAR(255),       -- 用户头像URL
    address VARCHAR(255),
    birthdate DATE,
    grade VARCHAR(10),
    gender VARCHAR(10)
);

INSERT INTO users (name, full_name, phone_number, avatar_url, address, birthdate, grade, gender) VALUES ('deelong', 'Z Deelong', '123-456-7890', 'asset/ser/icon/165532503.jpg', '123 abab rue, bourges', '2000-05-15', '4A STI', 'Male
);
