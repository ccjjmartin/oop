<?php
/**
 * @file
 * Example code.
 */

// Chapter 4.

// Cloning.
// PHP 5 plus: $ second and $ first are 2 distinct objects.
// The __clone() method is called on the copied object and not the original.
$second = clone $first;

/**
 * Objects to strings.
 */
class StringExample {

  /**
   * Example __toString() method used for converting an object to a string.
   */
  public function __toString() {
    // Convert to string.
  }

}

/**
 * Callbacks example.
 */
class Product {
  public $ name;
  public $ price;

  function __construct($name, $price) {
    $this->name = $name; $this->price = $price;
  }

}

/**
 * Callbacks example.
 *
 * Why is this helpful?  It allows you to plug in custom functionality at
 * runtime.
 */
class CallbacksExample {
  private $callbacks;

  function registerCallback($callback) {
    if (!is_callable($callback)) {
      throw new Exception("callback not callable");
    }
    $this->callbacks[] = $callback;
  }

  function sale($product) {
    print "{$product->name}: processing \n";
    foreach ($this->callbacks as $callback) {
      call_user_func($callback, $product);
    }
  }

}

// Registering a callback function PHP 5.2 and before.
$logger = create_function('$product', 'print " logging({$product->name})\n";');
$processor = new CallbacksExample();
$processor->registerCallback($logger);

// Registering a anonymous callback function PHP 5.3 and later.
$logger2 = function($product) {
  print " logging ({ $ product-> name})\ n";
};
$processor = new ProcessSale(); $processor->registerCallback($logger2);

// Registering a named function callback.
class Mailer {

  function doMail($product) {
    print "mailing ({$product->name})\n";
  }

}

$processor = new ProcessSale();
// is_callable() is able to handle arrays passed in this manner.
$processor->registerCallback(array(new Mailer(), "doMail"));

// Or implement return an anonymous function.
class Totalizer {

  static function warnAmount() {
    return function($product) {
      if ($product->price > 5) {
        print " reached high price: {$product->price}\ n";
      }
    };
  }

}

$processor = new ProcessSale();
$processor->registerCallback(Totalizer:: warnAmount());

// Don't really understand how we can maintain a reference to count on page 80.
// The page right before Chapter 5.

// Started on Chapter 5, need to go back and gather from 1-4.
// Packages.
// Namespaces.
// Include Paths.
// Class and object functions.
// The Reflection API.
/**
 * Packages.
 *
 * Before PHP 5.3 Namespaces were nonexistant so packages were used.
 * Esentially this means prepending all names with package names so that no
 * name collisions happened.
 *
 * Namespaces.
 * Namespaces fix naming collisions.
 */
namespace com\getinstance\util {
  class Debug {

    static function helloWorld() {
      print "hello from Debug\ n";
    }

  }

  // Call from within a namespace (unqualified name):
  Debug:: helloWorld();

  // Call from outside a namespace (broken - this is a relative namespace):
  com\getinstance\util\Debug::helloWorld();

  // Call from outside a namespace (absoulte namespace):
  \com\getinstance\util\Debug::helloWorld();
}

namespace main {
  use com\getinstance\util\Debug as uDebug; // Aliased and use example.
  Debug::helloWorld();

  Lister:: helloWorld(); // access local
  \Lister:: helloWorld(); // access global
}


// Braces may be used for namespaces if there are multiple per file.  However,
// It is considered best practice to not use braces and declare one namespace
// per file.  Not declaring a name defaults to using the global namespace.
// You can’t use both the brace and line namespace syntaxes in the same file.
// You must choose one and stick to it throughout.
namespace {

}

// Require versus include notes.
// You can’t use both the brace and line namespace syntaxes in the same file.
// You must choose one and stick to it throughout.

// PHP 5 introduced autoload functionality to help automate the inclusion of
// class files.

// Autoloader (built into PHP).  Will attempt to find writer.php or writer.inc.
spl_autoload_register();
$writer = new Writer();

// Autoloader with sub-directories. Searches for util/writer.php.
spl_autoload_register();
$writer = new util\Writer();

// Multiple autoload function calls are acceptable:
spl_autoload_register('replaceUnderscores');
spl_autoload_register('myNamespaceAutoload');

// Looking for classes:
class_exists();

// Making code a bit safer:
$path = "tasks/{$classname}.php";
if (!file_exists($path)) {
  throw new Exception("No such file as {$path}");
}

require_once $path;
$qclassname = "tasks\\$classname";
if (!class_exists($qclassname)) {
  throw new Exception("No such class as $ qclassname");
}

$myObj = new $ qclassname();
$myObj->doSpeak();

// Basic object checking:
// You can also use instanceOf.
$product = getProduct();
if (get_class($product) === 'CdProduct') {
  print "\ $ product is a CdProduct object\ n";
}

// Helpfully PHP 5.5 introduced the ClassName:: class syntax.
// Outputs: util\ Writer
print u\Writer::class . "\n";

// DEBUGGING:
// Could have passed an object.
print_r(get_class_methods('CdProduct'));

// Method name check:
// Doesn't mean it is callable.
if (in_array($method, get_class_methods($product))) {
  // Invoke the method.
  print $ product->$method();
}

// Alternative method name check:
// Is callable seems to be the best method here as it verifies the method can be
// used.
if (is_callable(array($product, $method))) {
  // Invoke the method.
  print $product->$method();
}

// Another method:
// Method exists does not necessarily mean it is callable.
if (method_exists($product, $method)) {
  // Invoke the method.
  print $ product->$method();
}

// You can also check an objects variables:
print_r(get_class_vars('CdProduct'));

// Parent check:
print get_parent_class('CdProduct');

// Acquire an object.
$product = getProduct();
if (is_subclass_of($product, 'ShopProduct')) {
  print "CdProduct is a subclass of ShopProduct\ n";
}

// Interface check:
if (in_array('someInterface', class_implements($product))) {
  print "CdProduct is an interface of someInterface\ n";
}

// Calling methods or functions:
$returnVal = call_user_func("myFunction");
$returnVal = call_user_func(array($myObj, "methodName"));
call_user_func(array($product, 'setDiscount'), 20);

// Delegator class with call_user_func_array.
// Solves problem of not knowing how many arguments you will pass.
function __call($method, $args) {
  if (method_exists($this->thirdpartyShop, $method)) {
    return call_user_func_array(array($this->thirdpartyShop, $method), $args);
  }
}

// Reflection API.
$prod_class = new ReflectionClass('CdProduct');
Reflection::export($prod_class);

// Chapter 6.
// Objects and Design.
// Design Basics.
// Class scope.
// Encapsulation.
// Polymorphism.
// The UML.

// This line of code regarding delegation blows my mind.
// It seems like an object that implements another object shouldn't be able to
// pass itself to the delegated object ... but it appears it can.
function cost() {
  return $this->costStrategy->cost($this);
}
