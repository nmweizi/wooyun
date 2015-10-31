/* <script> */
var root="http://zone.wooyun.org";
/* Copy */
function Copy(str){
	if(window.clipboardData){
    	window.clipboardData.clearData();
    	window.clipboardData.setData("Text",str);
		alert("复制成功");
    }else{
		alert("您的浏览器不支持此操作,请手动复制输入框里的链接");
	}
}
function Register(){
	var errNum=0;
	var checkItems=['user','email','pwd','pwd2'];
	for(var i=0;i<checkItems.length;i++){
		if($("#"+checkItems[i]).val()==""){
			errNum++;
			$("#"+checkItems[i]+"_check").addClass("error");
			$("#"+checkItems[i]+"_check").html("不能为空");
		}else{
			$("#"+checkItems[i]+"_check").addClass("correct");
			$("#"+checkItems[i]+"_check").html("√");
		}
	}
	/* 特殊判断 */
	//用户格式
	var user=$("#user").val();
	if(user!="")
	{
		if(!/^\w{4,20}|[\u4E00-\u9FA5]{2,10}$/.test(user)){
			errNum++;
			$("#user_check").removeClass("correct");
			$("#user_check").addClass("error");
			$("#user_check").html("4-20个字符(字母、汉字、数字、下划线)");
		}else{
			$("#user_check").removeClass("error");
			$("#user_check").addClass("correct");
			$("#user_check").html("√");
		}
	}
	//邮箱格式
	var email=$("#email").val();
	if(email!=""){
		if(!/^(\w+\.)*?\w+@(\w+\.)+\w+$/.test(email)){
			errNum++;
			$("#email_check").removeClass("correct");
			$("#email_check").addClass("error");
			$("#email_check").html("邮箱格式不正确");
		}else{
			$("#email_check").removeClass("error");
			$("#email_check").addClass("correct");
			$("#email_check").html("√");
		}
	}
	//密码
	var pwd=$("#pwd").val();
	if(pwd!="")
	{
		if(!/^\w{6,20}$/.test(pwd)){
			errNum++;
			$("#pwd_check").removeClass("correct");
			$("#pwd_check").addClass("error");
			$("#pwd_check").html("6-20个字符(字母、数字、下划线)");
		}else{
			$("#pwd_check").removeClass("error");
			$("#pwd_check").addClass("correct");
			$("#pwd_check").html("√");
		}
	}
	//确认密码
	var pwd2=$("#pwd2").val();
	if(pwd2!="")
	{
		if(pwd2!=pwd){
			errNum++;
			$("#pwd2_check").removeClass("correct");
			$("#pwd2_check").addClass("error");
			$("#pwd2_check").html("两次输入密码不相同");
		}else{
			$("#pwd2_check").removeClass("error");
			$("#pwd2_check").addClass("correct");
			$("#pwd2_check").html("√");
		}
	}
	//提交注册
	if(errNum<=0){
		//判断用户/邮箱是否存在
		$.post(root+"/index.php?do=register&act=checkue&r="+Math.random(),{"user":user,"email":email},function(re){
			var reArr=re.split("|");
			if(reArr[0]==0 && reArr[1]==0){
				$("#formRegister").submit();
			}else{
				if(reArr[0]>0){
					$("#user_check").removeClass("correct");
					$("#user_check").addClass("error");
					$("#user_check").html("用户已存在");
				}
				if(reArr[1]>0){
					$("#email_check").removeClass("correct");
					$("#email_check").addClass("error");
					$("#email_check").html("邮箱已存在");
				}
			}
		});
	}
}
