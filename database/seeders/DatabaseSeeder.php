<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Brands;
use App\Models\categories;
use App\Models\Attributes;
use App\Models\AttributeCategories;
use App\Models\Categories_AttributesCategories;
use Illuminate\Support\Facades\DB;
use App\Models\CACA;
use App\Models\AttributesTypes;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory()->count(5)->create();
        \App\Models\User::factory()->count(5)->create();

        DB::table('attributes_types')->insert([
            'name' => 'integer',
            'slug' => '/integer',
        ]);

        DB::table('attributes_types')->insert([
            'name' => 'string',
            'slug' => '/string',
        ]);

        DB::table('attributes_types')->insert([
            'name' => 'images',
            'slug' => '/images',
        ]);

        DB::table('attributes_types')->insert([
            'name' => 'selectbox',
            'slug' => '/selectbox',
        ]);

        DB::table('attributes_types')->insert([
            'name' => 'checkbox',
            'slug' => '/checkbox',
        ]);

        for($i=1 ; $i <= 5 ; $i++){
            $brand = Brands::create([
                'name' => 'brand'.$i,
                'slug' => 'brand'.$i,
            ]);

            $category = categories::create([
                'name' => 'category'.$i,
                'slug' => 'category'.$i,
            ]);

            $attribute = Attributes::create([
                'name' => 'attribute'.$i,
                'slug' => 'attribute'.$i,
            ]);

            $attribute_category = AttributeCategories::create([
                'name' => 'attribute_category'.$i,
                'slug' => 'attribute_category'.$i,
            ]);

            $brands_categories = DB::table('brands_categories')->insert([
                'brand_id' => $brand->id,
                'category_id' => $category->id,
            ]);

            $cate_attr_cate = Categories_AttributesCategories::create([
                'attribute_category_id' => $attribute_category->id,
                'category_id' => $category->id,
            ]);

            $CACA = DB::table('c_a_c_a')->insert([
                'cate_atrre_cate_id' => $cate_attr_cate->id,
                'attributes_id' => $attribute->id,
            ]);
        }

        for($i =1 ; $i<=5 ;$i++){
            $CACA = CACA::find($i);
            $AttributesTypes = AttributesTypes::find($i);
            DB::table('attributes_types_caas')->insert([
                'caa_id' => $CACA->id,
                'attribute_type_id' => $AttributesTypes->id,
            ]);
        }
    }
}
