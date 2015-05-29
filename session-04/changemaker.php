<?php
// A ChangeMaker can return these terms of payment: 
// 		$100, $50, $20, $10, $5, $2, $1, 
// 		$0.25, $0.10, $0.05, $0.01
// Always return change with as few terms as possible.

class ChangeMaker {
	public $arr_denominations = [ 100, 50, 20, 10, 5, 2, 1, 0.25, 0.10, 0.05, 0.01 ];

	public function give_change( $amount_requested ) {
		return 0;
	}
}

$arr_amounts_requested = [ 100 ];
foreach ( $arr_amounts_requested as $amount_requested ) {
	$changemaker = new ChangeMaker();

	echo $changemaker->give_change($amount_requested) . "\n";
}
?>