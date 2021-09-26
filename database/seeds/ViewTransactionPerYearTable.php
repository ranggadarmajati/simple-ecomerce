<?php

use Illuminate\Database\Seeder;

class ViewTransactionPerYearTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared('DROP VIEW IF EXISTS trans_peryear_view');
        DB::unprepared('CREATE VIEW trans_peryear_view AS
      	SELECT 
      	COUNT(transaction_date) AS transactions,
      	(CASE WHEN (MONTH(transaction_date) = 1) THEN "JANUARI" WHEN (MONTH(transaction_date) = 2) THEN "FEBRUARI" WHEN (MONTH(transaction_date) = 3) THEN "MARET" WHEN (MONTH(transaction_date) = 4) THEN "APRIL" WHEN (MONTH(transaction_date) = 5) THEN "MEI" WHEN (MONTH(transaction_date) = 6) THEN "JUNI" WHEN (MONTH(transaction_date) = 7) THEN "JULI" WHEN (MONTH(transaction_date) = 8) THEN "AGUSTUS" WHEN (MONTH(transaction_date) = 9) THEN "SEPTEMBER" WHEN (MONTH(transaction_date) = 10) THEN "OKTOBER" WHEN (MONTH(transaction_date) = 11) THEN "NOVEMBER" WHEN (MONTH(transaction_date) = 12) THEN "DESEMBER"  END) AS month_name, 
      	MONTH(transaction_date) AS month, 
      	YEAR(transaction_date) AS year, 
      	CONCAT(MONTH(transaction_date),"-",YEAR(transaction_date)) AS monthyear 
      	FROM transactions 
      	GROUP BY 
      	(CASE WHEN (MONTH(transaction_date) = 1) THEN "JANUARI" WHEN (MONTH(transaction_date) = 2) THEN "FEBRUARI" WHEN (MONTH(transaction_date) = 3) THEN "MARET" WHEN (MONTH(transaction_date) = 4) THEN "APRIL" WHEN (MONTH(transaction_date) = 5) THEN "MEI" WHEN (MONTH(transaction_date) = 6) THEN "JUNI" WHEN (MONTH(transaction_date) = 7) THEN "JULI" WHEN (MONTH(transaction_date) = 8) THEN "AGUSTUS" WHEN (MONTH(transaction_date) = 9) THEN "SEPTEMBER" WHEN (MONTH(transaction_date) = 10) THEN "OKTOBER" WHEN (MONTH(transaction_date) = 11) THEN "NOVEMBER" WHEN (MONTH(transaction_date) = 12) THEN "DESEMBER"  END),
      	MONTH(transaction_date), 
      	YEAR(transaction_date), 
      	CONCAT(month(transaction_date),"-",YEAR(transaction_date))');
    }
}
