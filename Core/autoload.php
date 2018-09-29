<?php
function myAutoloader($class)
{
    $class = explode('\\', $class);
    $class = end($class);

    if (file_exists('Core/' . $class . '.php')) {
        include 'Core/' . $class . '.php';
        echo "<h2>Call to ". $class . "</h2>";
    } elseif (file_exists('./src/Controller/' . ucfirst($class) . '.php')) {
        include './src/Controller/' . ucfirst($class) . '.php';
        echo "<h2>Call to ". $class . "</h2>";
    } elseif (file_exists('./src/Model/' . ucfirst($class) . '.php')) {
        include './src/Model/' . ucfirst($class) . '.php';
        echo "<h2>Call to ". $class . "</h2>";
    } else {
        echo "This file not exists : " . $class . ".php";
    }
}
spl_autoload_register('myAutoloader');
