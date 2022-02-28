<?php
include_once("inc/model/tables/Loginmodel.php");
class Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new Model();
    }
    public function invoke()
    {
        $reslt = $this->model->getlogin();     // it call the getlogin() function of model class and store the return value of this function into the reslt variable.
        if ($reslt == 'login') {
            include 'view/Afterlogin.php';
        } else {
            include 'inc/view/login.php';
        }
    }
}
