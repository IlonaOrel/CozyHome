<?php


namespace controllers;

use core\BaseController;
use core\Views;

class IndexController extends BaseController
{
    public function index()
    {
        $view = new Views();
        $view->render('index_view.php', 'default_view.php');
    }
}