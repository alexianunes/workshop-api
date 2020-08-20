<?php

namespace Models;

use \Core\Model;
use \Models\Jwt;

class Usuarios extends Model
{

	public function checarUsuario($email, $senha){
		$array = array();
		$sql = "SELECT idusuarios, email, senha FROM tb_usuarios WHERE email = :email AND senha = :senha";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':senha', $senha);
		$sql->execute();
// $sql->debugDumpParams();exit;
		if($sql->rowCount() > 0) {
			$info = $sql->fetch();

			$this->idusuario = $info['idusuarios'];
			return true;

		}else{
			return false;
		}

		return $array;
	}

	public function listarTodos(){
			$data = array();

			$sql = "SELECT *
					FROM tb_usuarios u
					WHERE u.ativo = :ativo";

			$sql = $this->db->prepare($sql);
			$sql->bindValue(':ativo', '1');
			$sql->execute();
			// $sql->debugDumpParams();exit;

			if($sql->rowCount() > 0){
				$data = $sql->fetchAll(\PDO::FETCH_ASSOC);
			}

			return $data;
	}

	public function cadastrarUsuario($nome, $email, $senha){

			$sql = "INSERT INTO tb_usuarios (nome, email, senha, data_cad, ativo) VALUES (:nome, :email, :senha, NOW(), :ativo)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', $senha);
			$sql->bindValue(':ativo', '1');
			$sql->execute();

			return 'Usuário Cadastrado';
	}

	public function retornarUsuario($id){
			$data = array();

			$sql = "SELECT *
					FROM tb_usuarios u
					WHERE u.ativo = :ativo AND u.idusuarios = :idusuario";

			$sql = $this->db->prepare($sql);
			$sql->bindValue(':ativo', '1');
			$sql->bindValue(':idusuario', $id);
			$sql->execute();
			// $sql->debugDumpParams();exit;

			if($sql->rowCount() > 0){
				$data = $sql->fetchAll(\PDO::FETCH_ASSOC);
			}

			return $data;
	}

	public function modificarUsuario($id){
			$data = array();

			$sql = "UPDATE tb_usuarios
					SET
					nome = :nome,
					email = :email,
					senha = :senha
					WHERE ativo = :ativo AND idusuarios = :idusuario";

			$sql = $this->db->prepare($sql);
			$sql->bindValue(':ativo', '1');
			$sql->bindValue(':idusuario', $id);
			$sql->execute();
			// $sql->debugDumpParams();exit;

			return 'Usuário Modificado';
	}

}

 ?>