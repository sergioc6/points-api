<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;

class PointsTest extends TestCase
{
    const baseUri = '/api/points';

    public function testIndex()
    {
        $response = $this->getJson(self::baseUri);

        $response
            ->assertStatus(200)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'rows' => [
                        '*' => [
                            'id',
                            'description',
                            'x_axis',
                            'y_axis',
                            'created_at',
                            'updated_at'
                        ]
                    ],
                    'metadata' => [
                        'total',
                        'per_page',
                        'current_page',
                        'total_pages'
                    ]
                ]
            ]);
    }

    public function testShow()
    {
        $response = $this->getJson(self::baseUri . '/8');

        $response
            ->assertStatus(200)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'description',
                    'x_axis',
                    'y_axis',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testCreate()
    {
        $faker = Factory::create();
        $body = [
            'description' => $faker->name,
            'x_axis' => $faker->numberBetween(0, 300),
            'y_axis' => $faker->numberBetween(0, 200),
        ];
        $response = $this->postJson(self::baseUri, $body);

        $response
            ->assertStatus(201)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'description',
                    'x_axis',
                    'y_axis',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testEdit()
    {
        $faker = Factory::create();
        $body = [
            'description' => $faker->name,
            'x_axis' => $faker->numberBetween(0, 300),
            'y_axis' => $faker->numberBetween(0, 200),
        ];
        $response = $this->putJson(self::baseUri . '/1', $body);

        $response
            ->assertStatus(200)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'description',
                    'x_axis',
                    'y_axis',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testDestroy()
    {
        $response = $this->deleteJson(self::baseUri . '/1');

        $response
            ->assertStatus(200)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'description',
                    'x_axis',
                    'y_axis',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testGetNearbyPoints()
    {
        $response = $this->getJson(self::baseUri . '/5/nearby');

        $response
            ->assertStatus(200)
            ->assertJson(
                ['status' => 'success']
            )
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'point' => [
                        'id',
                        'description',
                        'x_axis',
                        'y_axis',
                        'created_at',
                        'updated_at'
                    ],
                    'nearby_points' =>
                        [
                            '*' => [
                                'id',
                                'description',
                                'x_axis',
                                'y_axis',
                                'created_at',
                                'updated_at'
                            ],
                        ],
                ]
            ]);
    }
}
