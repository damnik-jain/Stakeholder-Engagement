
function loadChartFunction(chartId, color1, color2, dataset4, dataset5 ){
	var ctx = document.getElementById(chartId).getContext('2d');
	
	var label = [];
	var dataset1 = [];
	var dataset2 = [];
	
	var temp1 = JSON.parse(dataset4);
	var temp2 = JSON.parse(dataset5);
	
	for(var key in temp1)
	{
		dataset1.push(temp1[key]['y']);
		label.push(temp1[key]['x']);
	}

	for(var key in temp2)
	{
		dataset2.push(temp2[key]['y']);
		//label.push(temp2[key]['x']);
	}

	ctx.lineJoin = 'round';    
    var char = new Chart(ctx, {
    	type:'line',
	    data: {
	    	labels: label,
	        datasets: [{
	            label: 'Project views',
	            //Changes the region color of chart
	            backgroundColor:color1,
			    borderColor: color1,
			    data: dataset1,
			    fill: false,
	            //Show only the point and no line
	            //,showLine: false
	        }
	        ,{
	        	label: 'User interested',
	            //Changes the region color of chart
	            backgroundColor: color2,
			    borderColor: color2,
			    data: dataset2,
			    fill:false,
	            //Show only the point and no line
	            //,showLine: false
	        }
	        ]
	    },
	   options  : {
	   	responsive: true,
	    title: {
	      display: true,
	      text: "Project clicks analysis"
	    },
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		}, 
	    //Makes y axis to start at zero
	    scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        elements: {
            line: {
                tension: 0, // disables bezier curves
            }
        }
	  }
	});

}

function singleChart(chartId, color1, color2, dataset4, weekflag){

	var ctx = document.getElementById(chartId).getContext('2d');
	var label = [];
	var dataset1 = [];
	
	var temp1 = JSON.parse(dataset4);

	if(weekflag==0)
		for(var key in temp1)
		{
			dataset1.push(temp1[key]['y']);
			label.push(temp1[key]['x']);
		}
	else{
		//0->monday and 6->sunday
			
		var itr;
		for(itr=0;itr<7;itr++){
			var flag = 0;
			for(var key in temp1 ){
				if((itr+'')==temp1[key]['x']){
					label.push(getDayName(itr));
					dataset1.push(temp1[key]['x']);
					flag=1;
					break;
				}
			}
			if(flag==0){
				label.push(getDayName(itr));
				dataset1.push(0);
			}
		}

	}
	
	//alert('Load chart function called '+arguments.length);
	ctx.lineJoin = 'round';    
    var char = new Chart(ctx, {
    	type:'line',
	    data: {
	    	labels: label,
	        datasets: [{
	            label: 'Project views',
	            //Changes the region color of chart
	            backgroundColor:color1,
			    borderColor: color1,
			    data: dataset1,
			    fill: false,
	            //Show only the point and no line
	            //,showLine: false
	        }
	        ]
	    },
	   options  : {
	   	responsive: true,
	    title: {
	      display: true,
	      text: "Project clicks analysis"
	    },
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		}, 
	    //Makes y axis to start at zero
	    scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        elements: {
            line: {
                tension: 0, // disables bezier curves
            }
        }
	  }
	});

}
function getDayName(i){
	var comp = ''+i;
	switch(comp){
		case '0': 
			return "Monday";
		case '1': 
			return "Tuesday";
		case '2': 
			return "Wednesday";
		case '3': 
			return "Thrusday";
		case '4': 
			return "Friday";
		case '5': 
			return "Saturday";
		case '6': 
			return "Sunday";
		default: 
			return "Default";
	}
}

function loadSortChart(type, value){
	alert("Report ananliusi");
	//if(type=="project")
}
