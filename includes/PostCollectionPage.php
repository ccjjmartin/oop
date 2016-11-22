<?php
/**
 * @file
 * Singleton class to display temporary home page to test functionality.
 *
 * Thanks to: http://www.phptherightway.com/pages/Design-Patterns.html for
 * example patterns in PHP.
 */

require_once 'twitter/PostFactoryExternalTwitter.php';

/**
 * A singleton pattern class to produce the homepage.
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
   * Returns the *Singleton* instance of this class.
   *
   * @return Singleton
   *   The *Singleton* instance.
   */
  public static function getInstance() {

    if (NULL === static::$instance) {
      static::$instance = new static();
    }

    return static::$instance;
  }

  /**
   * Constructor method.
   *
   * Protected constructor to prevent creating a new instance of the
   * *Singleton* via the `new` operator from outside of this class.
   */
  protected function __construct() {

  }

  /**
   * Private clone method to prevent cloning of the *Singleton* instance.
   */
  private function __clone() {

  }

  /**
   * Private unserialize method to prevent unserializing of the *Singleton*.
   */
  private function __wakeup() {

  }

  /**
   * Gather posts.
   */
  public function gatherPosts($type = 'all') {

    // An array of post objects.
    $posts = array();

    // Temporarily hard coded a reference to a known class.
    // This could be improved by using a searching for all classes that extend
    // the PostFactory class and are not abstract.
    //
    // if ($type == 'csv' || $type == 'all') {
    // $posts += LocalCsvFactory::retrieve();
    // }
    // if ($type == 'yaml' || $type == 'all') {
    // $posts += LocalYmlFactory::retrieve();
    // }
    //
    if ($type == 'twitter' || $type == 'all') {
      $twitter = new PostFactoryExternalTwitter();
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
   * Render HTML method.
   *
   * @todo: Replace this code with a twig template.
   */
  public function renderHtml() {
    $output = '';

    if (!empty($this->posts)) {
      foreach ($this->posts as $post_key => $post_object) {
        $output .= $this->posts[$post_key]->renderHtml();
      }
    }

    return $output;
  }

}
