<?php

namespace pruebarappi\Http\Controllers;

use Illuminate\Http\Request;

use pruebarappi\Http\Requests;
use pruebarappi\Classes\Cube;

class CubeController extends Controller
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
     	$textReturn="";
     	$numIter=0;
        $cubeObject = new Cube();
        $tempVar=-1;
     	for ($cadI=0; $cadI <$total && $numIter<$tvalue ; $cadI++) { 
     		$vecVar=preg_split("/[\s]+/",$sentences[$cadI]);
     		$cubeObject->createMatrix($vecVar[0]);
     		for ($caseTestI=0; $caseTestI <=$vecVar[1] ; $caseTestI++) { 
                $tempVar=$cubeObject->evalSentence($sentences[$cadI+$caseTestI]);
               if($tempVar!=-1){
                    $textReturn= $textReturn.$tempVar."<br/>";
                } 
     		} 
     		$numIter++;
     		$cadI=$cadI+$caseTestI-1;

     	}
    	return view('cuberesponse',['resp' => $textReturn ]);
    }

}
