<?php

namespace itb;

class Product{

    private $pId;
    private $pName;
    private $pPrice;
    private $pDescription;
    private $pImage;
    private $pTag;

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

    public function getPTag(){
        return $this->pTag;
    }

    public function setPTag($pTag){
        $this->pTag = $pTag;
    }

}