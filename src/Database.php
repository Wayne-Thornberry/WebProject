<?php

namespace itb;

class Database{

    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new \PDO('sqlite:' . __DIR__ . '\..\data\database.sqlite');
        }catch(Exception $e){
            echo "Failed to connect to database";
        }
    }

    /// setup ///

    public function setup(){
        $this->createUsersTable();
        $this->createProductsTable();
        $this->createSubscribersTable();

        $userpass = password_hash('User',1);
        $staffpass = password_hash('Staff',1);
        $adminpass = password_hash('Admin',1);

        $this->pdo->query("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES (0, 2, 'Admin', 'Admin@website.com', '$adminpass', 'Admin', 'Admin', '1999-01-01')
        ");

        $this->pdo->query("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES (1, 1, 'Staff', 'Staff@website.com', '$staffpass', 'Staff', 'Staff', '1999-01-01')
        ");

        $this->pdo->query("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES (2, 0, 'User', 'User@website.com', '$userpass', 'User', 'User', '1999-01-01')
        ");

        $this->pdo->query("
            INSERT INTO Products (pId, pName, pPrice, pQuantity, pImage, pDescription, pTagOne, pTagTwo) 
            VALUES (2, 'Product', 0.99, 99, 'images/product.png', 'Small Description', 'Product One', 'Product Two')
        ");

        $this->pdo->query("
            INSERT INTO Subscribers (sId, sEmail) 
            VALUES (0, 'Subscriber@website.com')
        ");

    }

    public function createProductsTable(){
        $this->pdo->query("
            CREATE TABLE IF NOT EXISTS Products(
                pId INT PRIMARY KEY NOT NULL,
                pName VARCHAR(20),
                pPrice DECIMAL(10,2),
                pQuantity INT,
                pImage VARCHAR(255),
                pDescription VARCHAR(255),
                pTagOne VARCHAR(20),
                pTagTwo VARCHAR(20)
                )"
            );
    }

    public function createUsersTable(){
        $this->pdo->query("
            CREATE TABLE IF NOT EXISTS Users(
                uId INT PRIMARY KEY NOT NULL,
                uPrivilege INT NOT NULL,
                uName VARCHAR(22) UNIQUE NOT NULL,
                uEmail VARCHAR(255) NOT NULL,
                uPassword VARCHAR(22) NOT NULL,
                uFirstName VARCHAR(255),
                uLastName VARCHAR(255),
                uDOB DATE
                )"
            );
    }

    public function createSubscribersTable(){
        $this->pdo->query("
            CREATE TABLE IF NOT EXISTS Subscribers(
                sId INT PRIMARY KEY NOT NULL,
                sEmail VARCHAR(255) NOT NULL
                )"
        );
    }

    /// login verification ///

    public function verifyUser($uName, $uEmail){
        $sql = $this->pdo->query("
        SELECT COUNT(*)
        FROM Users
        WHERE (uName LIKE '$uName') OR (uEmail LIKE '$uEmail')
        ");

        if($sql->fetchColumn() == 1){
            return true;
        }else{
            return false;
        }
    }

    /// User Section ///

    public function getUser($uName){ // Get user by name
        $sql = $this->pdo->prepare("
            SELECT *
            FROM Users
            WHERE uName = '$uName'");
        $sql->execute();
        return $sql->fetch();
    }

    public function getAllUsers(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Users
        ORDER BY uId ASC 
        ");
        return $sql;
    }

    public function updateUser($uId, $uPrivilege, $uName, $uEmail, $uPassword, $uFirstName, $uLastName, $uDOB){ // Update user in table
        $uPassword = password_hash($uPassword,1);
        $sql = $this->pdo->query("
        UPDATE Users
        SET uPrivilege = '$uPrivilege', uName = '$uName', uEmail = '$uEmail', uPassword = '$uPassword', uFirstName = '$uFirstName', uLastName = '$uLastName', uDOB = '$uDOB'
        WHERE uId = '$uId';
        ");
    }

    public function createUser($uPrivilege, $uName, $uEmail, $uPassword, $uFirstName, $uLastName, $uDOB){
        $sql = $this->pdo->prepare("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES ((SELECT MAX(uId) + 1 FROM Users), :uPrivilege, :uName, :uEmail, :uPassword, :uFirstName, :uLastName, :uDOB)
        ");

        $uPassword = password_hash($uPassword,1);
        $sql->bindParam(':uPrivilege', $uPrivilege);
        $sql->bindParam(':uName', $uName);
        $sql->bindParam(':uEmail', $uEmail);
        $sql->bindParam(':uPassword', $uPassword);
        $sql->bindParam(':uFirstName', $uFirstName);
        $sql->bindParam(':uLastName', $uLastName);
        $sql->bindParam(':uDOB', $uDOB);
        $sql->execute();
    }

    public function removeUser($uId){
        $sql = $this->pdo->query("
        DELETE FROM Users
        WHERE uId = '$uId'
        ");
    }

    /// Product Section ///

    public function getProduct($pId){
        $sql = $this->pdo->query("
            SELECT *
            FROM Products
            WHERE pId = '$pId'");
        return $sql;
    }

    public function getAllProducts(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Products
        ");
        return $sql;
    }

    public function updateProduct($pId, $pName, $pPrice, $pQuantity, $pImage, $pDescription, $pTagOne, $pTagTwo){ // Update user in table
        $sql = $this->pdo->query("
        UPDATE Products
        SET pName = '$pName', pPrice = '$pPrice', pQuantity = '$pQuantity', pImage = '$pImage', pDescription = '$pDescription', pTagOne = '$pTagOne', pTagTwo = '$pTagTwo'
        WHERE pId = '$pId';
        ");
    }

    public function createProduct($pName, $pPrice, $pQuantity, $pImage, $pDescription, $pTagOne, $pTagTwo){
        $sql = $this->pdo->prepare("
            INSERT INTO Products (pId, pName, pPrice, pQuantity, pImage, pDescription, pTagOne, pTagTwo)
            VALUES ((SELECT MAX(pId) + 1 FROM Products), :pName, :pPrice, :pQuantity, :pImage, :pDescription, :pTagOne, :pTagTwo)
        ");

        $sql->bindParam(':pName', $pName);
        $sql->bindParam(':pPrice', $pPrice);
        $sql->bindParam(':pQuantity', $pQuantity);
        $sql->bindParam(':pImage', $pImage);
        $sql->bindParam(':pDescription', $pDescription);
        $sql->bindParam(':pTagOne', $pTagOne);
        $sql->bindParam(':pTagTwo', $pTagTwo);
        $sql->execute();
    }

    public function removeProduct($pId){
        $sql = $this->pdo->query("
        DELETE FROM Products
        WHERE pId = '$pId'
        ");
    }

    /// Subscribers Section ///

    public function getAllSubscribers(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Subscribers
        ");
        return $sql;
    }

    public function updateSubscriber($sId, $sEmail){
        $sql = $this->pdo->query("
        UPDATE Subscribers
        SET sEmail = '$sEmail'
        WHERE sId = '$sId';
        ");
    }

    public function createSubscriber($sEmail){
        $sql = $this->pdo->prepare("
            INSERT INTO Subscribers (sId, sEmail)
            VALUES ((SELECT MAX(sId) + 1 FROM Subscribers), :sEmail)
        ");

        $sql->bindParam(':sEmail', $sEmail);
        $sql->execute();
    }

    public function removeSubscriber($sId){
        $sql = $this->pdo->query("
        DELETE FROM Subscribers
        WHERE sId = '$sId'
        ");
    }

}