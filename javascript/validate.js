function validate(form){
	$(".error-msg").remove();
	var result = true;
	try{
		$(form).find("[data-input]").each(function(index,element){
			if($(element).val() == ""){
				$(element).addClass("has-error");
				var spanEle = $("<span></span>");
				$(spanEle).text("*This field is required!");
				$(spanEle).addClass("error-msg");
				$(element).parent().append(spanEle);
				result = false;
			}
		});
	}catch(e){
		alert(e);
		result = false;
	}
	return result;
}



//
// var result = true;
//
// for(i=1;i<=noOfJobs;i++)
// {
// 	if($("#Execution"+i).val() <= $("#Period"+i))
// 	{
// 		result = false;
// 	}
// }
