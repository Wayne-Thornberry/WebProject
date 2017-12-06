<?php
/**
 * Created by PhpStorm.
 * User: Wayno717
 * Date: 30/11/2017
 * Time: 9:40 PM
 */

namespace itb;


class ViewController{

    public function __construct(){
    }

    public function viewIndex(){
        require __DIR__ . '/../view/index.php';
    }

    public function viewMerchandise(){
        require __DIR__ . '/../view/merchandise.php';
    }

    public function viewNews(){
        require __DIR__ . '/../view/news.php';
    }

    public function viewAbout(){
        require __DIR__ . '/../view/about.php';
    }

    public function viewManagement(){
        if(!isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == false)) {
            require __DIR__ . '/../view/management.php';
        }else{
            $this->viewIndex();
        }
    }

    public function viewProduct(){
        if((isset($_GET['product'])) && ($_GET['product'] != null)){
            require __DIR__ . '/../view/product.php';
        }else{
            header('location: ?view=8');
            echo 'no product to display';
        }
    }

    public function viewProcess(){
        if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == false)) {
            require __DIR__ . '/../view/process.php';
        }else{
            $this->viewIndex();
        }
    }

    public function viewAccount(){
        if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true)){
            require __DIR__ . '/../view/account.php';
        }else{
            header('location: ?view=0');
        }
    }

    public function viewControl(){
        if(isset($_SESSION['privileges']) && ($_SESSION['privileges'] > 0)){
            require __DIR__ . '/../view/control.php';
        }else{
            header('location: ?view=0');
        }
    }

    public function viewError(){
        require  __DIR__ . '/../view/error.php';
    }
}