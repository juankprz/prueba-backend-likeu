<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(
            [
                'slug' => 'Programada'
            ]
        );
        Status::create(
            [
                'slug' => 'Realizada'
            ]
        );
        Status::create(
            [
                'slug' => 'Cancelada'
            ]
        );
        Status::create(
            [
                'slug' => 'No Asistida'
            ]
        );
    }
}
