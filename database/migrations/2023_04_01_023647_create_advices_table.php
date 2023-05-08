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
        Schema::create('advices', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->string('youtube_url');
            $table->string('source');
            $table->string('image');

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
        Schema::dropIfExists('advices');
    }
     public function addPermissions()
        {

            $permissions = collect([
                'advices.view',
                'advices.create',
                'advices.edit',
                'advices.delete',
                'advices.activate',

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
