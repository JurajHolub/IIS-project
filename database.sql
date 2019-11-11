/**
 * @author JurQo Holub
 */

USE xholub40;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS User_Base;
DROP TABLE IF EXISTS User_Customer;
DROP TABLE IF EXISTS User_Employee;
DROP TABLE IF EXISTS User_Manager;
DROP TABLE IF EXISTS User_Director;
DROP TABLE IF EXISTS User_Admin;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Product_Part;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Commentar;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Task_fix_Ticket;
DROP TABLE IF EXISTS Admin_manages_User;
DROP TABLE IF EXISTS Task_fulfill_Employee;
DROP TABLE IF EXISTS Customer_own_Product;
SET FOREIGN_KEY_CHECKS = 1;


CREATE TABLE User_Base (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    surname VARCHAR(50),
    login VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(50),
    registration DATE NOT NULL,
    bank_account VARCHAR(50),
    address VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE User_Customer (
    id INT NOT NULL,
    social_networks VARCHAR(500),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_customer_user FOREIGN KEY (id) REFERENCES User_Base (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE User_Employee (
    id INT NOT NULL,
    employment_type VARCHAR(500),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_employee_user FOREIGN KEY (id) REFERENCES User_Base (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE User_Manager (
    id INT NOT NULL,
    language_skill VARCHAR(500),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_manager_user_user_emplayee FOREIGN KEY (id) REFERENCES User_Employee (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE User_Director (
    id INT NOT NULL,
    division VARCHAR(500),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_director_user_manager FOREIGN KEY (id) REFERENCES User_Manager (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE User_Admin (
    id INT NOT NULL,
    certificate VARCHAR(500),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_admin_user_director FOREIGN KEY (id) REFERENCES User_Director (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Product (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(500) NOT NULL,
    text VARCHAR(5000) NOT NULL,
    version INT NOT NULL,
    last_actualization DATE NOT NULL,
    created DATE NOT NULL,
    id_user_director INT DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_product_user_director FOREIGN KEY (id_user_director) REFERENCES User_Director (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Product_Part (
    id INT NOT NULL AUTO_INCREMENT,
    id_product INT NOT NULL,
    name VARCHAR(500) NOT NULL,
    text VARCHAR(5000) NOT NULL,
    version INT NOT NULL,
    last_actualization DATE NOT NULL,
    PRIMARY KEY (id, id_product),
    CONSTRAINT FK_product_part_product FOREIGN KEY (id_product) REFERENCES Product (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Ticket (
    id INT NOT NULL AUTO_INCREMENT,
    id_user_customer INT DEFAULT NULL,
    id_product_part INT DEFAULT NULL,
    id_user_manager INT DEFAULT NULL,
    title VARCHAR(500) NOT NULL,
    text VARCHAR(5000) NOT NULL,
    state INT NOT NULL,
    priority INT NOT NULL,
    images LONGBLOB,
    PRIMARY KEY (id),
    CONSTRAINT FK_ticket_user_customer FOREIGN KEY (id_user_customer) REFERENCES User_Customer (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_ticket_product_part FOREIGN KEY (id_product_part) REFERENCES Product_Part (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_ticket_user_manager FOREIGN KEY (id_user_manager) REFERENCES User_Manager (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Commentar (
    id INT NOT NULL AUTO_INCREMENT,
    id_ticket INT DEFAULT NULL,
    id_user INT DEFAULT NULL,
    title VARCHAR(500) NOT NULL,
    text VARCHAR(5000) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_commentar_ticket FOREIGN KEY (id_ticket) REFERENCES Ticket (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_commentar_user FOREIGN KEY (id_user) REFERENCES User_Base (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Task (
    id INT NOT NULL AUTO_INCREMENT,
    id_user_manager INT DEFAULT NULL,
    title VARCHAR(500) NOT NULL,
    text VARCHAR(5000) NOT NULL,
    supposed_time_hours INT NOT NULL,
    spent_time_hours INT NOT NULL,
    state INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_task_user_manager FOREIGN KEY (id_user_manager) REFERENCES User_Manager (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Admin_manages_User (
    id_admin INT NOT NULL,
    id_user INT NOT NULL,
    PRIMARY KEY (id_admin, id_user),
    CONSTRAINT FK_admin_manages_user_user FOREIGN KEY (id_user) REFERENCES User_Base (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_admin_manages_user_admin FOREIGN KEY (id_admin) REFERENCES User_Admin (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Task_fulfill_Employee (
    id_task INT NOT NULL,
    id_employee INT NOT NULL,
    PRIMARY KEY (id_employee, id_task),
    CONSTRAINT FK_task_fulfill_employee_task FOREIGN KEY (id_task) REFERENCES Task (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_task_fulfill_employee_employee FOREIGN KEY (id_employee) REFERENCES User_Employee (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Customer_own_Product (
    id_user_customer INT NOT NULL,
    id_product INT NOT NULL,
    PRIMARY KEY (id_product, id_user_customer),
    CONSTRAINT FK_customer_won_product_customer FOREIGN KEY (id_user_customer) REFERENCES User_Customer (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_customer_won_product_product FOREIGN KEY (id_product) REFERENCES Product (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Task_fix_Ticket (
    id_ticket INT NOT NULL,
    id_task INT NOT NULL,
    PRIMARY KEY (id_task, id_ticket),
    CONSTRAINT FK_task_fix_ticket_task FOREIGN KEY (id_task) REFERENCES Task (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK_task_fix_ticket_ticket FOREIGN KEY (id_ticket) REFERENCES Ticket (id)
                     ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO User_Base (name, surname, login, password, email, registration, bank_account)
VALUES ('Jozef', 'Novák', 'uzivatel01', 'uzivatel01', 'jozef.novak@gmail.com', CURRENT_DATE, 'CZ5508000000001234567899'),
       ('Karel', 'Svoboda', 'zamestanec01', 'zamestanec01', 'karel.svoboda@gmail.com', CURRENT_DATE, 'CZ8975000000000012345671');
