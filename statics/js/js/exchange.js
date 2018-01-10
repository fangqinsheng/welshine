$(function(){
	
	var productCount = 0;
	
	productCount = ClickExchange("fuwuche","zhenglixiang","canpangai");
	
	function ClickExchange(container,valsrc,productCount){
		var s = $("#"+valsrc).val();
		var obj = $.parseJSON(s.toString());
		var totalCount = obj.length;
		var perPageCount = 5;
		var PageCount = 0;
		var actualPageCount = 0;
		var strTotal = "";//待打印内容的缓冲变量
		
		var yeshu = totalCount%perPageCount;
		if(yeshu!=0){
			PageCount = parseInt(totalCount/perPageCount)+1;
		}else{
			PageCount = parseInt(totalCount/perPageCount);
		}
		
		if(productCount*perPageCount+perPageCount>totalCount){
			actualPageCount = totalCount-productCount*perPageCount;
		}
		else{
			actualPageCount = perPageCount;
		}
		
		//获取当前页的内容
	    for(i = brandCount * perPageCount;i < brandCount * perPageCount + actualPerPageCount;i++){
	        //obj[i].title为显示标题，obj[i].name为该品牌的类目id
	        strTotal += "<a href='' target='_blank'>" + obj[i].title + "</a>";
	    }
	    productCount++;
	    if(productCount>=PageCount){
	    	productCount = 0;
	    }
	}
})
