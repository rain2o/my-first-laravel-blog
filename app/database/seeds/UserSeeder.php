<?php
 
class UserSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'username' => 'rain2o',
            'password' => Hash::make('password'),
            'name' => 'Joel Rainwater'
        ));
        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('password'),
            'name' => 'Site Admin'
        ));    
        User::create(array(
            'username' => 'bszul',
            'password' => Hash::make('password'),
            'name' => 'Site Admin'
        ));    
        User::create(array(
            'username' => 'jmills',
            'password' => Hash::make('password'),
            'name' => 'Jerod Mills'
        ));    
    }
}