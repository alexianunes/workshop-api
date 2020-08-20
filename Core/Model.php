<?php
namespace Core;

class Model {

	protected $db;
	protected $idusuario;

	public function __construct() {
		global $db;
		$this->db = $db;
		global $idusuario;
		$this->idusuario = $idusuario;
	}

}