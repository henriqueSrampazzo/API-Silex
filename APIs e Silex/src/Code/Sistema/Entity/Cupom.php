<?php

namespace Code\Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name = "cupons")
 */
class Cupom {

	/**
	 *@ORM\Id
	 *@ORM\Column(type = "integer")
	 *@ORM\GeneratedValue
	 */
	private $id;

	/**
	 *@ORM\Column(type = "string", length=255)
	 */
	private $valor;

	/**
	 *@ORM\Column(type = "decimal", precision=10, scale=2)
	 */
	private $cupom;

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
	public function getValor() {
		return $this->valor;
	}

	/**
	 * @param mixed $valor
	 *
	 * @return self
	 */
	public function setValor($valor) {
		$this->valor = $valor;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCupom() {
		return $this->cupom;
	}

	/**
	 * @param mixed $cupom
	 *
	 * @return self
	 */
	public function setCupom($cupom) {
		$this->cupom = $cupom;

		return $this;
	}
}

?>