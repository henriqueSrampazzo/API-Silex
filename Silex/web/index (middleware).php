<?php  

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$before = function(){ //definição da função before

	echo "Antes do callback";
};

$after = function(Request $request, Response $response)use ($app){ //definição da função before

	echo "Depois do callback";
};

$app->get('/rota/{nome}',function($nome){

	return new Response("A: {$nome}", 200);

}) ->value('nome','Henrique')
->bind('rota_henrique')
->before($before); //chamada da função before
->after($after); //chamada da função after

$app->get('/json',function() use ($app){

	$array= array('nome' => "Henrique");
	$erro = array('message' => "Error");

	return $app-> json($erro,404);
});

// $app->before(function (Request $request){

// 	echo "antes";

// }, Silex\Application::EARLY_EVENT);

//executado antes do response
$app->after(function (Request $request, Response $response){

	echo "after";

});

//executado depois do response
$app->finish(function (Request $request, Response $response){

	echo "finish";

});

 //->assert('id', '\d+');

// convert('id',function($id){ //converte formatos por cast
// 	return (int) $id;
// });



// $data= array(
// 	'curso' => 'SON'
// );

// $app->get('/blog/{id}',function(Silex\Application $app, $id) use ($data){

// 	if(!isset($data['nome']))
// 		$app->abort(404, "Abortado, não encontrou!");
// 	return $id;

// 	});


// $app->get('/hello',function() use ($data){

// 	foreach ($data as $d) {

// 		$res.=$d['nome'].'-'.$d['curso']."<br>";

// 	}

// 	return $res;
// });

$app->run();

?>