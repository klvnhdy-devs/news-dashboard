<?php

namespace Tests\Feature;

use App\Models\newsModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class insertTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
       $create = newsModel::Factory()->create();
       $createNews = $create ? true : false;
       $this->assertTrue($createNews);
    }
}
