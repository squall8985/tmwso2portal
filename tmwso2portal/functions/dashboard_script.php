var color = Chart.helpers.color;

var configOnline = {
	labels: ['Completed', 'Processed', 'Error'],
	datasets: [{
		label: 'Online Data Set',
		backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
		borderColor: window.chartColors.blue,
		data:<?php echo json_encode($dataPointsOnlineBar, JSON_NUMERIC_CHECK); ?>,
		backgroundColor: [
        	window.chartColors.blue,
        	window.chartColors.green,
        	window.chartColors.red,
        ],
        responsive: true,
	}]
};

var configBatch = {
	labels: ['Completed', 'Sent', 'Error', 'Rejected'],
	datasets: [{
		label: 'Batch Data Set',
		backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
		borderColor: window.chartColors.blue,
		data:<?php echo json_encode($dataPointsBatchBar, JSON_NUMERIC_CHECK); ?>,
		backgroundColor: [
        	window.chartColors.blue,
        	window.chartColors.green,
        	window.chartColors.red,
        	window.chartColors.orange,
        ],
        responsive: true,
	}]
};


window.onload = function() {
	<?php if ($dataPointsOnlineBar != null) { ?>
	var ctx = document.getElementById('chart-area-online').getContext('2d');
	window.myHorizontalBar = new Chart(ctx, {
				type: 'doughnut',
				data: configOnline,
				options: {
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'right',
					},
					title: {
						display: true,
						text: 'Online Health Status'
					},
					onClick: function(c,i) {
                        e = i[0];

                        var x_value = this.data.labels[e._index];
                        var y_value = this.data.datasets[0].data[e._index];

                        window.location.href = "onlineInterface.php?status=" + x_value + "&endDate=<?php echo $endOnline;?>" + "&startDate=<?php echo $startOnline;?> 00:00:00";
                    }
				}
			});

	<?php } else {?>
	$('#chartContainer-online-bar-chart-header').replaceWith('<h3>Online - No Data</h3>');
	$('#chartContainer-online-bar-chart').replaceWith('<img id="onlineNodata" src="images/nodata.png" />');
	
	<?php }?>

	<?php if ($dataPointsBatchBar != null) { ?>
	console.log('Im here 3');
	var ctx2 = document.getElementById('chart-area-batch').getContext('2d');
	window.myHorizontalBar2 = new Chart(ctx2, {
				type: 'doughnut',
				data: configBatch,
				options: {
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'right',
					},
					title: {
						display: true,
						text: 'Batch Health Status'
					},
					onClick: function(c,i) {
                        e = i[0];

                        var x_value = this.data.labels[e._index];
                        var y_value = this.data.datasets[0].data[e._index];

                        window.location.href = "batchInterface.php?status=" + x_value + "&endDate=<?php echo $endBatch;?>" + "&startDate=<?php echo $startBatch;?> 00:00:00";
                    }
				}
			});

	<?php } else {?>
console.log('Im here 4');
	$('#chartContainer-batch-bar-chart-header').replaceWith('<h3>Batch - No Data</h3>');
	$('#chartContainer-batch-bar-chart').replaceWith('<img id="batchNodata" src="images/nodata.png" />');
	
	<?php }?>
}