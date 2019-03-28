<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Interesse;
use Doctrine\ORM\EntityManager;

class InteresseService {

	private $em;

	public function __construct(EntityManager $em) {
		//criação do método construtor que vai receber as classes que precisa por parametro

		$this->em = $em;
	}

	public function insert(array $data) {
		//função que envia os dados para serem inseridos

		$interesse = new Interesse();
		$interesse->setNome($data['nome']);

		$this->em->persist($interesse);
		$this->em->flush();

		return $interesse;
	}
}
