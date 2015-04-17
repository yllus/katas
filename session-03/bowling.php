<?php
// Using rules described at: http://codingdojo.org/cgi-bin/index.pl?KataBowling

class Line {
	public $frames;
	public $overall_score;

	// Initialize by taking input of an array of frames (each an array of tries), 
	// which creates an array of Frame objects in this Line object.
	public function __construct( $arr_frames ) {
		$this->frames = array();

		foreach ( $arr_frames as $arr_frame_item ) {
			$frame = new Frame($arr_frame_item);

			$this->overall_score = $this->overall_score + $frame->score;

			$this->frames[] = $frame;
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

	public function __construct( $try_attempt, $pins_knocked_down ) {
		$this->try_attempt = $try_attempt;
		$this->pins_knocked_down = $pins_knocked_down;
	}
}

$arr_frames = [ [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1], [1, 1] ];
$line = new Line($arr_frames);
$line->display_score();
?>