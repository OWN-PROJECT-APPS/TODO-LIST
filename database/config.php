<?php
class Database{

	private $host	    = 'localhost';
	private $user   	= 'root';
	private $pass	    = '';
	private $dbname	= 'todos';
    private $db;
    private $error;
    private $stmt;

	public function __construct(){
		// Set DSN
		$dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
		// Set Options
		$options = array(
			PDO::ATTR_PERSISTENT		=> true,
			PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION
		);
		// Create new PDO
		try {

			$this->db = new PDO($dsn, $this->user, $this->pass, $options);

		} catch(PDOException $e){
		       echo $e->getMessage();
		}
	}

	public function begin(){

			$this->db->beginTransaction();

	}
	public function commit(){

			$this->db->commit();

	}
	public function back(){

			$this->db->rollBack();

	}
	public function quoteMark($valueString){

		return $this->db->quote($valueString);
	}
	public function exec($query){

		return $this->db->exec($query);
	}
	public function query($query){

		 $this->stmt = $this->db->query($query);
	}
	public function prepare($query){

		 $this->stmt = $this->db->prepare($query);
	}
	public function bind($param,$value,$type=false){
		
		$this->stmt->bindParam($param,$value,$type);
	}
	public function execute($arry=null){

		return $this->stmt->execute($arry);
	}

	public function fetchOne(){
			
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}

	public function fetchMore(){

		return $this->stmt->fetchALL(PDO::FETCH_ASSOC);
	}

    public function lastInsertId(){

      return  $this->db->lastInsertId();
	}

	public function columnCount(){

      return  $this->stmt->columnCount();
	}
	public function rowCount(){

      return  $this->stmt->rowCount();
	}

	public function __destruct(){

	 $this->stmt      = NULL;
	 $this->db        = NULL;
	
		
	}
}