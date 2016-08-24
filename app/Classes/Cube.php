<?php
 
namespace pruebarappi\Classes;
 
class Cube {

	protected $matrix =array();

	

 	/**
    * Esta funcion crea la matriz de tres dimensiones con un tamanio
    * para cada dimension igual al parametro length ingresado.
    * todas las posiciones son iniciadas en cero (0).
    * @param  $length
    *
    **/
	public function createMatrix($length){
 		$this->matrix= array();
 		for ($x=0; $x <$length ; $x++) { 
 			for ($y=0; $y < $length; $y++) { 
 				for ($z=0; $z <$length ; $z++) { 
 					$this->matrix[$x][$y][$z]=0;
 				}
 			}
 		}
 	}

 	/**
    * Esta funcion crea la matriz de tres dimensiones con un tamanio
    * para cada dimension igual al parametro length ingresado.
    * todas las posiciones son iniciadas en cero (0).
    * @param  $length
    *
    **/
	public function evalSentence($sentence){
 		$vecSentence=preg_split("/[\s]+/",$sentence);
     		if($vecSentence[0] == 'UPDATE'){
     			$xDim=$vecSentence[1]-1;
     			$yDim=$vecSentence[2]-1;
     			$zDim=$vecSentence[3]-1;
     			$this->matrix[$xDim][$yDim][$zDim]=$vecSentence[4];   		
     			return -1;	
     		}else if ($vecSentence[0]=='QUERY') {
     			$xDim=$vecSentence[1];
     			$yDim=$vecSentence[2];
     			$zDim=$vecSentence[3];
     			$xDimP=$vecSentence[4];
     			$yDimP=$vecSentence[5];
     			$zDimP=$vecSentence[6];
     			return $this->sumMatrix($xDim,$yDim,$zDim,$xDimP,$yDimP,$zDimP);
     		}
     		return -1;
 	}


	/**
 	* Esta funcion realiza la suma de los valores que se 
 	* de todas las posiciones que se encuentran entre dos
 	* cordenadas de la matriz.
 	* Los parametros xa,ya,za corresponden a la primera 
 	* cooredena a tener en cuenta. 
 	* Los parametros xb,yb,zb corresponden a la segunda 
 	* coordenada.
 	*
 	* @param  $cube
 	* @param  $xa
 	* @param  $ya
 	* @param  $za
 	* @param  $xb
 	* @param  $yb
 	* @param  $zb
 	**/ 	
	public function sumMatrix($xa,$ya,$za,$xb,$yb,$zb){
 		$sum=0;
 		for ($x=$xa; $x <=$xb ; $x++) { 
 			for ($y=$ya; $y <= $yb; $y++) { 
 				for ($z=$za; $z <=$zb ; $z++) { 
 					$sum+= $this->matrix[$x-1][$y-1][$z-1];
 				}
 			}
 		}
 	return $sum;
 	}

}