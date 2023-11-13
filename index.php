<?php

$ProtagonistArray = array(
    [
			'name' => "Seong Gi-hun",
			'marbles' => 15,
			'loss' => 2,
			'gain' => 1,
			'battle cry' => "Can't you hear me? This isn't right! We shouldn't be killing each other like this!"
    ],
    [
			'name' => "Kang Sae-byeok",
			'marbles' => 25,
			'loss' => 1,
			'gain' => 2,
			'battle cry' => "I don't trust people."
		],
		[
			'name' => "Cho Sang-woo",
			'marbles' => 35,
			'loss' => 0,
			'gain' => 3,
			'battle cry' => "When we were kids, we would play just like this, and our moms would call us in for dinner. But no one calls us anymore."
		]
);

interface Character{
	public function getName();
	public function getMarbles();
}

class Protagonist implements Character{
	private $name;
	private $marbles; 
	private $loss;
	private $gain;
	private $battle_cry;

	public function __construct($name, $marbles, $loss, $gain, $battle_cry){
		$this->name = $name;
		$this->marbles = $marbles;
		$this->loss = $loss;
		$this->gain = $gain;
		$this->battle_cry = $battle_cry;
	}

	//* Getter functions
	public function getName(){
		return $this->name;
	}

	public function getMarbles(){
		return $this->marbles;
	}

	public function getBattle_cry(){
		return $this->battle_cry;
	}

	public function getLoss(){
		return $this->loss;
	}

	public function getGain(){
		return $this->gain;
	}
}

?>