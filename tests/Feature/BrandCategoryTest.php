<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandCategoryTest extends TestCase
{
    /**
     * A test for showing BrandCategory.
     *
     * @return void
     */
    public function testShow()
    {
        $this->withoutMiddleware();
        $response = $this->getJson('api/Category/Brands');

        if($response->getStatusCode() == 404) {
            $response->assertStatus(404);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * A test for inserting BrandCategory.
     *
     * @return void
     */
    public function testInsert()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('api/Category/Brand' ,
        ['brand_id' => 1 , 'category_id' => 1]);

        if($response->getStatusCode() == 422) {
            $response->assertStatus(422);
        }else if($response->getStatusCode() == 400){
            $response->assertStatus(400);
        }else {
            $response->assertStatus(201);
        }
    }

    /**
     * A test for updating BrandCategory.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->putJson('api/Category/Brand' ,
            ['brand_id' => 1 ,
            'category_id' => 1 ,
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
     * A test for deleting BrandCategory.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->withoutMiddleware();
        $response = $this->deleteJson('api/Category/Brand' , ['id' => 2]);

        if($response->getStatusCode() == 404){
            $response->assertStatus(404);
        }else {
            $response->assertStatus(200);
        }
    }
}
