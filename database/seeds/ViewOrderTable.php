<?php

use Illuminate\Database\Seeder;

class ViewOrderTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('DROP VIEW IF EXISTS order_confirm_view');
        DB::unprepared('CREATE VIEW order_confirm_view AS
      	SELECT 
      	t.id as transaction_id, 
      	t.order_no, u.id as user_id, 
      	concat(u.first_name, " ",u.last_name) AS customer, 
      	u.email, 
      	t.order_total,
        t.transaction_date,
        t.expired_transaction_date AS exp_transaction, 
      	oc.total_to_be_paid, 
      	oc.rek_number, 
      	oc.rek_name, 
      	oc.proof_of_payment,
      	oc.transfer_date,
        oc.admin_confirm,
        c.tracking_number,
        c.courier,
        c.package,
        t.created_at,
        (CASE WHEN (oc.proof_of_payment != "" AND oc.transfer_date != "") THEN 1 else 0 END) as customer_confirm,
        (CASE WHEN c.tracking_number IS NULL THEN "belum dikirim" else "sudah dikirim" END) as status_send,
        (CASE WHEN c.tracking_number IS NULL THEN 0 else 1 END) as status_send_flag
      	FROM transactions t
		LEFT JOIN users u ON u.id = t.user_id
		LEFT JOIN order_confirms oc ON oc.transaction_id = t.id
    LEFT JOIN couriers c ON c.transaction_id = t.id');
    }
}
