<?php

/**
 * Class Controller
 * Main Controller, contain render function
 * Show the view associate to the NameController
 */
class Controller
{

    /**
     * @var $_render
     */
    protected static $_render;
    /**
     * @var Request
     */
    protected $request;

    /**
     * Controller constructor
     * Instance the Request class
     */
    public function __construct()
    {
        $this->request = new Request();
        echo __CLASS__ . " [OK]" . PHP_EOL;
    }

    /**
     * @param $view
     * @param array $scope
     * Affiche la vue associé : enlève "Controller" du nom du controller
     * et récupère dans le dossier du même nom "User" or other
     */
    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
                str_replace('Controller', '', basename(get_class($this))), $view]) . '.php';
        if (file_exists($f)) {
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
        }
    }

    /**
     * Affichage du rendu récupéré par la fonction render après traitement des données
     */
    public function __destruct()
    {
        echo self::$_render;
    }
}
