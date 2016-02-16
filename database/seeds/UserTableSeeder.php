<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        factory('CodeCommerce\User')->create(

            [
                'name' => 'Sandro',
                'email' => 'rochasandro378@gmail.com',
                'password' => Hash::make(123),
                'is_admin' => 1
            ]
        );

        //factory('CodeCommerce\User', 10)->create();
    }
}