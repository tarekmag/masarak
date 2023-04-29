<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use ATPGroup\Roles\Models\Permission;
use ATPGroup\Roles\Models\RoleAction;
use Illuminate\Support\Facades\Route;
use ATPGroup\Roles\Models\PermissionAction;

class CreatePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        PermissionAction::truncate();
        RoleAction::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        collect(Route::getRoutes())->map(function ($route) {
            $routeName = $route->getName();
            if ($routeName) {
                $explode = explode('.', $routeName);
                //Skip this routes
                if (!in_array($explode[0], [
                    'ignition',
                    'login',
                    'logout',
                    'register',
                    'password',
                    'home',
                    'lockedscreen',
                    'notification',
                    'passport',
                    'dashboard',
                    'debugbar',
                    'livewire',
                    'telescope',
                ]) && !in_array($routeName, [
                    'language.edit',
                    'language.update',
                    'language.destroy',
                    'branch.getBranches',
                    'driver.getDrivers',
                    'station.getAutocomplete',
                    'route.getSchedules',
                    'brandModel.getBrandModels',
                    'driverVehicle.getVehicles',
                ])) {
                    $permission = Permission::firstOrCreate(['name' => strtoupper($explode[0])]);
                    PermissionAction::firstOrCreate(
                        [
                            'permission_id' => $permission->id,
                            'name' => (isset($explode[1])) ? $this->renamePermissionAction($explode[1]): 'null',
                            'method' => $routeName,
                        ]);
                }
            }
        });
    }

    private function renamePermissionAction($name)
    {
        switch ($name) {
            case 'index':
                return strtoupper('display page');
                break;

            case 'create':
                return strtoupper('create page');
                break;

            case 'edit':
                return strtoupper('edit page');
                break;

            case 'store':
                return strtoupper('submit create page');
                break;

            case 'update':
                return strtoupper('submit edit page');
                break;

            default:
                return strtoupper($name);
                break;
        }
    }
}
