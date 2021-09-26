<?php
if(!function_exists('generateNoOrder')){
	/**
	 * This function for generate No Order
	 * @author rangga darmajati
	 * @return no order
	 */
	function generateNoOrder()
	{
		$str_random = str_random(10);
        $date_for_convert = date("Y-m-d");
        $split_date = explode("-", $date_for_convert);
        $date_convert = MonthToAlfhabet($split_date[1]);
        $year = substr($date_for_convert, 2, -6);
        $order_no = $year.$date_convert.$split_date[2].$str_random;

        return $order_no;
	}
}

if(!function_exists('MonthToAlfhabet')){

    function MonthToAlfhabet($value)
    {
        if( $value == '01' ){
            $result = 'A';
        }elseif( $value == '02' ){
            $result = 'B';
        }elseif( $value == '03' ){
            $result = 'C';
        }elseif( $value == '04' ){
            $result = 'D';            
        }elseif( $value == '05' ){
            $result = 'E';            
        }elseif( $value == '06' ){
            $result = 'F';            
        }elseif( $value == '07' ){
            $result = 'G';            
        }elseif( $value == '08' ){
            $result = 'H';            
        }elseif( $value == '09' ){
            $result = 'I';            
        }elseif( $value == '10' ){
            $result = 'J';            
        }elseif( $value == '11' ){
            $result = 'K';            
        }else{
            $result = 'L';
        }

        return $result;
    }
}