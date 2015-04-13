<?php

/**
 * 
 * Webservices
 * 
 */
Router::resourceMap(array(
    array('action' => 'index', 'method' => 'GET', 'id' => false),
    array('action' => 'view', 'method' => 'GET', 'id' => true),
    array('action' => 'add', 'method' => 'POST', 'id' => false),
    array('action' => 'edit', 'method' => 'PUT', 'id' => true),
    array('action' => 'delete', 'method' => 'DELETE', 'id' => true)
));
Router::mapResources('users');
Router::parseExtensions('json', 'pdf');

/**
 * 
 * Application Routes
 * 
 */
Router::connect('/home/ordonnance-patient-:id-:limit', array('controller' => 'prescriptions', 'action' => 'ordonnance_patient', 'home' => true), array(
    'pass' => array('id','limit'), 'id' => '[a-z0-9]+','limit' => '[0-1]{1}+'
));
Router::connect('/', array('controller' => 'users', 'action' => 'login'));
//Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/home', array('controller' => 'pages', 'action' => 'home', 'home' => true));
Router::connect('/patient', array('controller' => 'patients', 'action' => 'index', 'home' => true));
Router::connect('/patients/add', array('controller' => 'patients', 'action' => 'add', 'home' => true));
Router::connect('/patients/edit/:id', array('controller' => 'patients', 'action' => 'edit', 'home' => true), array('pass' => array('id'), 'id' => '[0-9a-z]+'));
Router::connect('/patients/delete/:id', array('controller' => 'patients', 'action' => 'delete', 'home' => true), array('pass' => array('id'), 'id' => '[0-9a-z]+'));
Router::connect('/personnel', array('controller' => 'users', 'action' => 'index', 'home' => true));
Router::connect('/consultation', array('controller' => 'consultations', 'action' => 'index', 'home' => true));

/**
 * 
 * Administration Routes
 * 
 */
Router::connect('/admin', array('controller' => 'pages', 'action' => 'home', 'admin' => true));
Router::connect('/admin/grh', array('controller' => 'users', 'action' => 'index', 'admin' => true));
Router::connect('/admin/grh/edit/:id', array('controller' => 'users', 'action' => 'edit', 'admin' => true), array('pass' => array('id')));
Router::connect('/admin/grh/delete/:id', array('controller' => 'users', 'action' => 'delete', 'admin' => true), array('pass' => array('id')));
Router::connect('/admin/chambre', array('controller' => 'chambres', 'action' => 'index', 'admin' => true));
Router::connect('/admin/allnotif/:else', array('controller' => 'pages', 'action' => 'all_notif', 'admin' => true), array('pass' => array('else')));
Router::connect('/admin/allnotif', array('controller' => 'pages', 'action' => 'all_notif', 'admin' => true));


/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
