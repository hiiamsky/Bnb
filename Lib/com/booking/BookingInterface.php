<?php
	namespace lib\com\booking;

	interface BookingInterface{		
		public function show($bookingdate,$roomstatus,$page,$pagecount);
		private function setJScriptCode();
		private function setConditionStr($bookingdate,$roomstatus);
		private function sqlStr();
	}
?>