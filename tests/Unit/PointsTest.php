<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;

class PointsTest extends TestCase
{
    const baseUri = '/api/points';

    /**
     *
     */
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

    /**
     * @return mixed
     */
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

        $reponseData = json_decode($response->getContent(), true);
        return $reponseData['data']['id'];
    }

    /**
     * @param $id
     * @depends testCreate
     */
    public function testShow($id)
    {
        $response = $this->getJson(self::baseUri . '/' . $id);

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

    /**
     * @param $id
     * @depends testCreate
     */
    public function testEdit($id)
    {
        $faker = Factory::create();
        $body = [
            'description' => $faker->name,
            'x_axis' => $faker->numberBetween(0, 300),
            'y_axis' => $faker->numberBetween(0, 200),
        ];
        $response = $this->putJson(self::baseUri . '/' . $id, $body);

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

    /**
     * @param $id
     * @depends testCreate
     */
    public function testGetNearbyPoints($id)
    {
        $response = $this->getJson(self::baseUri . '/' . $id . '/nearby');

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

    /**
     * @param $id
     * @depends testCreate
     */
    public function testDestroy($id)
    {
        $response = $this->deleteJson(self::baseUri . '/' . $id);

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
}
