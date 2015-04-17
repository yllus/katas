<?php
// Using rules described at: http://codingdojo.org/cgi-bin/index.pl?KataBowling

$arr_line_zero = [ [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0], [0, 0] ];

$arr_line_ones = [ [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1] ];

function score_game( $arr_line ) {
	$total_score_overall = 0;
	$num_tries_to_add_to_score = 0;

	// Iterate through each frame that has been bowled.
	$i = 0;
	foreach ( $arr_line as $frame ) {
		$total_score_in_frame = 0;
		$bool_got_a_spare = false;
		$bool_got_a_strike = false;

		// Add the number of pins bowled up into $total_score_in_frame.
		for ( $j = 0; $j < sizeof($arr_frame); $j++ ) {
			$try = $arr_frame[$j]; // Just for simplicity of naming.

			$total_score_in_frame = $total_score_in_frame + $try;

			// If we're on the first try in the frame and we get a strike, record as much.
			if ( $j == 0 && $total_score_in_frame == 10 ) {
				$bool_got_a_strike = true;
			}
			// If we're on the second try and all pins have been knocked down, record a spare.
			elseif ( $j == 1 && $total_score_in_frame == 10 ) {
				$bool_got_a_spare = true;
			}
		}

		// If we have a next try coming up and we bowled a spare, mark that we need to add 
		// the next try to our score.
		if ( $bool_got_a_spare == true && sizeof($arr_line) > $i ) {
			$num_tries_to_add_to_score = 1;
		}

		// If we have a next try coming up and we bowled a strike, mark that we need to add 
		// the next two tries to our score.
		if ( $bool_got_a_strike == true && sizeof($arr_line) > $i ) {
			$num_tries_to_add_to_score = 2;
		}

		// Add to our overall score.
		$total_score_overall = $total_score_overall + $total_score_in_frame;

		$i++;
	}

	echo $total_score_overall;
}

echo score_game($arr_line_ones);

?>