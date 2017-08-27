<?php
/**
 * @file
 * A local post factory.
 */

namespace Oop\Factories;

use Symfony\Component\Yaml\Yaml;
use Oop\Factories\PostFactoryLocal;
use Oop\Models\Post;

/**
 * Local post factory.
 */
class PostFactoryLocalYaml extends PostFactoryLocal {
  private $filepath;
  private $source         = 'yaml';
  private $configDir      = '';

  /**
   * Constructor.
   */
  public function __construct($configDir) {
    $this->configDir = $configDir;
  }

  /**
   * The public retrieve data method.
   */
  public function retrieveData() {
    $data = Yaml::parse(file_get_contents($this->configDir . '/data.yml'));
    return $data;
  }

  /**
   * The private load function to load the file from the machine.
   */
  protected function load() {

  }

  /**
   * The private load function to load the file from the machine.
   */
  public function createPosts($data) {
    $posts_array = array();

    // Loop through the provided twitter API data and create Post instances.
    foreach ($data as $item) {
      $new_post = new Post(
        $item['user']['name'],
        $item['user']['screen_name'],
        $item['created_at'],
        $item['text'],
        $this->source
      );

      // Create an array of Post objects to be returned.
      // @todo: This could be changed to a collection class or added as a
      // property to this class.
      $posts_array[] = $new_post;
    }

    return $posts_array;
  }

}
