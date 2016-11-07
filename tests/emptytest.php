<?php
/**
 * @file
 * Empty test for verfiying testing environement install.
 */

use PHPUnit\Framework\TestCase;

require_once './vendor/autoload.php';

/**
 * An empty test to verify that phpunit is installed.
 */
class EmtpyTest extends TestCase {

  /**
   * Add the required setUp function.
   */
  protected function setUp() {
  }

  /**
   * Add an empty test by starting with the string "test".
   */
  public function testEmpty() {
  }

  /**
   * Add an empty test by declaring the test using the @ mention convention.
   *
   * @test
   */
  public function docTest() {
  }

  /**
   * Add an empty function that is not considered a test.
   */
  public function noDocTest() {
  }

}
