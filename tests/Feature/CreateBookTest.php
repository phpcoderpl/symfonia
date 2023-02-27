<?php

namespace Tests\Feature;

use App\Models\Book;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateBookTest extends TestCase
{


    public function testValidation(): void
    {

        $faker = Factory::create();

        $this->post('/book', [
            'name' => $faker->name,
            'description' => $faker->text,
            'link' => $faker->url,
        ])
            ->assertStatus(200);

    }
}
