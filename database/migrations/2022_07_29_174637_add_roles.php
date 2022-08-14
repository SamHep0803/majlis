<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create(
            [
                'key' => 'SYS',
                'description' => 'System Administrator',
            ]
        );

        Role::create(
            [
                'key' => 'VDI',
                'description' => 'vACC Director',
            ]
        );

        Role::create(
            [
                'key' => 'EVENT',
                'description' => 'Event Manager',
            ]
        );

        Role::create(
            [
                'key' => 'USER',
                'description' => 'User',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
