<?php

class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function testAction()
    {
        $test = new TestModel(["test"=> "TEST"]);
        var_dump($test->getTest());
        $this->render('test');
    }
}
