<?php 
//! Import the classes into this main file
require_once("characters.php");
require_once("randomNumber.php");
require_once("variables.php");

class Game{
	private $enemies;
	private $randEnemy;
	private $lastEnemyName;
	private $hero;
	private $randHero;
	private $difficulty;

	private function createCharacters($ProtagonistsArray, $EnemiesArray){
		//? Create array of enemies based on difficulty
		//? Use array_splice to remove number of elements based on difficulty 
		//? 1 = 5 enemies, 2 = 10 enemies, 3 = 20 enemies
		if ($this->difficulty == 1){
			$EnemiesArray = array_splice($EnemiesArray, 0, 5);
		} else if ($this->difficulty == 2){
			$EnemiesArray = array_splice($EnemiesArray, 0, 10);
		}

		//* Create the array of enemies
		foreach ($EnemiesArray as $enemy){
			$this->enemies[] = new Enemy($enemy, Utils::randomNumber(1, 20), Utils::randomNumber(20, 90));
		}
		//* Create the hero
		$this->hero = new Protagonist(
			$ProtagonistsArray[$this->randHero]['name'],
			$ProtagonistsArray[$this->randHero]['marbles'],
			$ProtagonistsArray[$this->randHero]['loss'],
			$ProtagonistsArray[$this->randHero]['gain'],
			$ProtagonistsArray[$this->randHero]['battle cry']
		);
	}

	private function fight($Hero, $currentEnemy){
		//* Choose a random enemy
		//! Hero has a random guess between 0 and 1 
		//! and if the remainder (using modulo by 2) of the enemy's nb of marbles is equal to the hero's guess
		//! then the hero wins and the enemy loses
		if ($Hero->EvenOrOdd() == $currentEnemy->getMarbles() % 2){
			$Hero->setMarbles($Hero->getMarbles() + $currentEnemy->getMarbles() + $Hero->getGain());
			echo $Hero->getName() . " won against " . $currentEnemy->getName() . " ! <br>";
			echo $Hero->getName() . " has " . $Hero->getMarbles() . " marbles left. <br>";
			//! Remove the enemy from the array of enemies
			array_splice($this->enemies, $this->randEnemy, 1);
			echo count($this->enemies) . " remaining enemies. <br>";
		} else {
			$Hero->setMarbles($Hero->getMarbles() - $currentEnemy->getMarbles() - $Hero->getLoss());
			echo $Hero->getName() . " lost against " . $currentEnemy->getName() . " ! <br>";
			echo $Hero->getName() . " has " . $Hero->getMarbles() . " marbles left. <br>";
			echo count($this->enemies) . " remaining enemies. <br>";
		}
		$this->lastEnemyName = $currentEnemy->getName();
		$currentEnemy->checkWinOrLoss($Hero->getName());
	}

	//? Fetch the array of enemies and protagonists
	//? to create the random hero and the random enemies
	public function __construct($ProtagonistsArray,$EnemiesArray){
		//* choose a random number between 0 and the length of the ProtagonistsArray
		$this->randHero = Utils::randomNumber(0, count($ProtagonistsArray) - 1);	
		
		//* choose a random difficulty
		$this->difficulty = Utils::randomNumber(1, 3);

		//* Create all the characters
		$this->createCharacters($ProtagonistsArray, $EnemiesArray);

		//! Start game
		while ($this->hero->getMarbles() > 0 && count($this->enemies) > 0){
				$this->randEnemy = Utils::randomNumber(0, count($this->enemies) - 1);
				$currentEnemy = $this->enemies[$this->randEnemy];
				$Hero = $this->hero;
				
				//* Fight this enemy, first check if the enemy is old
				//* If the enemy is old and wants to cheat ($Hero->cheat() == 0), 
				//* the hero wins automatically. Else fight normally
				if ($Hero->cheat() == 0 && $currentEnemy->getAge() > 70){
					$Hero->setMarbles($Hero->getMarbles() + $currentEnemy->getMarbles());
					echo $Hero->getName() . " cheated and won against " . $currentEnemy->getName() . " who was " . $currentEnemy->getAge() . " ! <br>";
					echo $Hero->getName() . " has " . $Hero->getMarbles() . " marbles left. <br>";
					//! Remove the enemy from the array of enemies
					array_splice($this->enemies, $this->randEnemy, 1);
					echo count($this->enemies) . " remaining enemies. <br>";
				} else{
					$this->fight($Hero, $currentEnemy);
				}
			}
		$this->hero->checkWinOrLoss($this->lastEnemyName);
	}
}



$game = new Game($ProtagonistsArray, $EnemiesArray);
?>