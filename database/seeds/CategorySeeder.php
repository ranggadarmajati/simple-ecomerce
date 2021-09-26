<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
        		[       			
        			'name' => 'Pria'
        		],
        		[
        			'name' => 'Wanita',
        		],
        	);

        foreach( $category as $data )
        {
        	Category::firstOrCreate($data);
        }
    }
}
