<?php

use Illuminate\Database\Seeder;

class ViewOrderDetailTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('DROP VIEW IF EXISTS order_detail_view');
        DB::unprepared('CREATE VIEW order_detail_view AS
      	SELECT
      	t.id,
		t.order_no,
		t.user_id,
		concat(u.first_name," ",u.last_name) as username,
		td.product_id,
		p.name,
		td.qty,
		td.price,
		td.size,
		td.color,
		td.total,
		t.created_at
		FROM transactions t
		JOIN transaction_details td ON td.transaction_id = t.id
		JOIN products p on p.id = td.product_id
		JOIN users u ON u.id = t.user_id');
    }
}
