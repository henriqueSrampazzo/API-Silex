<?php 

namespace Code\Sistema\Mapper; //define o namespace da classe

use Code\Sistema\Entity\Cliente; // usa o namespace da classe Cliente 

class ClienteMapper{

	private $dados = [

		0 => [
			"id"=> 0,
			"nome" => "Cliente XPTO",
			"email" => "clientexpto@gmail.com"
		],

		1 => [
			"id"=> 1,
			"nome" => "Cliente Y",
			"email" => "clientey@gmail.com"
		],
	];

	public function insert(Cliente $cliente){ //função para inserção fictícia de dados que recebe por parametro um cliente

		return [ //exibe um retorno dos dados ficticíos

		"success"=> true
	];
}

public function update($id, array $array){ //método para atualizar cliente por id

	return[//exibe um retorno

	"success"=>true
];

}

public function find($id){ //método para achar id passado por parametro

	return $this->dados[$id];
}

public function fetchAll(){ //método para fatiar os dados

	$dados = $this->dados;

	return $dados; //retorna os dados
}

}

?>