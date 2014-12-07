<?php
 
class UserSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'username' => 'rain2o',
            'password' => Hash::make('preston3'),
            'name' => 'Joel Rainwater'
        ));
        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('preston3'),
            'name' => 'Site Admin'
        ));    
        User::create(array(
            'username' => 'bszul',
            'password' => Hash::make('Pa$$w0rd'),
            'name' => 'Site Admin'
        ));    
        User::create(array(
            'username' => 'jmills',
            'password' => Hash::make('Pa$$w0rd'),
            'name' => 'Jerod Mills'
        ));    
    }
}