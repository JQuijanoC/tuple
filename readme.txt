/**
 * Class tuple
 * Implements a loosely extended PHP Lavarel-ized version of the Python tuple data type.
 */


Usage:
------
1- Create a new tuple;

<?php
include('tuple.php');
$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
$tinytuple = new tuple("abcd",2.23);

try {
  print_r($mytuple->get()->diff($tinytuple)->select("MySelect"));
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

Methods:
-------
get() -> gets tuple's elements
-----
    get()             // Returns all the elements of the tuple as a tuple
    get(0)            // returns the first element of the tuple  as a tuple
    get("last")       // returns the last element of the tuple  as a tuple
    get(2,":")        // returns all the elements starting on the second  as a tuple
    get(1,":",4)      // returns the all the elements between the 1st and 4th inclusive  as a tuple
    get("last",":",3) // returns the all elements from the last backwards to element 3  as a tuple
    get("last",":")   // returns the all elements from the last backwards to the first element  as a tuple
    get(4,":",1)      // returns the all elements from the 4th element backwards to the first element  as a tuple

dup()  -> duplicates the tuple's elements
-----
dup(2) -> // returns duplicates the tuple's elements twice
dup(n) -> // returns duplicates the tuple's elements n times

$dup_tuple = $mytuple->dup(2); // returns $mytuple+$mytuple;

add() -> adds a tuple to the end of the current tuple object
-----
$compound_tuple = $mytuple->add($tinytuple)  // returns $mytuple + $tinytuple;

diff() - extracts the elements of a tuple from the current tuple object's elements
------
$dif_tupple = $mytuple->diff($tinytuple); // returns $mytuple - $tinytuple;

select('sname') -> Generates and returns an html select id and name = 'sname' , with the tuple's
---------------	 elements as options and the tuple's indexes as values

toArray() -> returns the tuple's elements as an array
---------
$an_array = $mytuple->toArray();


toObject() -> returns the tuple's elements as a php standard object
----------
$an_object = $mytuple->toObject();

Function chaining
-----------------
tuple's functions can be chained.

print_r($mytuple->get()->diff($tinytuple)->select("MySelect"));

// returns an html select with the elements of the difference between $mytuple and $tinytuple

<select id='MySelect' name='MySelect'>
  <option value='0'>786</option>
  <option value='1'>john</option>
  <option value='2'>70.2</option>
</select>


Installation
------------
Just copy the class in tuple.php into your project and use it !!, enjoy

License
-------
MIT