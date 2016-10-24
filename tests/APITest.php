<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APITest extends TestCase
{
    public function testGetPhotos() {
        $jsonMockObj = [];
        $jsonMockObj['images'] = [];
        $this->json('GET', '/api/photos', [])
             ->seeJsonStructure($jsonMockObj);
    }

    public function testPastebin() {
        $jsonMockObj['status'] = 'success';
        $this->json('POST', '/api/pastebin', ['payload' => 'Harambe - 1231232 bytes'])
             ->seeJson($jsonMockObj);
    }
}
