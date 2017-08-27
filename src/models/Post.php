<?php
/**
 * @file
 * A post object.
 */

namespace Oop\Models;

/**
 * Post object.
 */
class Post {
  public $author;
  public $screenName;
  public $created;
  public $body;
  public $type;

  /**
   * Basic constructor for the post object.
   */
  public function __construct($author, $screenName, $created, $body, $type) {
    $this->author = $author;
    $this->screenName  = $screenName;
    $this->created = $created;
    $this->body = $body;
    $this->type = $type;
  }

}
