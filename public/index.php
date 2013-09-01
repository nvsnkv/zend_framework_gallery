<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$frontController = Zend_Controller_Front::getInstance();
$router = $frontController->getRouter();

$router->addRoute('album',
    new Zend_Controller_Router_Route('Album/:id', array(
        'controller' => 'album',
        'action' => 'index'
    ))
);

$router->addRoute('edit_album',
    new Zend_Controller_Router_Route('Album/:id/Edit', array(
        'controller' => 'album',
        'action' => 'edit'
    ))
);

$router->addRoute('upload_to_album',
    new Zend_Controller_Router_Route('Album/:id/Upload', array(
        'controller' => 'album',
        'action' => 'upload'
    ))
);

$router->addRoute('remove_album',
    new Zend_Controller_Router_Route('Album/:id/Remove', array(
        'controller' => 'album',
        'action' => 'remove'
    ))
);

$router->addRoute('show_picture',
    new Zend_Controller_Router_Route('Picture/:hash/', array(
        'controller' => 'picture',
        'action' => 'index'
    ))
);

$router->addRoute('show_picture',
    new Zend_Controller_Router_Route('Picture/:hash/Remove', array(
        'controller' => 'picture',
        'action' => 'remove'
    ))
);
$application->bootstrap()
            ->run();