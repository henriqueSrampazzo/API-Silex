<?php

namespace Code\Sistema\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity(repositoryClass = "Code\Sistema\Entity\ClienteRepository")
 *@ORM\HasLifecycleCallbacks
 *@ORM\Table(name = "clientes")
 */
class Cliente {

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
	 *@ORM\Column(type = "string", length=255)
	 */
	private $email;

	/**
	 * @ORM\OneToOne(targetEntity="Code\Sistema\Entity\ClienteProfile")
	 * @ORM\JoinColumn(name="cliente_profile", referencedColumnName="id")
	 */
	private $profile; // relacionado um para um

	/**
	 * @ORM\ManyToOne(targetEntity="Code\Sistema\Entity\Cupom")
	 * @ORM\JoinColumn(name="cupom_id", referencedColumnName="id")
	 */
	private $cupom; // relacionado muitos para um

	/**
	 * @ORM\ManyToMany(targetEntity="Code\Sistema\Entity\Interesse")
	 * @ORM\JoinTable(name="clientes_intereses",
	 *joinColumns={@ORM\JoinColumn(name="cliente_id",referencedColumnName="id")},
	 *inverseJoinColumns ={@ORM\JoinColumn(name="interesse_id", *referencedColumnName="id")}
	 *)
	 */
	private $interesses; // relacionado muitos para muitos criando tabela join

	/**
	 *@ORM\Column(type = "datetime")
	 */
	private $createdAt;

	public function __construct() {

		$this->interesses = new ArrayCollection();
	}

	/**
	 *@ORM\PrePersist
	 */
	public function setupDate() {

		$this->createdAt = new \DateTime(); //antes de persisitir executa esse metodo

	}

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
	}

	public function getNome() {

		return $this->nome;
	}

	public function setNome($nome) {

		$this->nome = $nome;
	}

	public function getEmail() {

		return $this->email;
	}

	public function setEmail($email) {

		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getProfile() {
		return $this->profile;
	}

	/**
	 * @param mixed $profile
	 *
	 * @return self
	 */
	public function setProfile($profile) {
		$this->profile = $profile;

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

	/**
	 * @return mixed
	 */
	public function getInteresses() {
		return $this->interesses;
	}

	/**
	 * @param mixed $interesses
	 *
	 * @return self
	 */
	public function addInteresse($interesses) {
		$this->interesses->add($interesses);

		return $this;
	}
}

?>