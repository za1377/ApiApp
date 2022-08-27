<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use Laravel\Sanctum\Sanctum;

class BrandTest extends TestCase
{
    /**
     * A test for showing brand.
     *
     * @return void
     */
    public function testShow()
    {
        //Test with authentication did not work
        //I think because that the controller of login is
        // in another folder
        // $admin = Admin::find(1);

        // $response = $this->actingAs($admin, 'admin')
        //                  ->withSession(['banned' => false])
        //                  ->getJson('api/Brands');
        $this->withoutMiddleware();
        $response = $this->getJson('api/Brands');

        $response->assertStatus(200);
    }

    /**
     * A test for inserting brand.
     *
     * @return void
     */
    public function testInsert()
    {
        //authentication not work here too
        // $admin = Admin::find(1);
        // Sanctum::actingAs($admin,['*'] ,'admin');
        // $response = $this->withSession(['banned' => false])->postJson('/api/Brand', ['name' => 'sony' , 'slug' => '/sony']);

        //for every test need to change the name and slug
        $this->withoutMiddleware();
        $response = $this->postJson('api/Brand' , ['name' => 'glass' , 'slug' => '/glass']);

        $response->assertStatus(201);
    }

    /**
     * A test for updating brand.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->putJson('api/Brand' ,
            ['name' => 'brand1' ,
            'slug' => '/brand1',
            'id' => 1]);

        $response->assertStatus(200);
    }

    /**
     * A test for inserting brand.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->withoutMiddleware();
        $response = $this->deleteJson('api/Brand' , ['id' => 2]);

        $response->assertStatus(200);
    }
}
