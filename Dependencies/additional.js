var xValue = [];
var yValue = [];
var xInterestedValue = [];
var yInterestedValue = [];
function loadChartFunction(label, dataset1, dataset2, 
	chartId, color1, color2){

	//int min = label[0].subs
	var ctx = document.getElementById(chartId);

	//ctx.lineJoin = 'round';    
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
			    fill:false
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
