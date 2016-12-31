<?php

namespace pruebarappi\Http\Controllers;

use Illuminate\Http\Request;

use pruebarappi\Http\Requests;
use pruebarappi\Classes\Cube;

/**
* Esta clase procesa las peticiones que provienen de la vista recibiendo asi las 
* variables necesarias para la ejecucion del problema propuesto.
* 
*
**/
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
     * @param  $request
     * @return /cuberesponse.php
     */
    public function execute(Request $request){
     	  $tvalue=$request['tvalue'];
     	  $sentences = preg_split("/[\n\r]+/",$request['sentences'] );
          $cubeObject = new Cube();

    	return view('cuberesponse',['resp' => $cubeObject->processData($tvalue,$sentences) ]);
    }

}
