<?php  

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente;

use Code\Sistema\Mapper\ClienteMapper;

class ClienteService{

	private $cliente;
	private $clienteMapper;

	public function __construct(Cliente $cliente, ClienteMapper $clienteMapper){ //criação do método construtor que vai receber as classes que ele precisa por parametro

		$this->cliente = $cliente;  //recebendo e atribuindo valor a variável cliente
		$this->clienteMapper = $clienteMapper; //recebendo e atribuindo valor a variável clienteMapper
	}

	public function insert(array $data){ //função que envia os dados para serem inseridos 

		$clienteEntity = $this->cliente; //acessa a classe Cliente

		$clienteEntity->setNome($data["nome"]); //seta o nome do ciente
		$clienteEntity->setEmail($data["email"]); //seta o email do ciente

		$mapper = $this->clienteMapper; //acessa a classe ClienteMapper

		$result = $mapper->insert($clienteEntity); //envia os dados para serem inseridos 

		return $result;
	}

	public function update($id, array $array){

		return $this->clienteMapper->update($id, $array); // função que chama o método update da classe ClienteMapper
	}

	public function fetchAll(){

		return $this->clienteMapper->fetchAll(); // função que chama o método fetchAll da classe ClienteMapper
	}

	public function find($id){

		return $this->clienteMapper->find($id); // função que chama o método find da classe ClienteMapper
	}

	public function delete($id){ //função que exibe um retorno depois do delete

		return[

			"sucess" => true
		];
	}
}

?>