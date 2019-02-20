<?php  

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$app['parametro1'] = "valor1";

// $app['res'] = function(){

// 	return new Response('lul');
// };

$app['res'] = $app->share (function(){ //criação de serviço compartilhado

	return new Response('lul');
});
$res1 = $app['res'];
$res2 = $app['res'];

if ($res1 === $res2) {
	echo "Iguais<br>";
}else{
	echo "Diferentes";
}


// //declaração de serviços
// $app['pdo'] = function() {

// 	return new PDO("dsn", "usuario", "senha");
// }

// $app['pessoa'] = function() use ($app){

// 	$pdo = $app('pdo');
// 	return new Pessoa($pdo);
// };

// //instancia de serviços
// $pessoa = $app['pessoa'];
// $pdo = $app['pdo'];

$app->mount("/enquete", include 'enquete.php');
$app->mount("/forum", include 'forum.php');

$app->run();

?>