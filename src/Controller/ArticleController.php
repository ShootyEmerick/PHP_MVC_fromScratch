<?php

/**
 * Class ArticleController
 */
class ArticleController extends Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function indexAction()
    {
        $this->render('index');
    }

    /**
     *
     */
    public function addAction()
    {
        $this->render('add');
    }
}
