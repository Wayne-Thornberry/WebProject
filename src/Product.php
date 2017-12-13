<?php

namespace itb;

class Product{

    private $pId;
    private $pName;
    private $pPrice;
    private $pQuantity;
    private $pDescription;
    private $pImage;
    private $pTagOne;
    private $pTagTwo;

    public function __construct($pId, $pName, $pPrice, $pQuantity, $pDescription, $pImage, $pTagOne, $pTagTwo ){
        $this->pId = $pId;
        $this->pName = $pName;
        $this->pPrice = $pPrice;
        $this->pQuantity = $pQuantity;
        $this->pDescription = $pDescription;
        $this->pImage = $pImage;
        $this->pTagOne = $pTagOne;
        $this->pTagTwo = $pTagTwo;
    }

    public function getPId(){
        return $this->pId;
    }

    public function setPId($pId){
        $this->pId = $pId;
    }

    public function getPName(){
        return $this->pName;
    }

    public function setPName($pName){
        $this->pName = $pName;
    }

    public function getPPrice(){
        return $this->pPrice;
    }

    public function setPPrice($pPrice){
        $this->pPrice = $pPrice;
    }

    public function getPQuantity(){
        return $this->pQuantity;
    }

    public function setPQuantity($pQuantity){
        $this->pQuantity = $pQuantity;
    }

    public function getPDescription(){
        return $this->pDescription;
    }

    public function setPDescription($pDescription){
        $this->pDescription = $pDescription;
    }

    public function getPImage(){
        return $this->pImage;
    }

    public function setPImage($pImage){
        $this->pImage = $pImage;
    }

    public function getPTagOne(){
        return $this->pTag;
    }

    public function setPTagOne($pTagOne){
        $this->pTagOne = $pTagOne;
    }

    public function getPTagTwo(){
        return $this->pTagTwo;
    }

    public function setPTagTwo($pTagTwo){
        $this->pTagTwo = $pTagTwo;
    }

}