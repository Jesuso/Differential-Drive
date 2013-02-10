<?php

/**
 * Differential Drive Robot class
 *
 * @author Jesuso
 */
class DDR {
	/**
	 * The radius of the wheels
	 * @var number
	 */
	var $R;
	var $L;
	var $N;
	var $Dr;
	var $Dl;
	var $phi;
	
	/**
	 * Initiates a new Differential Drive Robot Class Object, which will keep track of the
	 * robot position and has functions to move, turn, etc.
	 * 
	 * @param number $R The radius of the wheel
	 * @param number $L The length between booth wheels
	 * @param number $N The number of ticks necesary for a complete wheel spin
	 */
	function __construct($R, $L, $N) {
		$this->R = $R;
		$this->L = $L;
		$this->N = $N;
	}
	
	/**
	 * Makes the robot's left and right wheel rotate.
	 * Takes the number of ticks for each wheel and returns the distance each wheel moved.
	 * 
	 * @param number $Tr Number of ticks the right wheel will move
	 * @param number $Tl Number of ticks the left wheel will move
	 * @return array The distance each wheel moved
	 */
	function move($Tr, $Tl){
		$Dr = 2 * pi() * $this->R * ($Tr/$this->N);
		$Dl = 2 * pi() * $this->R * ($Tl/$this->N);
		
		return array("Dr"=>$Dr,"Dl"=>$Dl);
	}
	
	function position($Dr, $Dl){
		if(is_array($Dr)){
			$Dtemp = $Dr;
			$Dr = $Dtemp['Dr'];
			$Dl = $Dtemp['Dl'];
		}
		
		$Dc = ($Dr + $Dl) / 2;
		
		#$phi = 0 + (Dr - Dl) / L
		$phi = ($this->R / $this->L) * ($Dr - $Dl);
		#x = 0 + Dc*cos(phi)
		$x = ($this->R/2) * ($Dr + $Dl) * cos($phi);
		#y = 0 + Dc*sin(phi)
		$y = ($this->R/2) * ($Dr + $Dl) * sin($phi);

		return(array("x"=>$x, "y"=>$y, "phi"=>$phi));
	}
}

?>
