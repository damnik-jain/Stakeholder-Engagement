

function loadChartFunction(label, dataset, chartId, color, height, titleT, prefix, suffix ){
	var data = {
			labels: label,
			datasets: [{title: titleT, values: dataset}]
		};
			
			
		//x_axis_mod and y_axis_mode remove the tick(the graph line)
		var chart = new Chart({
		parent: "#"+chartId, // or a DOM element
		data: data,
		type: "line", // or "solid"
		x_axis_mode: 'tick',  // for short label ticks0
							  // or 'span' for long spanning vertical axis lines
		y_axis_mode: 'tick',  // for long horizontal lines, or 'tick'
		 region_fill: 1, // Fill the area under the graph; default 0

		colors: color,
		height: parseInt(height),
		width: 500,
		format_tooltip_x: d => (d + '').toUpperCase(),
		format_tooltip_y: d => prefix+d+suffix,
		
		});
}


function formatCurrency(parameter1){

	
	var str = parameter1.toString().replace(symbol, "").split(',').join('');
	if(str=="")
		return "";
	var arr = (str.toString()).split('.');
	var bef = Number(arr[0]).toString();
	var charArr  = bef.split('');
	var finalResult = "";
	var len = charArr.length
	for(var t=len-1;t>=0;t--){
		var i = len -1 - t;
		finalResult = finalResult + charArr[t];
		if(i==2 && i<len-1)
			finalResult = finalResult + ',';
		
		if(i>2 && i<(len-1) && i%2==0)
			finalResult = finalResult + ',';
	}
	var reverseResult  = finalResult.split(''); 
	var formatedCurr = "";
	for(var i=reverseResult.length-1 ; i>=0 ; i--){
		formatedCurr = formatedCurr + reverseResult[i] ;
	}
	if((arr[1]+"")!="undefined")
		formatedCurr = formatedCurr+'.'+arr[1];
	return formatedCurr;
 }
 
 function formatCurrencyInputBox(id){
	 $('#'+id).val(formatCurrency($('#'+id).val()));
 }
 
 function addRupeeSymbol(id){
	var normalValue = $('#'+id).val().replace(symbol, '');
	$('#'+id).val(symbol+normalValue);//symbol+temp);
 }
 
 	  

function removePercent(idVal){
	var realValue = $('#'+idVal).val().replace("%", "").split('.');
	var finalresult = realValue[0];
	if(realValue.length>1)
		finalresult = finalresult +'.'+realValue[1];
	$('#'+idVal).val(finalresult+'%');
	setCaretPosition(idVal, finalresult.length);
}

function setCaretPosition(idVal, pos) {
	
	
  var ctrl = document.getElementById(idVal);
  if(pos==-1)
		pos = ctrl.value.length -1; 
	
  
  // Modern browsers
  if (ctrl.setSelectionRange) {
    ctrl.focus();
    ctrl.setSelectionRange(pos, pos);
  
  // IE8 and below
  } else if (ctrl.createTextRange) {
    var range = ctrl.createTextRange();
    range.collapse(true);
    range.moveEnd('character', pos);
    range.moveStart('character', pos);
    range.select();
  }
}		  
		
function loadDefaultValue(jsonStr){
	//Currently the loadDefaultValue(json string) is disabled bcoz data is not available
		
	
	var data = JSON.parse(jsonStr);
	$('#startingMRR').val( symbol + data.startingMRR);
	$('#revenueMRR').val( symbol + data.revenueMRR);
	$('#churnMRR').val( data.churnMRR + '%' );
	$('#startingCustomer').val( data.startingCustomer );
	$('#revenueCustomer').val( data.revenueCustomer );
	$('#churnCustomer').val( data.churnCustomer + '%' );
	$('#currentVisitor').val(  data.currentVisitor);
	$('#targetVisitor').val( data.targetVisitor);
	$('#currentConversion').val( data.currentConversion + '%');
	$('#targetConversion').val( data.targetConversion + '%');
	$('#currentArpu').val( symbol + data.currentArpu);
	$('#targetArpu').val( symbol + data.targetArpu);
	
	return ;
	
	
}	
	

function returnMonth(d){
	var today = new Date();
	var mm = today.getMonth();
	var yy = (""+today.getFullYear()).substring(2,4);

		
	var year = yy;
	
	var onlyOnce = true;
	var startingMonth = mm;
		
	var monthName = "";
	var t = parseInt((parseInt(d)+startingMonth)%12+1);
	switch(t){
		case 1: 
			monthName = "Jan";
			break;
		case 2: 
			monthName = "Feb";
			break;
		case 3: 
			monthName = "Mar";
			break;
		case 4: 
			monthName = "Apr";
			break;
		case 5:
			monthName = "May";
			break;
		case 6:
			monthName = "Jun";
			break;
		case 7:
			monthName = "Jul";
			break;
		case 8:
			monthName = "Aug";
			break;
		case 9:
			monthName = "Sep";
			break;
		case 10:
			monthName = "Oct";
			break;
		case 11:
			monthName = "Nov";
			break;
		case 12:
			monthName = "Dec";
			break;
		default:
			monthName = "---";
			break;
	}
	
	if(parseInt(d)+startingMonth>=12 && onlyOnce){
		year++;
		onlyOnce = false;
	}
	return monthName+"' "+year; //since 12 month in a year
}

function validInput(id){
	var temp = $('#'+id).val().replace("%", "").replace(symbol, '').split('.');
	//input.value = temp[0]+'.'+temp[1];
	$('#'+id).val(temp[0]+'.'+temp[1]);
	alert("Please enter valid values  "+ temp);
	return "";
}