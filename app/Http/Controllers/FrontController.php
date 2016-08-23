<?php

namespace pruebarappi\Http\Controllers;

use Illuminate\Http\Request;

use pruebarappi\Http\Requests;

class FrontController extends Controller
{
    
   /**
     * Esta funcion retorna la vista del index, en la
     * cual se encuntra el formulario de ingreso de datos
     * para ejecutar el problema propuesto.
     *
     * @return /index.php
     */
    public function index(){
    	return view('index');
    }


	/**
     * Esta funcion recibe la varibale request con las 
     * variables ingresadas en la vista index, debe
     * recibir el numero de casos de prueba con el nombre tvalue
     * y el texto de las sentencias de todos los casos de prueba.
     * Esta funcion recorrera dichas sentencias y validara en que
     * momento inicia cada caso de prueba para leer corectamente las 
     * varibales correspondientes a al tamanio de las dimensiones
     * de la matriz y el numero de ejecuciones por caso de prueba. 
     * @param  $request
     * @return /cuberesponse.php
     */
    public function execute(Request $request){
     	$tvalue=$request['tvalue'];
     	$sentences = preg_split("/[\n\r]+/",$request['sentences'] );
     	$total=count($sentences);
     	$vecVar=[];
     	$cube=[];
     	$vecSentence=[];
     	$textReturn="";
     	$numIter=0;
     	for ($cadI=0; $cadI <$total && $numIter<$tvalue ; $cadI++) { 
     		$vecVar=preg_split("/[\s]+/",$sentences[$cadI]);
     		$cube= $this->createMatrix($vecVar[0]);
     		for ($caseTestI=0; $caseTestI <=$vecVar[1] ; $caseTestI++) { 
     			$vecSentence=preg_split("/[\s]+/",$sentences[$cadI+$caseTestI]);
     			if($vecSentence[0] == 'UPDATE'){
     				$xDim=$vecSentence[1]-1;
     				$yDim=$vecSentence[2]-1;
     				$zDim=$vecSentence[3]-1;
     				$cube[$xDim][$yDim][$zDim]=$vecSentence[4];
     			}else if ($vecSentence[0]=='QUERY') {
     				$xDim=$vecSentence[1];
     				$yDim=$vecSentence[2];
     				$zDim=$vecSentence[3];
     				$xDimP=$vecSentence[4];
     				$yDimP=$vecSentence[5];
     				$zDimP=$vecSentence[6];

     				$textReturn=$textReturn.$this->sumMatrix($cube,$xDim,$yDim,$zDim,$xDimP,$yDimP,$zDimP)."<br/>";
     			} 

     		}
     		$numIter++;
     		$cadI=$cadI+$caseTestI-1;

     	}
    	return view('cuberesponse',['resp' => $textReturn ]);
    }

    /**
    * Esta funcion crea la matriz de tres dimensiones con un tamanio
    * para cada dimension igual al parametro length ingresado.
    * todas las posiciones son iniciadas en cero (0).
    * @param  $length
    *
    **/
	private function createMatrix($length){
 		$cube=[];
 		for ($x=0; $x <$length ; $x++) { 
 			for ($y=0; $y < $length; $y++) { 
 				for ($z=0; $z <$length ; $z++) { 
 					$cube[$x][$y][$z]=0;
 				}
 			}
 		}
 	return $cube;
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
	private function sumMatrix($cube,$xa,$ya,$za,$xb,$yb,$zb){
 		$sum=0;
 		for ($x=$xa; $x <=$xb ; $x++) { 
 			for ($y=$ya; $y <= $yb; $y++) { 
 				for ($z=$za; $z <=$zb ; $z++) { 
 					$sum+=$cube[$x-1][$y-1][$z-1];
 				}
 			}
 		}
 	return $sum;
 	}

}
