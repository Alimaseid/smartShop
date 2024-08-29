<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.

     *

     * @return void
     */
    public function run()
    {
        $permissions = [

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',

            'disposal-list',
            'disposal-create',
            'disposal-edit',
            'disposal-delete',

            'inventoryAdjustment-list',
            'inventoryAdjustment-create',
            'inventoryAdjustment-edit',
            'inventoryAdjustment-delete',

            'issuing-list',
            'issuing-create',
            'issuing-edit',
            'issuing-delete',

            'item-list',
            'item-create',
            'item-edit',
            'item-delete',

            'purchase-list',
            'purchase-create',
            'purchase-edit',
            'purchase-delete',

            'sales-list',
            'sales-create',
            'sales-edit',
            'sales-delete',

            'itemTransfer-list',
            'itemTransfer-create',
            'itemTransfer-edit',
            'itemTransfer-delete',

            'vendor-list',
            'vendor-create',
            'vendor-edit',
            'vendor-delete',

            'location-list',
            'location-create',
            'location-edit',
            'location-delete',

            'report',

            'salesApprove',



        ];

       foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
