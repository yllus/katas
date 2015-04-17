<?php
// Using rules described at: http://codingdojo.org/cgi-bin/index.pl?KataBowling
$arr_frames = [[5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5], [5, 5, 5]];

$arr_frames_nines = [[9, 0], [9, 0], [9, 0], [9, 0], [9, 0], [9, 0], [9, 0], [9, 0], [9, 0], [9, 0, 0]];

$arr_frames_strikes = [[10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0], [10, 0]];

function calculate_score( $arr_frames ) {
	$total_score = 0;
	$num_rolls_to_add = 0;

	for ( $i = 0; $i < sizeof($arr_frames); $i++ ) {
		$frame = $arr_frames[$i];
		$score_this_frame = 0;
		$bool_strike_this_frame = false;

		for ( $j = 0; $j < sizeof($frame); $j++ ) {
			$score_this_frame = $score_this_frame + $frame[$j];

			if ( $j == 0 && $score_this_frame == 10 ) {
				$bool_strike_this_frame = true;
				$num_rolls_to_add = 2;
			}
		}

		if ( $score_this_frame == 10 && $bool_strike_this_frame != true ) {
			$num_rolls_to_add = 1;
		}

		$total_score = $total_score + $score_this_frame;
		echo "   Basic score after frame $i: $total_score\n"; 

		if ( $num_rolls_to_add > 0 && isset($arr_frames[$i - 1]) ) {
			$additional_points_added = $arr_frames[$i][0];
			$total_score = $total_score + $additional_points_added;
			if ( $num_rolls_to_add == 2 ) {
				$additional_points_added = $arr_frames[$i][1];		
				$total_score = $total_score + $additional_points_added;
			}
			echo "   A spare or strike occurred last frame, so adding an additional $additional_points_added points\n"; 
		}

		echo "Total Score after frame $i: $total_score\n"; 
	}

	echo "\nFinal Score: " . $total_score . "\n\n";
}

echo calculate_score($arr_frames);
echo calculate_score($arr_frames_nines);
echo calculate_score($arr_frames_strikes);

