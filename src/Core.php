<?php

namespace Oop;

use Oop\Controllers\PostCollectionPage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * The core class for handling requests.
 */
class Core implements HttpKernelInterface {
  /**
   * The collection of routes.
   *
   * @var RouteCollection
   */
  protected $routes;

  /**
   * The constructor.
   */
  public function __construct() {
    $this->routes = new RouteCollection();
  }

  /**
   * The handle request function.
   */
  public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = TRUE) {
    // Create a context using the current request.
    $context = new RequestContext();
    $context->fromRequest($request);

    $matcher = new UrlMatcher($this->routes, $context);

    try {
      $attributes = $matcher->match($request->getPathInfo());
      $controller = $attributes['_controller'];
      unset($attributes['_controller']);
      $response = call_user_func_array($controller, $attributes);
    }
    catch (ResourceNotFoundException $e) {
      $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
    }

    return $response;
  }

  /**
   * Maps routes.
   */
  public function map($path, $controller) {
    $this->routes->add($path, new Route(
      $path,
      array('_controller' => $controller)
    ));
  }

}
