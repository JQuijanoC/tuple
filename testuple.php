<?php
/**
 * Test tuple class implementation
 */
include('tuple.php');
$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
$tinytuple = new tuple("abcd",2.23);
try {
  print_r($mytuple->get()->diff($tinytuple)->select("MySelect"));
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

