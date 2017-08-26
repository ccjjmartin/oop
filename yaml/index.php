<?php

// Required classes.
require_once 'PostFactoryLocalYaml.php';

// Include singleton class to create the temporary display page.
// @todo: Ultimately would be replaced by a router.
require_once '../includes/PostCollectionPage.php';

// Get the singleton and gather posts from data sources.
$page = PostCollectionPage::getInstance();
$page->gatherPosts('yaml');

// Print a page title.
// @todo: Ultimately replace with a twig template.
print "<h1 style='margin:2em 0'><center>Christopher Martin's Twitter Posts</center></h1>";

// Call the render HTML method from the page singleton.
print $page->renderHTML();
