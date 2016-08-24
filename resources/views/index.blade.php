@extends('layouts.principal')

@section('title', 'Ingreso de datos')

@section('content')
	{!!Form::open(array('action' => 'CubeController@execute','method' => 'post'))!!}
		<div class="form-group">
			{!!Form::label('Valor de T:')!!}
			{!!Form::text('tvalue',null,['class'=>'form-control','placeholder'=>'El valor de T es el número de casos de prueba que se realizarán'])!!}
		</div>	
		<div class="form-group">
			{!!Form::label('Sentencias:')!!}
			{!!Form::textarea ('sentences',null,['class'=>'form-control','placeholder'=>'Por favor ingrese las sentencias de los casos de prueba, cada sentencia debe ser separada por un salto de linea.
Recuerde que cada caso de prueba inicia con los valores de N y M separados por un espacio, donde N es número que especifica el tamaño de la matriz y M es el numero de sentencias que debe tener cada caso de prueba.'])!!}
		</div>	
		{!!Form::submit('Ejecutar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
@endsection
