<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(array(
            array(
            'Sname' => "Progressing",
            ),
            array(
            'Sname' => "Verified",
          
            ),
            array(
                'Sname' => "Not Received",
              
            ),
                array(
                    'Sname' => "Cancelled",
                  
                ),
            ));
        // DB::table('statuses')->insert([
        //     'Sname' => 'Progressing',
        //     'Sname' => 'Verified',
        //     'Sname' => 'Not Received',
        //     'Sname' => 'Cancelled',
        // ]);
        
       
    }
}
