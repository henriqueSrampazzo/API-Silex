<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente as ClienteEntity;
use Code\Sistema\Entity\ClienteProfile;
use Doctrine\ORM\EntityManager;

class ClienteService {

	private $em;

	public function __construct(EntityManager $em) {
		//criação do método construtor que vai receber as classes que precisa por parametro

		$this->em = $em;
	}

	public function insert(array $data) {
		//função que envia os dados para serem inseridos

		$clienteEntity = new ClienteEntity; //instancia objeto
		$clienteEntity->setNome($data["nome"]); //seta o nome do ciente
		$clienteEntity->setEmail($data["email"]); //seta o email do ciente

		if (isset($data['rg']) AND isset($data['cpf'])) {
// se não tiver vazio executa o codigo abaixo

			$clienteProfile = new ClienteProfile();
			$clienteProfile->setCpf($data['cpf']);
			$clienteProfile->setRg($data['rg']);

			$this->em->persist($clienteProfile); //persiste os dados

			$clienteEntity->setProfile($clienteProfile); // seta no profile
		}

		if (count($data['interesse'])) {

			$interesse = explode(",", $data['interesse']);

			foreach ($interesses as $rowInteresse) {

				$interesseEntity = $this->em->getReference("Code\Sistema\Entity\Interesse", $rowInteresse);

				$clienteEntity->addInteresse($interesseEntity);
			}

		}

		$this->em->persist($clienteEntity);
		$this->em->flush();

		return $clienteEntity;
	}

	public function update($id, array $array) {

		$cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id); //pega o cliente como referencia, cria uma imitação do objeto real, evita consulta antes de update

		$cliente->setNome($array['nome']);
		$cliente->setEmail($array['email']);

		$this->em->persist($cliente);
		$this->em->flush();
	}

	public function fetchAll() {

		$repo = $this->em->getRepository("Code\Sistema\Entity\Cliente");
		$result = $repo->getClientesOrdenados();

		return $result;
	}

	public function find($id) {

		$repo = $this->em->getRepository("Code\Sistema\Entity\Cliente");
		$result = $repo->find($id);

		return $result;
	}

	public function delete($id) {

		$cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

		$this->em->remove($cliente);

		return true;
	}
}
