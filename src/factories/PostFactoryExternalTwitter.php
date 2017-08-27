<?php
/**
 * @file
 * An external twitter post factory.
 */

namespace Oop\Factories;

use Oop\Factories\PostFactoryExternal;
use Oop\Models\Post;
use Oop\TwitterAPIExchange;

/**
 * The twitter post factory.
 */
class PostFactoryExternalTwitter extends PostFactoryExternal {
  // Parent properties.
  private $uri            = "https://api.twitter.com/1.1/statuses/user_timeline.json";
  private $requestMethod  = "GET";
  private $source         = 'twitter';
  private $cacheExpire;

  // Custom properties.
  private $twitterApiExchange;
  private $screenName         = 'ccjjmartin';
  private $count              = 20;
  private $configDir         = '';

  /**
   * Constructor.
   */
  public function __construct($configDir) {
    $this->configDir = $configDir;
    // Creates a $settings variable containing api keys.
    require_once dirname(__FILE__) . $this->configDir . '/settings.php';

    // Set the cache to expire after 24 hours.
    // @todo: Currently this is non functional.
    $this->cacheExpire        = time() + (24 * 60 * 60);

    // Create a new TwitterAPIExchange instance and send it the required
    // settings.
    $this->twitterApiExchange = new TwitterAPIExchange($settings);
  }

  /**
   * Factory method to create posts.
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

  /**
   * The public facing fetch method.
   */
  public function fetch() {

    // Check for previously fetched and saved data.
    $data = $this->load();

    // If the data was not previously saved fetch it.
    if ($data === FALSE) {
      // Fetch data from external source.
      $data = json_decode($this->twitterApiExchange->setGetfield($this->buildGetfield())
                                                    ->buildOauth($this->uri, $this->requestMethod)
                                                    ->performRequest(),
                                            $assoc = TRUE);

      // Data validation before save and return.
      $is_valid_data = $this->validate($data);

      if ($is_valid_data) {
        return $data;
      }
      else {
        return FALSE;
      }
    }

    // Return the data.
    return $data;
  }

  /**
   * Custom method to build the twitter API query parameters.
   */
  private function buildGetField() {
    $getfield = '?screen_name=' . $this->screenName . '&count=' . $this->count;
    return $getfield;
  }

  /**
   * Validate the API data before saving.
   */
  protected function validate($data) {
    if (!empty($data['errors'][0]['message'])) {
      echo "Sorry, the call resulted in an error: " . $data['errors'][0]['message'] . PHP_EOL;
      return FALSE;
    }
    else {
      // Save the data.
      $this->save($data);
    }
    return TRUE;
  }

  /**
   * The private save method to save files to the machine.
   */
  protected function save($data) {
    // Save the file to a known location for retrevial later.
    $fp = fopen(dirname(__FILE__) . $this->configDir . '/files/twitter_cache.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
  }

  /**
   * The private isExpired method to check if the file is too old.
   */
  protected function isExpired() {
    // @todo: Build this functionality.
  }

  /**
   * The private load function to load the file from the machine.
   */
  protected function load() {

    // Check if the know file location exists.
    // If it does, retreive the file, if not return FALSE.
    if (file_exists(dirname(__FILE__) . $this->configDir . '/files/twitter_cache.json')) {
      $string = file_get_contents(dirname(__FILE__) . $this->configDir . '/files/twitter_cache.json');
      $data = json_decode($string, TRUE);
      return $data;
    }
    else {
      return FALSE;
    }
  }

}
