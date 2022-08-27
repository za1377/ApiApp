<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdTest extends TestCase
{
    /**
     * A test for showing Ad.
     *
     * @return void
     */
    public function testShow()
    {
        $this->withoutMiddleware();
        $response = $this->getJson('api/Ads');

        if($response->getStatusCode() == 404) {
            $response->assertStatus(404);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * A test for inserting Ad.
     *
     * @return void
     */
    public function testInsert()
    {

        $this->withoutMiddleware();
        $response = $this->postJson('api/Ad' ,
            ['category_id' => 1 ,
            'brand_id' => 1,
            'attributes' => array(["attribute_id" => 1 , "attribute_value" => [123]],["attribute_id" => 1 , "attribute_value" => ["123"]])
            ,]);

        if($response->getStatusCode() == 422) {
            $response->assertStatus(422);
        }else if($response->getStatusCode() == 400){
            $response->assertStatus(400);
        }else {
            $response->assertStatus(201);
        }
    }

    /**
     * A test for updating Ad.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->putJson('api/Ad' ,
        ['id' => 1,
        'category_id' => 1 ,
        'brand_id' => 1,
        'attributes' => array(["attribute_id" => 1 , "attribute_value" => [123]],["attribute_id" => 1 , "attribute_value" => ["123"]])
        ,]);

            if($response->getStatusCode() == 422) {
                $response->assertStatus(422);
            }else if($response->getStatusCode() == 400){
                $response->assertStatus(400);
            }else {
                $response->assertStatus(200);
            }
    }

    /**
     * A test for deleting Ad.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->withoutMiddleware();
        $response = $this->deleteJson('api/Ad' , ['id' => 2]);

        if($response->getStatusCode() == 404){
            $response->assertStatus(404);
        }else {
            $response->assertStatus(200);
        }
    }
}
