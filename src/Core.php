<?php

namespace Oop;

use Oop\Controllers\PostCollectionPage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The core class for handling requests.
 */
class Core implements HttpKernelInterface {

  /**
   * The handle request function.
   */
  public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = TRUE) {
    $path = $request->getPathInfo();
    $response = new Response();

    switch ($path) {
      case '/':
      case '/twitter':
      case '/yaml':
        // Load template files.
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader, array(
        //  'cache' => '/compilation_cache',
        //  'debug' => TRUE,
        ));

        // Get the singleton and gather posts from data sources.
        $page = PostCollectionPage::getInstance();
        $page->gatherPosts(substr($path, 1));
        $html = $twig->render('index.twig', array('posts' => $page->renderArray()));
        $response->setContent($html);
        break;

      default:
        $response->setContent('Page not found!');
        $response->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    return $response;
  }

}
