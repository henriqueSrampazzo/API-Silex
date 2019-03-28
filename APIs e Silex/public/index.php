<?php

require_once __DIR__ . '/../bootstrap.php'; // requisição do arquivo de inicialização

use Code\Sistema\Service\ClienteService;
use Code\Sistema\Service\InteresseService;
use Symfony\Component\HttpFoundation\Request;

$app["clienteService"] = function () use ($em) {
	//criando container de serviço que instancia o serviço pronto para o uso

	$clienteService = new ClienteService($em); // intanciando o objeto do clienteService e passado as classes por método construtor evitando o acoplamento

	return $clienteService; //retorno da função que será utilizado
};

$app["interesseService"] = function () use ($em) {

	$interesseService = new InteresseService($em);
	return $interesseService;
};

$app->get("/api/clientes", function () use ($app) {
	//get que lista todos os clientes

	$dados = $app["clienteService"]->fetchAll(); //chama o método fetchAll

	return $app->json($dados); //retorna em json

});

$app->get("/api/clientes/{id}", function ($id) use ($app) {
	//get que lista o cliente pelo ID

	$dados = $app["clienteService"]->find($id); //chama o método find

	return $app->json($dados); //retorna em json

});

$app->post("/api/clientes", function (Request $request) use ($app) {
	//post que insere novo cliente

	$dados["nome"] = $request->get("nome");
	$dados["email"] = $request->get("email");
	$dados["rg"] = $request->get("rg");
	$dados["cpf"] = $request->get("cpf");
	$dados["interesse"] = $request->get("interesse");

	$result = $app["clienteService"]->insert($dados); //chama o método insert situado na classe de serviço(regra de negocio)

	$data["id"] = $result->getId();
	$data["nome"] = $result->getNome();
	$data["email"] = $result->getEmail();

	$data["rg"] = $result->getProfile()->getRg();
	$data["cpf"] = $result->getProfile()->getCpf();

	return $app->json($data); //retorna json serializado

});

$app->post("/api/interesses", function (Request $request) use ($app) {
	//post que insere novo interesse

	$dados["nome"] = $request->get("nome");

	$result = $app["interesseService"]->insert($dados); //chama o método insert situado na classe de serviço(regra de negocio)

	$data["id"] = $result->getId();
	$data["nome"] = $result->getNome();

	return $app->json($data); //retorna json serializado

});

$app->put("/api/clientes/{id}", function ($id, Request $request) use ($app) {
	//atualiza um cliente

	$data["nome"] = $request->request->get("nome");
	$data["email"] = $request->request->get("email");

	$dados = $app["clienteService"]->update($id, $data); //chama o método update

	return $app->json($dados); //retorna em json

});

$app->delete("/api/clientes/{id}", function ($id) use ($app) {
	//deleta um cliente

	$dados = $app["clienteService"]->delete($id); //chama o método delete

	return $app->json($dados); //retorna em json

});

// $response = new Response();  //cria o objeto response

// $app->get("/", function() use($response){ //define uma rota, essa rota tem uma função e essa função tem que retornar um response

//     $response->setContent("tst"); //seta o conteudo do response, ou seja a resposta da requisição

//     return $response; //retorna mostrando na tela

// });

$app->get("/", function () use ($app) {

	return $app["twig"]->render("index.twig", []); //faz o twig renderizar o arquivo index.twig

})->bind("index"); //define url como index

// $app->get("/ola/{nome}", function($nome) { //cria uma rota dinamica que é passado por parametro

//     return "ola ". $nome;

// });

$app->get("/ola/{nome}", function ($nome) use ($app) {
	//cria uma rota dinamica que é passado por parametro

	return $app["twig"]->render("ola.twig", ["nome" => $nome]); //faz o twig renderizar o arquivo ola.twig que ira imprimir uma variável

});

$app->get("/clientes", function () use ($app) {

	$dados = $app["clienteService"]->fetchAll(); //chama o método fetchAll

	return $app["twig"]->render("clientes.twig", ["clientes" => $dados]);

})->bind("clientes"); //define url como clientes

$app->get("/cliente", function () use ($app) {
	//cria a rota e recebe os dados

	$dados["nome"] = "Cliente";
	$dados["email"] = "email@cliente.com";

	$result = $app["clienteService"]->insert($dados); //chama o container de de serviço passando dados fictícios para um insert

	return $app->json($result); //retorna o resultado

});

$app->run(); //chamada do método de execução do silex

?>