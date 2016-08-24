<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CubeTest extends TestCase
{
    /**
     * Caso de prueba de funcionamiento basico, envia la prueba basica con los siguientes valores
     * 2
     * 4 5
     * UPDATE 2 2 2 4
     * QUERY 1 1 1 3 3 3
     * UPDATE 1 1 1 23
     * QUERY 2 2 2 4 4 4
     * QUERY 1 1 1 3 3 3
     * 2 4
     * UPDATE 2 2 2 1
     * QUERY 1 1 1 1 1 1
     * QUERY 1 1 1 2 2 2
     * QUERY 2 2 2 2 2 2
     *
     * @return void
     */
    public function testBasicInput()
    {
       $response = $this->action('POST', 'CubeController@execute', [
        'tvalue' => 2, 
        'sentences'=>"4 5\nUPDATE 2 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2"]); //Envia la invocacion al metodo del controlador
       $this->assertResponseOk(); // Verifica que se obtenga respuesta
       $this->assertViewHas('resp'); // verifica que la variable resp este en la respuesta
       $resp = $response->original['resp']; 
       $this->assertEquals('4<br/>4<br/>27<br/>0<br/>1<br/>1<br/>', $resp); // Verifica que la respuesta sea la respuesta esperada;
    }


    /**
     * Caso de prueba de funcionamiento medio, envia la prueba de dificultad media con los siguientes valores
     * 1
     * 69 47
     * QUERY 1 1 1 69 69 69
     * UPDATE 10 30 51 191983903
     * UPDATE 6 20 60 88229553
     * UPDATE 62 26 31 450800985
     * UPDATE 34 25 40 861430285
     * QUERY 1 1 1 69 69 69
     * UPDATE 64 1 50 101597558
     * UPDATE 50 43 61 536850651
     * QUERY 1 1 1 69 69 69
     * QUERY 41 11 27 47 43 44
     * QUERY 1 1 1 69 69 69
     * UPDATE 35 25 20 264866132
     * QUERY 1 1 1 69 69 69
     * UPDATE 10 22 45 921476620
     * QUERY 1 1 1 69 69 69
     * QUERY 1 1 1 69 69 69
     * UPDATE 49 11 63 41231916
     * UPDATE 8 45 40 843316483
     * UPDATE 57 20 45 958626566
     * QUERY 1 1 1 69 69 69
     * UPDATE 15 19 26 85462858
     * UPDATE 16 13 69 365453884
     * QUERY 1 1 1 69 69 69
     * UPDATE 67 24 56 892212962
     * UPDATE 35 58 13 773605076
     * QUERY 1 1 1 69 69 69
     * UPDATE 52 46 52 593625062
     * UPDATE 41 60 5 730934012
     * QUERY 1 1 1 69 69 69
     * UPDATE 44 41 39 868023347
     * QUERY 1 1 1 69 69 69
     * UPDATE 55 2 35 462443091
     * QUERY 1 1 1 69 69 69
     * UPDATE 11 64 2 748705256
     * UPDATE 16 4 65 879243470
     * UPDATE 66 39 3 11674003
     * UPDATE 13 21 33 326825143
     * QUERY 1 1 1 69 69 69
     * QUERY 1 1 1 69 69 69
     * UPDATE 46 23 55 144359375
     * QUERY 1 1 1 69 69 69
     * UPDATE 69 20 63 520836979
     * UPDATE 46 13 12 838459065
     * UPDATE 19 60 58 333739671
     * QUERY 1 1 1 69 69 69
     * UPDATE 62 46 41 29469202
     * QUERY 1 1 1 69 69 69
     *
     * @return void
     */
    public function testMediunInput()
    {
       $response = $this->action('POST', 'CubeController@execute', [
        'tvalue' => 1, 
        'sentences'=>"69 47\nQUERY 1 1 1 69 69 69\nUPDATE 10 30 51 191983903\nUPDATE 6 20 60 88229553\nUPDATE 62 26 31 450800985\nUPDATE 34 25 40 861430285\nQUERY 1 1 1 69 69 69\nUPDATE 64 1 50 101597558\nUPDATE 50 43 61 536850651\nQUERY 1 1 1 69 69 69\nQUERY 41 11 27 47 43 44\nQUERY 1 1 1 69 69 69\nUPDATE 35 25 20 264866132\nQUERY 1 1 1 69 69 69\nUPDATE 10 22 45 921476620\nQUERY 1 1 1 69 69 69\nQUERY 1 1 1 69 69 69\nUPDATE 49 11 63 41231916\nUPDATE 8 45 40 843316483\nUPDATE 57 20 45 958626566\nQUERY 1 1 1 69 69 69\nUPDATE 15 19 26 85462858\nUPDATE 16 13 69 365453884\nQUERY 1 1 1 69 69 69\nUPDATE 67 24 56 892212962\nUPDATE 35 58 13 773605076\nQUERY 1 1 1 69 69 69\nUPDATE 52 46 52 593625062\nUPDATE 41 60 5 730934012\nQUERY 1 1 1 69 69 69\nUPDATE 44 41 39 868023347\nQUERY 1 1 1 69 69 69\nUPDATE 55 2 35 462443091\nQUERY 1 1 1 69 69 69\nUPDATE 11 64 2 748705256\nUPDATE 16 4 65 879243470\nUPDATE 66 39 3 11674003\nUPDATE 13 21 33 326825143\nQUERY 1 1 1 69 69 69\nQUERY 1 1 1 69 69 69\nUPDATE 46 23 55 144359375\nQUERY 1 1 1 69 69 69\nUPDATE 69 20 63 520836979\nUPDATE 46 13 12 838459065\nUPDATE 19 60 58 333739671\nQUERY 1 1 1 69 69 69\nUPDATE 62 46 41 29469202\nQUERY 1 1 1 69 69 69"]); //Envia la invocacion al metodo del controlador
       $this->assertResponseOk(); // Verifica que se optenga respuesta
       $this->assertViewHas('resp'); // verifica que la variable resp este en la respuesta
       $resp = $response->original['resp']; 
       $this->assertEquals('0<br/>1592444726<br/>2230892935<br/>0<br/>2230892935<br/>2495759067<br/>3417235687<br/>3417235687<br/>5260410652<br/>5711327394<br/>7377145432<br/>8701704506<br/>9569727853<br/>10032170944<br/>11998618816<br/>11998618816<br/>12142978191<br/>13836013906<br/>13865483108<br/>', $resp); // Verifica que la respuesta sea la respuesta esperada;
    }
}
