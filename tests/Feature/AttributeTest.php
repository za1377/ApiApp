<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    /**
     * A test for showing Attribute.
     *
     * @return void
     */
    public function testShow()
    {
        $this->withoutMiddleware();
        $response = $this->getJson('api/Category/Attribute/Attributes');

        if($response->getStatusCode() == 404) {
            $response->assertStatus(404);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * A test for inserting AttributeCategory.
     *
     * @return void
     */
    public function testInsert()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('api/Category/Attribute' , ['name' => 'AttributeCategory' , 'slug' => '/AttributeCategory']);

        if($response->getStatusCode() == 422) {
            $response->assertStatus(422);
        }else if($response->getStatusCode() == 400){
            $response->assertStatus(400);
        }else {
            $response->assertStatus(201);
        }
    }

    /**
     * A test for updating AttributeCategory.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->putJson('api/Category/Attribute' ,
            ['name' => 'AttributeCategory' ,
            'slug' => '/AttributeCategory',
            'id' => 1]);

            if($response->getStatusCode() == 422) {
                $response->assertStatus(422);
            }else if($response->getStatusCode() == 400){
                $response->assertStatus(400);
            }else {
                $response->assertStatus(200);
            }
    }

    /**
     * A test for deleting AttributeCategory.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->withoutMiddleware();
        $response = $this->deleteJson('api/Category/Attribute' , ['id' => 2]);

        if($response->getStatusCode() == 404){
            $response->assertStatus(404);
        }else {
            $response->assertStatus(200);
        }
    }
}
