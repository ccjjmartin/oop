<?php
/**
 * @file
 * Twitter feed importer.
 */

// Third Party API wrapper for REST API calls.
require_once 'TwitterAPIExchange.php';

// Creates a $settings variable containing api keys.
require_once 'settings.php';

// Page title.
echo "<h1>My Twitter Feed Test</h1>" . PHP_EOL;

// Build API request.  Twitter Rest API v1.1.
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=ccjjmartin&count=20';

// Check if cached data is avaliable.  If not, request new data.
// @todo: Currently the cache never expires!!!
if (file_exists('files/twitter_cache.json')) {
  $string = file_get_contents('files/twitter_cache.json');
  $data = json_decode($string, TRUE);
  echo "<p>Using cached data, Great!</p>" . PHP_EOL;
}
else {
  $twitter = new TwitterAPIExchange($settings);
  $data = json_decode($twitter->setGetfield($getfield)
                                ->buildOauth($url, $requestMethod)
                                ->performRequest(),
                        $assoc = TRUE);
  echo "Made a call to the TwitterAPI, Uhh Ohh, only 1 per minute is allowed!" . PHP_EOL;

  if (!empty($data['errors'][0]['message'])) {
    echo "Sorry, the call resulted in an error: " . $data['errors'][0]['message'] . PHP_EOL;
    exit;
  }
  else {
    $fp = fopen('files/twitter_cache.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
  }
}

$formatted_data = 1;

if ($formatted_data == 1) {
  foreach ($data as $item) {
    echo "Time and Date of Tweet: " . $item['created_at'] . "<br />";
    echo "Tweet: " . $item['text'] . "<br />";
    echo "Tweeted by: " . $item['user']['name'] . "<br />";
    echo "Screen name: " . $item['user']['screen_name'] . "<br />";
    echo "Followers: " . $item['user']['followers_count'] . "<br />";
    echo "Friends: " . $item['user']['friends_count'] . "<br />";
    echo "Listed: " . $item['user']['listed_count'] . "<br />";
    echo "<br />";
  }
}
else {
  echo "<pre>" . PHP_EOL;
  print_r($data);
  echo "</pre>" . PHP_EOL;
}
