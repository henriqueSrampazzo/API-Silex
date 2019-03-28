<?php

namespace Code\Sistema\Entity;

use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository {

	public function getClientesOrdenados() {

		return $this
			->createQueryBuilder("c")
			->orderBy('c.nome', 'asc')
			->getQuery()
			->getResult();
	}

	public function getClientesDesc() {

		$dql = "SELECT c FROM Code\Sistema\Entity\Cliente c
			order by c.nome desc";

		return $this
			->getEntityManager()
			->createQuery($dql)
			->getResult();
	}

}

?>