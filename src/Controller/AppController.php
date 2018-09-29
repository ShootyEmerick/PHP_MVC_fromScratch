<?php

class AppController extends Controller
{

    /**
     * AppController constructor.
     * Call parent::__contruct()
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Call the index view (routes = "/")
     */
    public function indexAction()
    {
        $this->render('index');
    }
}
