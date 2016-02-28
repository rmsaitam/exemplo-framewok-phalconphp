<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter; 

  try {
     //Registra o autoloader
     $loader = new Loader();
     $loader->registerDirs(array(
	"../app/controllers/",
        "../app/models/"
     ))->register();

    //Cria o DI
    $di = new FactoryDefault();
   
    //Setup the database service
    $di->set("db", function() {
         return new DbAdapter(array(
             "host"     => "localhost",
             "username" => "root",
             "password" => "senha",
             "dbname"   => "dbusers"
          ));
      });
    
    //Setup the view component
    $di->set("view", function(){
       $view = new View();
       $view->setViewsDir("../app/views/");
       return $view;
    });

    //Setup a base URI so thal tall generated URIs include the projetoPhalcon folder
    $di->set("url", function() {
       $url = new UrlProvider();
       $url->setBaseUri("/projetoPhalcon/");
       return $url;
    });

   //Handle the request
   $application = new Application($di);
  
   echo $application->handle()->getContent();


  } catch(\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
  }

?>
