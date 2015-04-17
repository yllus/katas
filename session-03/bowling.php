<?php
// Using rules described at: http://codingdojo.org/cgi-bin/index.pl?KataBowling

class Line {
	public $frames;
	public $overall_score;

	// Initialize by taking input of an array of frames (each an array of tries), 
	// which creates an array of Frame objects in this Line object.
	public function __construct( $arr_frames ) {
		$this->frames = array();

		// Do the basic addition of the line score, also creating Frame/TryAttempt objects 
		// in the process.
		foreach ( $arr_frames as $arr_frame_item ) {
			$frame = new Frame($arr_frame_item);

			$this->overall_score = $this->overall_score + $frame->score;

			$this->frames[] = $frame;
		}

		// Go back over the entire array of frames to add additional points for spares.
		for ( $i = 0; $i < sizeof($this->frames); $i++ ) {
			if ( isset($this->frames[$i + 1]) ) {
				if ( $this->frames[$i]->is_a_spare === true ) {
					$this->get_score_next_roll($i);			
				}
			}
		}

		// Go back over the entire array of frames to add additional points for strikes.
		for ( $i = 0; $i < sizeof($this->frames); $i++ ) {
			if ( isset($this->frames[$i + 1]) ) {
				if ( $this->frames[$i]->is_a_strike === true ) {
					$this->get_score_next_two_rolls($i);			
				}
			}
		}
	}

	public function get_score_next_roll( $current_frame ) {
		if ( isset($this->frames[$current_frame + 1]) ) {
			$this->overall_score = $this->overall_score + $this->frames[$current_frame + 1]->tries[0]->pins_knocked_down;
		}
	}

	public function get_score_next_two_rolls( $current_frame ) {
		if ( isset($this->frames[$current_frame + 1]) ) {
			$this->overall_score = $this->overall_score + $this->frames[$current_frame + 1]->tries[0]->pins_knocked_down;

			if ( isset($this->frames[$current_frame + 1]->tries[1]) ) {
				$this->overall_score = $this->overall_score + $this->frames[$current_frame + 1]->tries[1]->pins_knocked_down;
			}
			elseif ( isset($this->frames[$current_frame + 2]) ) {
				$this->overall_score = $this->overall_score + $this->frames[$current_frame + 2]->tries[0]->pins_knocked_down;
			}
		}		
	}

	public function display_score() {
		echo "Final score: " . $this->overall_score . "\n\n";
	}
}

class Frame {
	public $tries;
	public $score;
	public $is_a_strike = false;
	public $is_a_spare = false;

	public function __construct( $arr_tries ) {
		$this->tries = array();
		$this->score = 0;

		$try_attempt = 1;
		foreach ( $arr_tries as $arr_tries_item ) {
			$try = new TryAttempt($try_attempt, $arr_tries_item);

			// Add the score of this try to the overall score of the frame.
			$this->score = $this->score + $try->pins_knocked_down;

			// Mark the frame as a strike if it is one.
			if ( $try_attempt == 1 && $this->score == 10 ) {
				$try->is_a_strike = true;
			}

			// Mark the frame as a spare if it is one.
			if ( $try_attempt == 2 && $this->score == 10 ) {
				$try->is_a_spare = true;
			}

			$this->tries[] = $try;

			$try_attempt++;
		}
	}
}

class TryAttempt {
	public $try_attempt = 0;
	public $pins_knocked_down = 0;
	public $is_a_strike = false;

	public function __construct( $try_attempt, $pins_knocked_down ) {
		$this->try_attempt = $try_attempt;
		$this->pins_knocked_down = $pins_knocked_down;

		// Mark the try as a strike if it is one.
		if ( $this->try_attempt == 1 && $this->pins_knocked_down == 10 ) {
			$this->is_a_strike = true;
		}
	}
}

echo "ONES ONLY: \n";
$arr_frames = [ [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1] ];
$line = new Line($arr_frames);
$line->display_score();

echo "RANDOM GAME: \n";
$arr_frames_strikes = [[8, 2], [9, 1], [7, 3], [10], [7, 2], [8, 1], [8, 2], [10], [8, 1], [8, 2, 9]];
$line = new Line($arr_frames_strikes);
$line->display_score();

echo "STRIKES ONLY: \n";
$arr_frames_strikes = [[10], [10], [10], [10], [10], [10], [10], [10], [10], [10], [10], [10, 10, 10]];
$line = new Line($arr_frames_strikes);
$line->display_score();
?>