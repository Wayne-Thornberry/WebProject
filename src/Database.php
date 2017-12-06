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

    public function createProductsTable(){
        $this->pdo->query("
            CREATE TABLE Products(
                pId INT PRIMARY KEY NOT NULL,
                pName VARCHAR(20),
                pPrice DECIMAL(10,2),
                pImageSource VARCHAR(255),
                pDescription VARCHAR(255),
                pTags VARCHAR(20)
                )"
            );
    }

    public function createUsersTable(){
        $this->pdo->query("
            CREATE TABLE Users(
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

    public function insertProduct($product){
        $pName = $product->getPName();
        $pPrice = $product->getPPrice();
        $pDescription = $product->getPDescription();
        $pImage = $product->getPImage();
        $pTag = $product->getPTag();

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

    public function insertUser($user){

        $uPrivilege = $user->getUPrivilege();
        $uName = $user->getUName();
        $uEmail = $user->getUEmail();
        $uPassword = $user->getUPassword();
        $uFirstName = $user->getUFirstName();
        $uLastName = $user->getULastName();
        $uDOB = $user->getUDOB();

        $sql = $this->pdo->prepare("
            INSERT INTO Users (uId, uPrivilege, uName, uEmail, uPassword, uFirstName, uLastName, uDOB) 
            VALUES ((SELECT COUNT(pId) + 1 FROM Users), :uPrivilege, :uName, :uEmail, :uPassword, :uFirstName, :uLastName, :uDOB)"
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

    public function getUser($uId){
        $sql = $this->pdo->prepare("
            SELECT *
            FROM Users
            WHERE uId = '$uId'");
        $sql->execute();
        if($sql->fetch()[0] == null){
            return 'No such user by that Id';
        }else {
            return $sql->fetch();
        }
    }
}