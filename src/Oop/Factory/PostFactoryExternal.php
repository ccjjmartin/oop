<?php
/**
 * @file
 * An abstract PostFactoryExternal and FetchableInterface.
 */

namespace Oop\Factory;

use Oop\Factory\PostFactory;

/**
 * The fetchable interface.
 */
interface FetchableInterface {

  /**
   * The fetch function.
   */
  public function fetch();

}

/**
 * External post factory.
 */
abstract class PostFactoryExternal extends PostFactory implements FetchableInterface {
  private $uri;
  private $requestMethod;
  private $source;
  private $cacheExpire;

  /**
   * The public retrieve data method.
   */
  public function retrieveData() {
    return $this->fetch();
  }

  /**
   * The public fetch method to gather data.
   */
  abstract public function fetch();

  /**
   * The private validate method to verify data before saving.
   */
  abstract protected function validate($data);

  /**
   * The private save method to save files to the machine.
   */
  abstract protected function save($data);

  /**
   * The private isExpired method to check if the file is too old.
   */
  abstract protected function isExpired();

  /**
   * The private load function to load the file from the machine.
   */
  abstract protected function load();

}
