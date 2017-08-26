<?php

$loader = require_once '../vendor/autoload.php';
$loader->addPsr4('Oop\\', __DIR__ . '/../src');

use Oop\Controllers\PostCollectionPage;
use Oop\Factories\PostFactoryLocalYaml;

// Include singleton class to create the temporary display page.
// @todo: Ultimately would be replaced by a router.
// Get the singleton and gather posts from data sources.
$page = PostCollectionPage::getInstance();
$page->gatherPosts('yaml');

// Print a page title.
// @todo: Ultimately replace with a twig template.
print "<h1 style='margin:2em 0'><center>Christopher Martin's Twitter Posts</center></h1>";

// Call the render HTML method from the page singleton.
print $page->renderHTML();
