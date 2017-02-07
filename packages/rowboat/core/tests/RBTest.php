<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_view_page()
    {
    	        $box = new Box(['cat', 'toy', 'torch']);

        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
        $this->assertTrue(true);
    }
}
