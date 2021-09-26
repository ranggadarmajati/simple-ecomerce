<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ViewOrderTable::class);
        $this->call(ViewOrderDetailTable::class);
        $this->call(ViewTransactionPerYearTable::class);
    }
}
