<?php
/**
 * @file
 * Temporary home page to test functionality.
 */

$loader = require_once 'vendor/autoload.php';
$loader->addPsr4('Oop\\', __DIR__ . '/src');

use Oop\Controllers\PostCollectionPage;
use Oop\Factories\PostFactoryExternalTwitter;

// Include singleton class to create the temporary display page.
// @todo: Ultimately would be replaced by a router.
// Get the singleton and gather posts from data sources.
$page = PostCollectionPage::getInstance();
$page->gatherPosts('twitter');

// Load template files.
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
//  'cache' => '/compilation_cache',
//  'debug' => TRUE,
));
echo $twig->render('index.twig', array('posts' => $page->renderArray()));
