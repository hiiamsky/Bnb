<?php
class sql{
		private $databaseName="";
		private $dbh=null;
		public $ErrorStr="";
		private $DSN="";
		public function __construct($db){	
			try{
				self::$dbh=new PDO("mysql:host=localhost;dbname=".$db.";port=3306","bnbadmin","sky_Bnb047");
				self::$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				self::$dbh->exec("SET CHARACTER SET utf8");
				
			}catch(PDOException $str){
				die( $str->getMessage() );
			}
			
  		}
		
		public function query($bnbID,$sqlstr){
			$returnVal="";
			try{

				$sth=self::$dbh->prepare($sqlStr);
				$sth->bindParam(1,$bnbID,PDO::PARAM_STR,strlen($bnbID));
				$sth->execute();
				$row=$sth->fetch();
				$returnVal= $row["RoomID"].$row["RoomNm"].$row["RoomPrice"]."<br>";
			}catch(PDOException $str){
				die($str->getMessage());
			}
			return $returnVal;
			
			
		}
		//關閉連線
		public function Close(){
			$this->dbh=NULL;
		}
}
?>