<?php

/**
 * Class tuple
 * Implements a loosely extended PHP Lavarel-ized version of the Python tuple data type.
 */
class tuple{

  /**
   * tuple's data elements
   * @var array
   */
  private $_data;

  /**
   * tuple's number of data elements
   * @var int
   */
  private $_num_elements = 0;

  /**
   * The class constructor accepts parameters, tuple , array
   */
  function __construct() {
    if (! func_num_args()) {
      throw new Exception('Invalid Arguments');
    }
    $params = func_get_args();
    if (is_object($params[0])) {
      if (get_class($params[0]) == tuple) {
        $this->_data = $params[0]->_getData();
        $this->_num_elements = count($this->_data);
      }
    }
    else if (is_array($params[0])) {
      $this->_num_elements = count($params[0]);
      $this->_data = $params[0];
    }
    else {
      $this->_num_elements = func_num_args();
      $this->_data = func_get_args();
    }
  }

  /**
   * Implements basic get functionality for the tuple.
   * get()             // Returns all the elements of the tuple as a tuple
   * get(0)            // returns the first element of the tuple  as a tuple
   * get("last")       // returns the last element of the tuple  as a tuple
   * get(2,":")        // returns all the elements starting on the second  as a tuple
   * get(1,":",4)      // returns the all the elements between the 1st and 4th inclusive  as a tuple
   * get("last",":",3) // returns the all elements from the last backwards to element 3  as a tuple
   * get("last",":")   // returns the all elements from the last backwards to the first element  as a tuple
   * get(4,":",1)      // returns the all elements from the 4th element backwards to the first element  as a tuple
   *
   * @throws Exception
   * @return tuple
   */
  public function get() {
    $results = array();
    $is_last = false;
    $arguments = func_get_args();
    if (func_num_args() > 0) {
      if (is_int($arguments[0])) {
        if ($arguments[0] === 0) {
          $first = 1;
          $last = 1;
        }
        else {
          $first = $arguments[0];
          $last = $this->_num_elements;
        }
      }
      else {
        if ($arguments[0] !='last'){
          throw new Exception('Invalid Arguments');
        }
        $first = $this->_num_elements;
        $last = $first;
        $is_last = true;
      }
      if (isset($arguments[1])) {
        if ($arguments[1] != ':') {
          throw new Exception('Invalid Arguments');
        }
        else if($is_last) {
          $last = 1;
        }
      }
      if (isset($arguments[2])) {
        if (! is_int($arguments[2])) {
          throw new Exception('Invalid Arguments');
        }
        else {
          $last = $arguments[2];
        }
      }
      // Perform partial get
      if ($first <= $last) {
        for ($i = $first-1; $i < $last; $i++) {
          $results[] = $this->_data[$i];
        }
      }
      else {
        for ($i = $first-1; $i >= $last-1; $i--) {
          $results[] = $this->_data[$i];
        }
      }
    }
    else {
      $results = $this->_data;
    }
    return new tuple($results);
  }

  /**
   * Duplicates the tuple at least 1 time, or as many times as requested using the parameter $times
   * @param int $times
   * @return tuple
   */
  public function dup($times = 1) {
    $results = array();
    for ($i = 0; $i <= $times; $i++) {
      $results = array_merge($results, $this->_data);
    }
    return new tuple($results);
  }

  /**
   * Adds $add_tuple to the end of the current tuple instance
   * @param $add_tuple
   * @return tuple
   */
  public function add($add_tuple = '') {
    if (get_class($add_tuple) == 'tuple') {
      $add_array = $add_tuple->_getData();
    }
    else {
      $add_array = $add_tuple;
    }
    $results = array_merge((array) $this->_data, (array) $add_array);
    return new tuple($results);
  }


  /**
   * Diffs $diff_tuple from the current tuple instance and returns the difference
   * @param $diff_tuple
   * @return tuple
   */
  public function diff($diff_tuple = '') {
    if (get_class($diff_tuple) == 'tuple') {
      $diff_array = $diff_tuple->_getData();
    }
    else {
      $diff_array = $diff_tuple;
    }
    $temp_results = array_diff($this->_data,(array) $diff_array);
    // normalize results as a zero based array
    $results = array();
    foreach($temp_results as $result) {
      $results[] = $result;
    }
    return new tuple($results);
  }

  /**
   * Returns tuple elements as an array
   * @return array
   */
  public function toArray() {
    return (array) $this->_data;
  }

  /**
   * Returns tuple elements as a php Standard Object
   * @return stdClass
   */
  public function toObject() {
    return $this->_array_to_object($this->_data);
  }

  /**
   * Returns tuple as an html select statement with each element as an option , each option values is the array index
   * @param string $select_name
   * @return string
   * @throws Exception
   */
  public function select($select_name = "") {
    if (! $select_name) {
      throw new Exception('Invalid Arguments');
    }
    $results = "<select id='".$select_name."' name='".$select_name."'>";
    for($i=0; $i < $this->_num_elements; $i++) {
      $results .= "\n"."<option value='".$i."'>".(string) $this->_data[$i]."</option>";
    }
    $results .= "\n"."</select>";
    return $results;
  }


  // Class utility functions

  /**
   * Returns the tuple's elements
   * @return array
   */
  private function _getData() {
    return $this->_data;
  }

  /**
   * Converts an array to a php standard object
   * @param array $in_array
   * @return stdClass
   */
  private function _array_to_object(array $in_array) {
    $object = new stdClass();
    foreach ($in_array as $key => $value)
    {
      $object->$key = $value;
    }
    return $object;
  }
}