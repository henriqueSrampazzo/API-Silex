<?php 

namespace SON\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
*@ORM\ Entity
*@ORM\ Table (name="posts")
*/
Class Post{

/**
*@ORM\ Id
*@ORM\ Column (type="integer")
*@ORM\ Generatedvalue
*/
private $id;

/**
*@ORM\ Column (type="string", length=100)
*/
private $titulo;

/**
*@ORM\ Column (type="text", length=100)
*/
private $conteudo; 

public function setConteudo($conteudo)
{
	$this->conteudo = $conteudo;
}

public function getConteudo()
{
	return $this->conteudo;
}

public function setId($id)
{
	$this->id = $id;
}

public function getId()
{
	return $this->id;
}

public function setTitulo($titulo)
{
	$this->titulo = $titulo;
}

public function getTitulo()
{
	return $this->titulo;
}


}

?>