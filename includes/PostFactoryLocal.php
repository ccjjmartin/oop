<?php
/**
 * @file
 * A local post factory.
 */

 // Require base class.
 require_once 'PostFactory.php';

/**
 * Local post factory.
 */
abstract class PostFactoryLocal extends PostFactory {
  private $filepath;

  /**
   * The public retrieve data method.
   */
  abstract public function retrieveData();

}
