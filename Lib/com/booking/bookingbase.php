<?php
	namespace \lib\com\booking;
	abstract class BookingBase extends \lib\com\menu\BnbMenu {
		private $html;
		private $sql;
		private $BookInfo;
		public function __construct($bnbid,$bnbdbnm,$bookingno,$bookingserial,$mode){
			parent::__construct();
			$this->html=new \lib\com\html();
			$this->sql=new \lib\com\sql($bnbdbnm);
			$this->BookInfo= new \lib\com\booking\BookingInfo($bnbdbnm);			
		}
		
		public function sqlClose(){
			$this->sql->Close();
			$this->BookInfo->sqlClose();
		}
		
		
	}
?>