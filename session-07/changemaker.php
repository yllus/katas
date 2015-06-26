<?php
// A ChangeMaker can return these terms of payment: 
// 		$20, $10, $5, $2, $1, 
// 		$0.25, $0.10, $0.05, $0.01
// Always return change with as few terms as possible.

class ChangeMaker {
	public $arr_denominations = [ 20, 10, 5, 2, 1, 0.25, 0.10, 0.05 ];

	public function make_change( $amount_cost, $amount_payment ) {
		$arr_denominations_returned = array();

		$bool_amount_returned_is_complete = false;
		$amount_needed_to_return = $amount_payment - $amount_cost;
		$amount_to_return = 0;

		echo "\nOn a $" . $amount_cost . " item paying with $" . $amount_payment . ", total amount needing to be returned: $" . $amount_needed_to_return . "\n";

		while ( $bool_amount_returned_is_complete == false && $amount_to_return != $amount_needed_to_return ) {
			for ( $i = 0; $i < sizeof($this->arr_denominations); $i++ ) {
				//echo "   Is {$this->arr_denominations[$i]} <= {$amount_needed_to_return}?"; 

				if ( $this->arr_denominations[$i] <= $amount_needed_to_return ) {
					$arr_denominations_returned[] = $this->arr_denominations[$i];

					$amount_needed_to_return = $amount_needed_to_return - $this->arr_denominations[$i];
					$amount_to_return = $amount_to_return + $this->arr_denominations[$i];

					//echo " Yes; amount now needing to return is {$amount_needed_to_return}\n";

					$i = -1;
				}

				if ( $amount_needed_to_return == 0 ) {
					$bool_amount_returned_is_complete = true;
				}
			}
		}

		print_r($arr_denominations_returned);
	}
}

$changemaker = new ChangeMaker();

// Return change for a $0 item with a payment of $0.
$changemaker->make_change(0.00, 0.00);

// Return change for a $20 item with a payment of $20.
$changemaker->make_change(20.00, 20.00);

// Return change for a $20 item with a payment of $21.
$changemaker->make_change(20.00, 21.00);

// Return change for a $18 item with a payment of $20.
$changemaker->make_change(18.00, 20.00);

// Return change for a $17.25 item with a payment of $20.
$changemaker->make_change(17.25, 20.00);

// Return change for a $20.00 item with a payment of $200.
$changemaker->make_change(20.00, 200.00);