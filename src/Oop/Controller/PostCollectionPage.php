<?php

namespace Oop\Controller;

use Oop\Factory\PostFactoryLocalYaml;
use Oop\Factory\PostFactoryExternalTwitter;
use Symfony\Component\HttpFoundation\Response;

/**
 * A controller to build a display of posts.
 */
class PostCollectionPage {

  /**
   * Singleton The reference to *Singleton* instance of this class.
   */
  private static $instance;

  /**
   * A collection of posts.
   */
  private $posts;

  /**
   * Gather posts.
   */
  public function gatherPosts($type = 'all') {
    if (empty($type)) {
      $type = 'all';
    }

    // An array of post objects.
    $posts = array();

    // Temporarily hard coded a reference to a known class.
    // This could be improved by using a searching for all classes that extend
    // the PostFactory class and are not abstract.
    //
    // if ($type == 'csv' || $type == 'all') {
    // $posts += LocalCsvFactory::retrieve();
    // }
    if ($type == 'yaml' || $type == 'all') {
      $yaml = new PostFactoryLocalYaml('files/yaml');
      $data = $yaml->retrieveData();
      $posts += $yaml->createPosts($data);
    }

    if ($type == 'twitter' || $type == 'all') {
      $twitter = new PostFactoryExternalTwitter('/../../files/twitter');
      $data = $twitter->retrieveData();
      $posts += $twitter->createPosts($data);
    }

    $this->addPosts($posts);
  }

  /**
   * Add posts method.
   */
  private function addPosts($posts = array()) {
    if (!empty($posts) && is_array($posts)) {
      // Could add additional error checking here to verify that each post is
      // and instance of the Post object.
      foreach ($posts as $post) {
        $this->posts[] = $post;
      }
    }
  }

  /**
   * Render array method.
   */
  public function renderArray() {
    $output = array();

    if (!empty($this->posts)) {
      foreach ($this->posts as $post_key => $post_object) {
        $output[] = array(
          'author' => $this->posts[$post_key]->author,
          'screenName' => $this->posts[$post_key]->screenName,
          'created' => $this->posts[$post_key]->created,
          'body' => $this->posts[$post_key]->body,
        );
      }
    }

    return $output;
  }

  /**
   * Display posts.
   */
  public function displayPosts($type = 'all') {
    $response = new Response();
    switch ($type) {
      case 'all':
      case 'twitter':
      case 'yaml':
        // Load template files.
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader, array(
        // 'cache' => '/compilation_cache',
        //  'debug' => TRUE,.
        ));

        // Gather posts from data sources.
        $this->gatherPosts($type);
        $html = $twig->render('index.twig', array('posts' => $this->renderArray()));
        $response->setContent($html);
        return $response;

    }
  }

}
