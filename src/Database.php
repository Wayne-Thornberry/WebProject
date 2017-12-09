<?php

namespace itb;

class Database{

    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new \PDO('sqlite:' . __DIR__ . '\..\data\database.sqlite');
            $this->createProductsTable();
            $this->createUsersTable();
            $this->insertUser(2,'Admin','Admin@Website.com','Admin','Admin','Admin','1999-01-01');
            $this->insertUser(1,'Staff','Staff@Website.com','Staff','Staff','Staff','1999-01-01');
            $this->insertUser(0,'User','User@Website.com','User','User','User','1999-01-01');
        }catch(Exception $e){
            echo "Failed to connect to database";
        }
    }

    public function createProductsTable(){
        $this->pdo->query("
            CREATE TABLE IF NOT EXISTS Products(
                pId INT PRIMARY KEY NOT NULL,
                pName VARCHAR(20),
                pPrice DECIMAL(10,2),
                pImage VARCHAR(255),
                pDescription VARCHAR(255),
                pTags VARCHAR(20)
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
            CREATE TABLE IF NOT EXISTS Users(
                uId INT PRIMARY KEY NOT NULL,
                uEmail VARCHAR(255) NOT NULL,
                )"
        );
    }

    public function insertProduct($pName, $pPrice, $pDescription, $pImage, $pTag){

        $sql = $this->pdo->prepare("
            INSERT INTO Products (pId, pName, pPrice, pImage, pDescription, pTags) 
            VALUES ((SELECT COUNT(pId) + 1 FROM Products), :pName, :pPrice, :pImage, :pDescription, :pTags)"
        );

        $sql->bindParam(':pName', $pName);
        $sql->bindParam(':pPrice', $pPrice);
        $sql->bindParam(':pImage', $pImage);
        $sql->bindParam(':pDescription', $pDescription);
        $sql->bindParam(':pTags', $pTag);
        $sql->execute();
    }

    public function insertUser($uPrivilege, $uName, $uEmail, $uPassword, $uFirstName, $uLastName, $uDOB){

        $sql = $this->pdo->prepare("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES ((SELECT COUNT(uId) + 1 FROM Users), :uPrivilege, :uName, :uEmail, :uPassword, :uFirstName, :uLastName, :uDOB)"
        );

        $sql->bindParam(':uPrivilege', $uPrivilege);
        $sql->bindParam(':uName', $uName);
        $sql->bindParam(':uEmail', $uEmail);
        $sql->bindParam(':uPassword', $uPassword);
        $sql->bindParam(':uFirstName', $uFirstName);
        $sql->bindParam(':uLastName', $uLastName);
        $sql->bindParam(':uDOB', $uDOB);
        $sql->execute();
    }

    public function verifyUser($uName, $uPassword){
        $sql = $this->pdo->query("
        SELECT COUNT(*)
        FROM Users
        WHERE uName = '$uName' AND uPassword = '$uPassword' 
        ");
        return $sql->fetchColumn();
    }

    public function getProduct($pId){
        $sql = $this->pdo->prepare("
            SELECT *
            FROM Products
            WHERE pId = '$pId'");
        $sql->execute();
        if($sql->fetch()[0] == null){
            return 'No such item by that Id';
        }else {
            return $sql->fetch();
        }
    }

    public function getUser($uName){
        $sql = $this->pdo->prepare("
            SELECT *
            FROM Users
            WHERE uName = '$uName'");
        $sql->execute();
        return $sql->fetch();
    }

    public function doesUserExist($uName, $uEmail){
        $sql = $this->pdo->query("
            SELECT COUNT(*)
            FROM Users
            WHERE uName = '$uName' OR uEmail = '$uEmail'
            ");
        if($sql->fetchColumn() == 1){
            return true; // user exists
        }else{
            return false; // user does not exist
        }
    }

    public function getAllUsers(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Users
        WHERE uPrivilege = 0
        ");
        return $sql;
    }

    public function getAllStaff(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Users
        WHERE uPrivilege = 1
        ");
        return $sql;
    }

    public function getAllAdmins(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Users
        WHERE uPrivilege = 2
        ");
        return $sql;
    }

    public function getAllProducts(){
        $sql = $this->pdo->query("
        SELECT *
        FROM Products
        ");
        return $sql;
    }
}