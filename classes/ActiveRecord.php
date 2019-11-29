<?php
	

	class ActiveRecord {

		public static function getAll($filter = ""){
			
			$db = Database::getInstance();

			$sql = "select * from ". static::$table ." ". $filter;
			$q = $db->query($sql);

			$res = [];
			$q->setFetchMode(PDO::FETCH_CLASS,get_called_class());
			
			while($rw = $q->fetch()) {
				$res[] = $rw;
			}

			return $res;
		}

		public static function get($id){

			$db = Database::getInstance();
			$tabela = static::$table;
			$key = static::$key;

			if($id != null){
				$sql = "select * from {$tabela} where {$key} = :id";
				$prpst = $db->prepare($sql);
				//$prpst->bindParam(':id',$id);
				$prpst->execute(["id" => $id]);
				$prpst->setFetchMode(PDO::FETCH_CLASS,get_called_class());
			}
			return $prpst->fetch();
		}

		public  function generateSql(){
			$polja = "";
			foreach($this as $poljeKljuc => $poljeVrednost) {
				$polja.= $poljeKljuc . " = '" . $poljeVrednost . "',";
			}

			$polja = rtrim($polja,",");
			return $polja;
		}

		public function insert(){
			$db = Database::getInstance();
			$tabela = static::$table;
			$upit = "insert into {$tabela} set ";
			$upit .= $this->generateSql();
			$db->exec($upit);
			$kljucnaKolona = static::$key;
			$this->$kljucnaKolona = $db->lastInsertId();
		}

		public function update(){

			$db = Database::getInstance();

			$tabela = static::$table;
			$id = static::$key;

			$upit = "update {$tabela} set ";
			$upit .= $this->generateSql();
			$upit .= "where {$id} = {$this->id}";

			$db->exec($upit);
		}

		public static function delete($id){
			$db = Database::getInstance();

			$tabela = static::$table;
			$key = static::$key;

			$upit = "delete from {$tabela} where {$key} = {$id}";
			$db->exec($upit);
		}
	}