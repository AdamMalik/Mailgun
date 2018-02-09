<?php

use Illuminate\Database\Seeder;

class DummyMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<100;$i++){
        	DB::table('Messages')->insert([
	            'subject' => 'untuk admin ke - '.$i,
	            'to_user' => 'admin@ingo.com',
	            'from_user' => 'sadnessman182@gmail.com',
	            'message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum a aspernatur necessitatibus facilis culpa. Voluptates veniam, quaerat? Blanditiis veniam quia voluptatibus voluptatum, nisi fuga, a eius, doloremque tempore nostrum dolore.',
                'role' => 0,
	        ]);
        }
    }
}
