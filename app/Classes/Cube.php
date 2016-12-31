<?php
 
namespace pruebarappi\Classes;

/**
* Esta clase realiza todas las operaciones sobre la matriz de tres dimensiones.
*
*
**/ 
class Cube {

	protected $matrix =array();

	

 	/**
    * Esta funcion crea la matriz de tres dimensiones con un tamanio
    * para cada dimension igual al parametro length ingresado.
    * todas las posiciones son iniciadas en cero (0).
    * @param  $length
    *
    **/
	private function createMatrix($length){
		$this->matrix = array_fill(0, $length, array_fill(0, $length, array_fill(0, $length,0)));
 	}

 	/**
    * Esta funcion crea la matriz de tres dimensiones con un tamanio
    * para cada dimension igual al parametro length ingresado.
    * todas las posiciones son iniciadas en cero (0).
    * @param  $length
    *
    **/
	private function evalSentence($sentence){
 		$vecSentence=preg_split("/[\s]+/",$sentence);
 		$resp=-1;
     		if($vecSentence[0] == 'UPDATE'){
     			$xDim=$vecSentence[1]-1;
     			$yDim=$vecSentence[2]-1;
     			$zDim=$vecSentence[3]-1;
     			$this->matrix[$xDim][$yDim][$zDim]=$vecSentence[4];   		
     		}else if ($vecSentence[0]=='QUERY') {
     			$xDim=$vecSentence[1];
     			$yDim=$vecSentence[2];
     			$zDim=$vecSentence[3];
     			$xDimP=$vecSentence[4];
     			$yDimP=$vecSentence[5];
     			$zDimP=$vecSentence[6];
     			$resp= $this->sumMatrix($xDim,$yDim,$zDim,$xDimP,$yDimP,$zDimP);
     		}
     		return $resp;
 	}


    /**
     * Esta funcion valida el numero casos de prueba ingresadoes en el parametro 
     * tvalue y  recorre las sentencias ingresadas por en el parametro $sentences
     * validando en que  momento inicia cada caso de prueba para 
     * leer corectamente las  varibales correspondientes a al tamanio
     * de las dimensiones de la matriz y el numero de ejecuciones por caso de prueba. 
     * 
     * @param $tvalue 
     * @param $sentences 
     **/    
    public function processData($tvalue,$sentences){
          $total=count($sentences);
          $vecVar=[];
          $textReturn="";
          $numIter=0;
          $cubeObject = new Cube();
          $tempVar=-1;
          for ($cadI=0; $cadI <$total && $numIter<$tvalue ; $cadI++) { 
            $vecVar=preg_split("/[\s]+/",$sentences[$cadI]);
            $this->createMatrix($vecVar[0]);
            for ($caseTestI=0; $caseTestI <=$vecVar[1] ; $caseTestI++) { 
                 $tempVar=$this->evalSentence($sentences[$cadI+$caseTestI]);
                if($tempVar!=-1){
                     $textReturn= $textReturn.$tempVar."<br/>";
                 } 
            } 
            $numIter++;
            $cadI=$cadI+$caseTestI-1;
    
          }
          return $textReturn;  
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
 	* @param  $xa
 	* @param  $ya
 	* @param  $za
 	* @param  $xb
 	* @param  $yb
 	* @param  $zb
 	**/ 	
	private function sumMatrix($xa,$ya,$za,$xb,$yb,$zb){
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