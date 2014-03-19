$(document).ready(function(){
	$(document).on("click","#btnSumit",function(evt){
		if($.trim($("#BnbID").val())==""){
			alert("請輸入民宿編號");
			$("#BnbID").focus();
			return false;
		}
		if($.trim($("#LoginID").val())==""){
			alert("請輸入使用者名稱");
			$("#LoginID").focus();
			return false;
		}
		if($.trim($("#LoginPW").val())==""){
			alert("請輸入使用者密碼");
			$("#LoginPW").focus();
			return false;
		}
	});
	
});
