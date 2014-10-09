<?php
include('../Tuple.php');
class TupleTest extends PHPUnit_Framework_TestCase
{
	/**
     * @expectedException Exception
     */
    public function testContructException()
    {
        $mytuple = new tuple();

    }

    /**
    * Verify construct creates a Tuple object
    */
    public function testConstruct()
    {
    	$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$this->assertInstanceOf('Tuple', $mytuple);
    }

    /**
    * Verify Tuple to Array
    */
    public function testToArray()
    {
    	$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$result_array = $mytuple->toArray();
    	$this->assertEquals($result_array, ['abcd', 786 , 2.23, 'john', 70.2 ]);
    }

    /**
    * Test Gets using toArray to verify assertions
    */
    public function testGet()
    {
    	$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$result_array = $mytuple->get()->toArray();
    	$this->assertEquals($result_array, ['abcd', 786 , 2.23, 'john', 70.2 ]);
    	// get first element
    	$result_array = $mytuple->get(0)->toArray();
    	$this->assertEquals($result_array, ['abcd']);
    	// get last element
    	$result_array = $mytuple->get('last')->toArray();
    	$this->assertEquals($result_array, [70.2]);
    	// get from to last
    	$result_array = $mytuple->get(2,":")->toArray();
    	$this->assertEquals($result_array, [786 , 2.23, 'john', 70.2]);
		// get forward range
    	$result_array = $mytuple->get(1,":",4)->toArray();
    	$this->assertEquals($result_array, ['abcd', 786 , 2.23, 'john']);
    	// get last to first (backwards)
    	$result_array = $mytuple->get("last",":")->toArray();
    	$this->assertEquals($result_array, [70.2,'john',2.23,786,'abcd']);
		// get backwards range
    	$result_array = $mytuple->get("last",":",3)->toArray();
    	$this->assertEquals($result_array, [70.2,'john',2.23]);
    }

    /**
    * Test Dup using toArray to verify assertions
    */
    public function testDup()
    {
    	$tinytuple = new tuple("abcd",2.23);
    	$result_array = $tinytuple->dup()->toArray();
    	$this->assertEquals($result_array, ['abcd', 2.23, 'abcd', 2.23]);
		// test multiple dup
    	$result_array = $tinytuple->dup(2)->toArray();
    	$this->assertEquals($result_array, ['abcd', 2.23, 'abcd', 2.23, 'abcd', 2.23]);
	}

    /**
    * Test Diff using toArray to verify assertions
    */

   	// test exception if not args
	/**
	 * @expectedException Exception
	*/
    public function testDiffException()
    {
		$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$result_array = $mytuple->diff();

    }

    public function testDiff()
    {
    	$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$tinytuple = new tuple('abcd',2.23);
    	// test diff
    	$result_array = $mytuple->diff($tinytuple)->toArray();
    	$this->assertEquals($result_array, [786,  'john', 70.2]);
	}

    /**
    * Test Add using toArray to verify assertions
    */

   	// test exception if not args
	/**
	 * @expectedException Exception
	*/
    public function testADDException()
    {
		$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$result_array = $mytuple->add();

    }

    public function testAdd()
    {
    	$mytuple = new tuple('abcd', 786 , 2.23, 'john', 70.2 );
    	$tinytuple = new tuple('abcd',2.23);
    	// test add
    	$result_array = $mytuple->add($tinytuple)->toArray();
    	$this->assertEquals($result_array, ['abcd', 786 , 2.23, 'john', 70.2, 'abcd', 2.23]);
	}

	// test Standard Object

	public function tesToObject() {
		$assert_object = new stdClass('abcd',2.23);
    	$tinytuple = new tuple('abcd',2.23);
		$myobject = $tinytuple->toObject();
    	$this->assertEquals($myobject, $assert_object);

	}

	// test html select generation

	/**
	 * @expectedException Exception
	*/
	public function testHtmlSelectNoArgs(){
		$html_select = "<select id='MySelect' name='MySelect'>\n<option value='0'>abcd</option>\n<option value='1'>2.23</option>\n</select>";
    	$tinytuple = new tuple('abcd',2.23);
		$gen_html = $tinytuple->select();
	}

	public function testHtmlSelect(){
		$html_select = "<select id='MySelect' name='MySelect'>\n<option value='0'>abcd</option>\n<option value='1'>2.23</option>\n</select>";
    	$tinytuple = new tuple('abcd',2.23);
		$gen_html = $tinytuple->select('MySelect');
		$this->assertEquals($gen_html, $html_select);
	}


}
?>