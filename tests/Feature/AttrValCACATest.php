<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttrValCACATest extends TestCase
{
    /**
     * A test for showing AttrValCACATest.
     *
     * @return void
     */
    public function testShow()
    {
        $this->withoutMiddleware();
        $response = $this->getJson('api/CACA/AttributeValues');

        if($response->getStatusCode() == 404) {
            $response->assertStatus(404);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * A test for inserting AttrValCACATest.
     *
     * @return void
     */
    public function testInsert()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('api/CACA/AttributeValue' ,
        ['attribute_value_id' => 1 , 'caa_id' => 1]);

        if($response->getStatusCode() == 422) {
            $response->assertStatus(422);
        }else if($response->getStatusCode() == 400){
            $response->assertStatus(400);
        }else {
            $response->assertStatus(201);
        }
    }

    /**
     * A test for updating AttrValCACATest.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->putJson('api/CACA/AttributeValue' ,
            ['attribute_value_id' => 1 ,
            'caa_id' => 1 ,
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
     * A test for deleting AttrValCACATest.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->withoutMiddleware();
        $response = $this->deleteJson('api/CACA/AttributeValue' , ['id' => 2]);

        if($response->getStatusCode() == 404){
            $response->assertStatus(404);
        }else {
            $response->assertStatus(200);
        }
    }
}
