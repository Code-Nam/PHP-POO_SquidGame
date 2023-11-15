<?php 
abstract class Character{
	//? We declare the variables as protected so that they can be accessed by the child classes
	//? They are not meant to be modified outside of the class and its subclasses
	protected $name;
	protected $marbles;

	protected function __construct($name, $marbles){
		$this->name = $name;
		$this->marbles = $marbles;
	}

	//? final functions are used to prevent the child classes from overriding them
	//? since they are essential to the class and its subclasses
	final public function getName(){
		return $this->name;
	}

	final public function getMarbles(){
		return $this->marbles;
	}

  //? abstract method to be implemented by the child classes 
  //? to check wether the character wins or losses
	abstract public function checkWinOrLoss($name);
}

class Protagonist extends Character{
	private $loss;
	private $gain;
	private $battle_cry;
	private $randChoice;
	private $cheat;

  //* Call the parent constructor and then set the other variables
	public function __construct($name, $marbles, $loss, $gain, $battle_cry){
		parent::__construct($name, $marbles);
		$this->loss = $loss;
		$this->gain = $gain;
		$this->battle_cry = $battle_cry;
	}

	//* Getter functions
	public function getLoss(){
		return $this->loss;
	}
	
	public function getGain(){
		return $this->gain;
	}
	
	public function getBattle_cry(){
		return $this->battle_cry;
	}

  //* Setter functions
	public function setMarbles($marbles){
		$this->marbles = $marbles;
	}

	//? random Choice to choose between even (0) or odd (1)
	public static function EvenOrOdd(){
		$randChoice = Utils::randomNumber(0, 1);
		return $randChoice;
	}

	public static function cheat(){
		$cheat = Utils::randomNumber(0, 1);
		return $cheat;
	}

  //? abstract functions implemented from the parent class
  //? to check wether the character wins or losses
	public function checkWinOrLoss($name){
		if ($this->marbles > 0){
			echo $this->name . " won the game. The final enemy was " . $name . ". Congratulations! <br>";
		} else {
			echo $this->name ." has lost all his/her marbles. " . $this->name . " died. <br>";
		}
	}
}


class Enemy extends Character {
	private $age;

	//* Call the parent constructor and then set the other variables
	public function __construct($name, $marbles, $age){
		parent::__construct($name, $marbles);
		$this->age = $age;
	}

	public function getAge(){
		return $this->age;
	}

  //? abstract functions implemented from the parent class
  //? to check wether the character wins or losses
	public function checkWinOrLoss($name){
		if ($this->marbles > 0){
			echo $name . " has been defeated by " . $this->name . " ! <br>";
		} else {
			echo $this->name . " has lost all his/her marbles. " . $name . " is dead. <br>";
		}
	}
}
?>