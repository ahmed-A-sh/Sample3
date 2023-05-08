<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->string('search_text');
            $table->integer('search_count');
            $table->timestamps();
        });
        $this->addPermissions();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_histories');
    }
     public function addPermissions()
        {

            $permissions = collect([
                'search_histories.view',
                'search_histories.create',
                'search_histories.edit',
                'search_histories.delete',
                'search_histories.activate',

            ]);
            $this->permissions = $permissions->map(function ($permission) {
                return [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];
            })->toArray();

            $tableNames = config('permission.table_names', [
                'roles' => 'roles',
                'permissions' => 'permissions',
                'model_has_permissions' => 'model_has_permissions',
                'model_has_roles' => 'model_has_roles',
                'role_has_permissions' => 'role_has_permissions',
            ]);

            \Illuminate\Support\Facades\DB::transaction(function () use($tableNames) {
                foreach ($this->permissions as $permission) {
                    $permissionItem = \Illuminate\Support\Facades\DB::table($tableNames['permissions'])->where([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name']
                    ])->first();
                    if ($permissionItem === null) {
                        \Illuminate\Support\Facades\DB::table($tableNames['permissions'])->insert($permission);
                    }
                }
            });
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        }
};
