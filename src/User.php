<?php

namespace itb;

class User{

    private $uId;
    private $uPrivilege;
    private $uName;
    private $uEmail;
    private $uPassword;
    private $uFirstName;
    private $uLastName;
    private $uDOB;

    public function __construct($uId, $uPrivilege, $uName, $uEmail, $uPassword, $uFirstName, $uLastName, $uDOB){
        $this->uId = $uId;
        $this->uPrivilege = $uPrivilege;
        $this->uName = $uName;
        $this->uEmail = $uEmail;
        $this->uPassword = $uPassword;
        $this->uFirstName = $uFirstName;
        $this->uLastName = $uLastName;
        $this->uDOB = $uDOB;
    }

    public function getUId(){
        return $this->uId;
    }

    public function setUId($uId){
        $this->uId = $uId;
    }

    public function getUPrivilege(){
        return $this->uPrivilege;
    }

    public function setUPrivilege($uPrivilege){
        $this->uPrivilege = $uPrivilege;
    }

    public function getUName(){
        return $this->uName;
    }

    public function setUName($uName){
        $this->uName = $uName;
    }

    public function getUEmail(){
        return $this->uEmail;
    }

    public function setUEmail($uEmail){
        $this->uEmail = $uEmail;
    }

    public function getUPassword(){
        return $this->uPassword;
    }

    public function setUPassword($uPassword){
        $this->uPassword = $uPassword;
    }

    public function getUFirstName(){
        return $this->uFirstName;
    }

    public function setUFirstName($uFirstName){
        $this->uFirstName = $uFirstName;
    }

    public function getULastName(){
        return $this->uLastName;
    }

    public function setULastName($uLastName){
        $this->uLastName = $uLastName;
    }

    public function getUDOB(){
        return $this->uDOB;
    }

    public function setUDOB($uDOB){
        $this->uDOB = $uDOB;
    }


}