<?php
/**
 * Created by PhpStorm.
 * User: Wayno717
 * Date: 30/11/2017
 * Time: 9:27 PM
 */

namespace itb;

class WebApplication{

    private $viewController;
    public function __construct(){
        $this->viewController = new ViewController();
    }

    public function run(){
        $view = filter_input(INPUT_GET, 'view');
        switch ($view){
            case 0 : $this->viewController->viewIndex(); break;
            case 1 : $this->viewController->viewMerchandise(); break;
            case 2 : $this->viewController->viewNews(); break;
            case 3 : $this->viewController->viewAbout(); break;
            case 4 : $this->viewController->viewProduct(); break;
            case 5 : $this->viewController->viewManagement(); break;
            case 6 : $this->viewController->viewProcess(); break;
            case 7 : $this->viewController->viewAccount(); break;
            case 8 : $this->viewController->viewControl(); break;
            case 9 : $this->viewController->viewError(); break;
            default : $this->viewController->viewIndex(); break;
        }
    }
}