
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id VARCHAR(255) NOT NULL,
    device_name VARCHAR(255) DEFAULT "PC",
    no_of_players VARCHAR(255),
    message_content TEXT,
    Time VARCHAR(100) DEFAULT 0,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_on BOOLEAN DEFAULT FALSE
);

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE billing (
    billing_id INT AUTO_INCREMENT PRIMARY KEY,
    pc_id INT,
    num_of_persons INT,
    num_of_hours INT,
    total_amount DECIMAL(10, 2), 
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credited_amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
