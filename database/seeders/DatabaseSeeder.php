<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CrmStatusTableSeeder::class,
            CrmCustomersSeeder::class,
            // StoreSeeder::class,
            // ProviderSeeder::class,
            // ProductCategorySeeder::class,
            // ProductSeeder::class,
            // ProductsTagSeeder::class,
            // ProductSpecsSeeder::class,
            // ItemsSeeder::class,
            // SurveyUbicationsSeeder::class,
            // SurveySeeder::class,
            // SurveyAnswerTypeSeeder::class,
            // SurveyDetailSeeder::class,
            // SurveyResponderSeeder::class,
            // SurveyResponseSeeder::class,
            TransactionTypesSeeder::class,
        ]);
    }
}
