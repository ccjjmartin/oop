<?php
/**
 * @file
 * A post object.
 */

/**
 * Post object.
 */
class Post {
  public $author;
  public $created;
  public $body;
  public $type;

  /**
   * Basic constructor for the post object.
   */
  public function __construct($author, $created, $body, $type) {
    $this->author  = $author;
    $this->created = $created;
    $this->body    = $body;
    $this->type    = $type;
  }

  /**
   * A basic function to return an html representation of a post.
   */
  public function renderHtml() {

    // Before rendering it would be useful to validate the data and sanitize it.
    $output = '';

    // Replace with twig template.
    $output .= '<div class="post ' . $this->type . '" style="
      border: solid;
      padding: .5em;
      margin: 1.0em;
    ">';

    $output .= $this->author . ' on ' . $this->created . ' said: </br></br>';
    $output .= $this->body . '</br>';

    $output .= '</div></br>';

    return $output;
  }

}
