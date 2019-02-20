<?php 

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$enquete = $app['controllers_factory'];

$enquete->get("/", function(){

	return new Response("Acesso a enquete");
});

$enquete->get("/show", function(){

	return new Response("Exibir uma enquete");
});

return $enquete;

 ?>