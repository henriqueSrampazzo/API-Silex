<?php

namespace Code\Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name = "clientes_profile")
 */

class ClienteProfile {

	/**
	 *@ORM\Id
	 *@ORM\Column(type = "integer")
	 *@ORM\GeneratedValue
	 */
	private $id;

	/**
	 *@ORM\Column(type = "string", length=15)
	 */
	private $cpf;

	/**
	 *@ORM\Column(type = "string", length=15)
	 */
	private $rg;

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
	public function getCpf() {
		return $this->cpf;
	}

	/**
	 * @param mixed $cpf
	 *
	 * @return self
	 */
	public function setCpf($cpf) {
		$this->cpf = $cpf;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRg() {
		return $this->rg;
	}

	/**
	 * @param mixed $rg
	 *
	 * @return self
	 */
	public function setRg($rg) {
		$this->rg = $rg;

		return $this;
	}
}

?>