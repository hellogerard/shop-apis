<?php

require(dirname(__DIR__) . '/lib/limonade.php');

//
// configuration
//

function configure()
{
    option('root_dir', dirname(__DIR__));
    option('views_dir', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
    option('controllers_dir', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controllers');
    option('lib_dir', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lib');
    option('public_dir', __DIR__);
}

function before()
{
    layout('layouts/layout.phtml');
}

//
// application
//

dispatch_get('/', function() {
    return html('index.phtml');
});

dispatch_get('/shopsavvy/:id', function($id) {

    if (empty($id))
    {
        halt(NOT_FOUND);
    }

    $json = file_get_contents("http://api.developer.shopsavvy.mobi/products/{$id}.json?apikey=91f7ccdc3a32b5ba899e64fd191942c8");
    return $json;
});

run();
