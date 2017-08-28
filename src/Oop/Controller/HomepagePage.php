<?php

namespace Oop\Controller;

use Symfony\Component\HttpFoundation\Response;
use Oop\Controller\PostCollectionPage;

/**
 * A controller to build the homepage.
 */
class HomepagePage {

  /**
   * Display homepage.
   *
   * @Route("/", name="homepage")
   */
  public function homepage() {
    $page = new PostCollectionPage();
    $response = $page->displayPosts();
    return $response;
  }

}
