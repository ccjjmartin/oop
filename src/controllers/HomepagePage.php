<?php

namespace Oop\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Oop\Controllers\PostCollectionPage;

/**
 * A controller to build the homepage.
 */
class HomepagePage {

  /**
   * Display homepage.
   */
  public function homepage() {
    $page = new PostCollectionPage();
    $response = $page->displayPosts();
    return $response;
  }

}
