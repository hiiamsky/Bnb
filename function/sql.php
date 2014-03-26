<?php

class sql{
		private $databaseName="";
		private $dbh;
		private $stmt;
		private $ErrorStr="";
		private $debugMsgStr="";
		private $DSN="";
		public function __construct($db){	
			try{
				$this->DSN=DSN.$db;
				$this->setDebugMsgStr("DSN",$this->DSN);
				// parent::__construct($this->DSN,DB_USERNM,DB_PW);
				$this->dbh=new PDO($this->DSN,DB_USERNM,DB_PW);
				$this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->dbh->exec(DB_UTF8);
				
			}catch(PDOException $str){
				$this->setDebugMsgStr("__construct PDOException",$str->getMessage());
				$this->ErrorStr=$str->getMessage();
				die($str->getMessage());
			}
			
  		}
		
		public function query($query){
			$this->stmt=$this->dbh->prepare($query);	
		}
		
		public function bind($param, $value, $type = null){
    		if (is_null($type)) {
		        switch (true) {
		            case is_int($value):
		                $type = PDO::PARAM_INT;
		                break;
		            case is_bool($value):
		                $type = PDO::PARAM_BOOL;
		                break;
		            case is_null($value):
		                $type = PDO::PARAM_NULL;
		                break;
		            default:
		                $type = PDO::PARAM_STR;
		        }
    		}
    		$this->stmt->bindValue($param, $value, $type);
		}
		public function execute(){
   			return $this->stmt->execute();
		}
		public function resultset(){
    		$this->execute();
    		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function single(){
    		$this->execute();
    		return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
		public function rowCount(){
    		return $this->stmt->rowCount();
		}
		public function lastInsertId(){
    		return $this->dbh->lastInsertId();
		}
		public function beginTransaction(){
    		return $this->dbh->beginTransaction();
		}
		public function endTransaction(){
    		return $this->dbh->commit();
		}
		public function cancelTransaction(){
    		return $this->dbh->rollBack();
		}
		public function debugDumpParams(){
    		return $this->stmt->debugDumpParams();
		}
		
		private function setDebugMsgStr($debugnm,$debugstr){
			$this->debugMsgStr.=$debugnm.":".$debugstr."\n";
		} 
		public function getDebugMsgStr(){
			return $this->debugMsgStr;
		}
		
		
		//關閉連線
		public function Close(){
			$this->dbh=NULL;
		}
}
?>