<?php

namespace Code\Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name = "interesses")
 */
class Interesse {

	/**
	 *@ORM\Id
	 *@ORM\Column(type = "integer")
	 *@ORM\GeneratedValue
	 */
	private $id;

	/**
	 *@ORM\Column(type = "string", length=255)
	 */
	private $nome;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 *
	 * @return self
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param mixed $nome
	 *
	 * @return self
	 */
	public function setNome($nome) {
		$this->nome = $nome;

		return $this;
	}
}

?>