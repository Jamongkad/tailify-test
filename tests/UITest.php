<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UITest extends TestCase
{
    public function testMainPage() {
        $this->visit('/')
             ->see('Tailify Test');
    }
}
