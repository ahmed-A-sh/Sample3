<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FillDefualtAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminUser = new \App\Models\User();

        $adminUser->name = 'admin';
        $adminUser->email = 'admin';
        $adminUser->mobile = 'admin';
        $adminUser->fcm_token = '';
        $adminUser->password = \Illuminate\Support\Facades\Hash::make('123456789');
        $adminUser->save();
        $role = Role::updateOrCreate(['name' => 'Super User','guard_name' => 'web']);
        $adminUser->assignRole($role);
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
}
