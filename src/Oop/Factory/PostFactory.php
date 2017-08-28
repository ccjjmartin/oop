<?php
/**
 * @file
 * An abstract PostFactory class and the RetreivableInterface.
 */

namespace Oop\Factory;

/**
 * The retreivable interface.
 */
interface RetreivableInterface {

  /**
   * The retreive function to gather data.
   */
  public function retrieveData();

}

/**
 * Post factory.
 */
abstract class PostFactory implements RetreivableInterface {

  /**
   * Factory method to create posts.
   */
  abstract public function createPosts($data);

}
