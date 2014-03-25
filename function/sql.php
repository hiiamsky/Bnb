<?php
include_once 'DefSet.php';
class sql{
		private $databaseName="";
		private $dbh;
		private $stmt;
		public $ErrorStr="";
		public function __construct($db){	
			try{
				// parent::__construct(DSN.$db,DB_USERNM,DB_PW);
				$this->dbh=new PDO(DSN.$trim($db),DB_USERNM,DB_PW);
				$this->$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->$dbh->exec(DB_UTF8);
				
			}catch(PDOException $str){
				die( $str->getMessage() );
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
		
		//關閉連線
		public function Close(){
			$this->dbh=NULL;
		}
}
?>