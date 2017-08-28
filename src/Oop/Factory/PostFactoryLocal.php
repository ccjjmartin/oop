<?php
/**
 * @file
 * A local post factory.
 */

namespace Oop\Factory;

use Oop\Factory\PostFactory;

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
