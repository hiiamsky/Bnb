
$(document).ready(function(){
      $.ajaxPrefilter( function(options, originalOptions, jqXHR) {
            if ( applicationCache && applicationCache.status != applicationCache.UNCACHED && applicationCache.status != applicationCache.OBSOLETE ) {
                  // the important bit
                  options.isLocal = true;
            }
      });
	$(document).on("click","#btnSumit",function(evt){
		var loginData=$("#LoginForm").serialize();		
		$.ajax({
			type:"POST",
			url:"ckLogin.php",
			data:loginData,
			beforeSend: function(jqXHR) {
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
  			},
  			success:function(msg){
  				msg=$.trim(msg);
  				if(msg=="TRUE"){
  					// $.mobile.changePage('../BnbMenu.php');
  					document.location.href="../BnbMenu.php";
  				}else{
  					alert("登入失敗,請檢查民宿編號,使用者名稱,使用者密碼是否有誤!!!");
  				}
  			},
  			error: function(jqXHR,textStatus,errorThrown){
  				alert("登入發生失敗,請聯絡網站管理人員!!!");
  				
  			}
		});
		
		return false;
	});
	
});
