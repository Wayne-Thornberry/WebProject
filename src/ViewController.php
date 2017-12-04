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
        // Do stuff when called
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

    public function viewProduct(){
        if($_GET['product'] != null) {
            require __DIR__ . '/../view/product.php';
        }else{

        }
    }

    public function viewProcess(){
        if(false) {
            require __DIR__ . '/../view/process.php';
        }else{
            $this->viewIndex();
        }
    }

    public function viewAccount(){
        if(true){
            require __DIR__ . '/../view/account.php';
        }else{
            $this->viewIndex();
        }
    }

    public function viewControl(){
        if(true) {
            require __DIR__ . '/../view/process.php';
        }else{
            $this->viewIndex();
        }
    }
}