
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
		label.push(temp1[key]['x'])
	}

	for(var key in temp2)
	{
		dataset2.push(temp2[key]['y']);
	}

	alert('Load chart function called '+arguments.length);
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

function singleChart(chartId, color1, color2, dataset4){

	var ctx = document.getElementById(chartId).getContext('2d');
	alert('singleChart()');
	var label = [];
	var dataset1 = [];
	
	var temp1 = JSON.parse(dataset4);

	for(var key in temp1)
	{
		dataset1.push(temp1[key]['y']);
		label.push(temp1[key]['x'])
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

function loadSortChart(id){
	//var idt = document.getElementById(id).value;
	alert("Report ananliusi");
}



