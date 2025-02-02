<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd;
use App\Models\ORM\cdApi;


include_once __DIR__ . '/../../src/app/modelORM/cd.php';
include_once __DIR__ . '/../../src/app/modelORM/cdControler.php';

return function (App $app) {
    $container = $app->getContainer();

     $app->group('/cdORM', function () {   
         
        $this->get('/', function ($request, $response, $args) {
          //return cd::all()->toJson();
          $todosLosCds=cd::all();
          //$todosLosCds= new cd;
          //$todosLosCds->titel = "Nuevo titulo";
          //$todosLosCds->save();
          $newResponse = $response->withJson($todosLosCds, 200);  
          return $newResponse;
        });
        $this->post('/', function ($request, $response, $args) {
          $arry_params = $request->getParsedBody();
          $cd= new cd;
          $cd->titel = $arry_params['titel'];
          $cd->interpret = $arry_params['interpret'];
          $cd->jahr = $arry_params['jahr'];
          $cd->save();
          $newResponse = $response->withJson($cd, 200);  
          return $newResponse;
        });
    });


     $app->group('/cdORM2', function () {   

        $this->get('/',cdApi::class . ':traerTodos');
   
    });

};