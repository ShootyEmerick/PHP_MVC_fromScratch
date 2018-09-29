<?php

class ErrorController extends Controller
{

    /**
     * ErrorController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Call the view : (routes = "/error/error/")
     */
    public function errorAction()
    {
        $this->render('404');
    }
}
