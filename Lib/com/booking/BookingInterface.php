<?php
	namespace lib\com\booking;

	interface BookingInterface{		
		public function show($bookingdate,$roomstatus,$page,$pagecount);
		protected  function setConditionStr($bookingdate,$roomstatus);
		protected  function sqlStr();
		protected  function setJMContent($row);
		protected  function setJScriptCode();
		// protected function setJScriptCode();
		// protected function setConditionStr($bookingdate,$roomstatus);
		// protected function sqlStr();
	}
?>