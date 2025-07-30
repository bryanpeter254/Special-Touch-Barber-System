# Special-Touch-Barber-System
A barbershop system using html css javascript php 
use this sql for the backend 
CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE barbers (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);


CREATE TABLE `advances` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE client_checkins (
    id INT(11) NOT NULL AUTO_INCREMENT,
    client_name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    service VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    date_of_visit DATE NOT NULL,
    barber VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE debts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    client_name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    amount_paid DECIMAL(10,2) DEFAULT 0.00,
    date DATE NOT NULL,
    status ENUM('Paid', 'Not Paid', 'Partially Paid') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Not Paid',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE expenses (
    id INT(11) NOT NULL AUTO_INCREMENT,
    expense_date DATE NOT NULL,
    item VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    paid_by VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
    notes TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE monthly_record (
    id INT(11) NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    client VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    service VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    cash DECIMAL(10,2) NOT NULL,
    notes TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE revenue (
    id INT(11) NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    client_name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
    service VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    offered_by VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE services (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
);

CREATE DATABASE IF NOT EXISTS barbershop;
USE barbershop;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    password VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    PRIMARY KEY (id),
    INDEX idx_username (username)
);
