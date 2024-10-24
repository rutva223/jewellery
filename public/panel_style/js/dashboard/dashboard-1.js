

(function($) {
    /* "use strict" */

 var dlabChartlist = function(){

	var screenWidth = $(window).width();
		//let draw = Chart.controllers.line.__super__.draw; //draw shadow
		var activity = function(){
		var optionsArea = {
          series: [{
            name: "Persent",
            data: [60, 70, 80, 50, 60, 90]
          },
		  {
            name: "Visitors",
            data: [40, 50, 40, 60, 90, 90]
          }
        ],
          chart: {
          height: 300,
          type: 'area',
		  group: 'social',
		  toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [3, 3, 3],
		  colors:['var(--secondary)','var(--primary)'],
		  curve: 'straight'
        },
        legend: {
			show:false,
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          },
		  markers: {
			fillColors:['var(--secondary)','var(--primary)'],
			width: 10,
			height: 10,
			strokeWidth: 0,
			radius: 16
		  }
        },
        markers: {
          size: [8,8],
		  strokeWidth: [4,4],
		  strokeColors: ['var(--secondary)','var(--primary)'],
		  border:2,
		  radius: 2,
		  colors:['#fff','#fff','#fff'],
          hover: {
            size: 10,
          }
        },
        xaxis: {
          categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
		  labels: {
		   style: {
			  colors: 'var(--text)',
			  fontSize: '14px',
			   fontFamily: 'Poppins',
			  fontWeight: 100,

			},
		  },
		  axisBorder:{
			  show: false,
		  }
        },
		yaxis: {
			labels: {
				minWidth: 20,
				offsetX:-16,
				style: {
				  colors: 'var(--text)',
				  fontSize: '14px',
				   fontFamily: 'Poppins',
				  fontWeight: 100,

				},
			},
		},
		fill: {
			colors:['#fff','#fff'],
			type:'gradient',
			opacity: 1,
			gradient: {
				shade:'light',
				shadeIntensity: 1,
				colorStops: [
				  [
					{
					  offset: 0,
					  color: '#fff',
					  opacity: 0
					},
					{
					  offset: 0.6,
					  color: '#fff',
					  opacity: 0
					},
					{
					  offset: 100,
					  color: '#fff',
					  opacity: 0
					}
				  ],
				  [
					{
					  offset: 0,
					  color: '#fff',
					  opacity: .4
					},
					{
					  offset: 50,
					  color: '#fff',
					  opacity: 0.25
					},
					{
					  offset: 100,
					  color: '#fff',
					  opacity: 0
					}
				  ]
				]

		  },
		},
		colors:['#1EA7C5','#FF9432'],
        grid: {
          borderColor: 'var(--border)',
		  xaxis: {
            lines: {
              show: true
            }
          },
		  yaxis: {
            lines: {
              show: false
            }
          },
        },

		 responsive: [{
			breakpoint: 1602,
			options: {
				markers: {
					 size: [6,6,4],
					 hover: {
						size: 7,
					  }
				},chart: {
				height: 230,
				},
			},

		 }]


        };
		if(jQuery("#activity").length > 0){

			var dzchart = new ApexCharts(document.querySelector("#activity"), optionsArea);
			dzchart.render();

            jQuery('#dzOldSeries').on('change',function(){
                jQuery(this).toggleClass('disabled');
                dzchart.toggleSeries('Persent');
            });

            jQuery('#dzNewSeries').on('change',function(){
                jQuery(this).toggleClass('disabled');
                dzchart.toggleSeries('Visitors');
            });

		}

	}

    var chartBarRunning = function() {
        var options = {
            series: [{
                    name: 'Send',
                    data: data1
                },
                {
                    name: 'Receive',
                    data: data2
                },
            ],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: '45%',
                    borderRadius: 5,
                },
            },
            colors: ['#', '#77248B'],
            dataLabels: {
                enabled: false,
            },
            markers: {
                shape: "circle",
            },
            legend: {
                show: false,
                fontSize: '12px',
                labels: {
                    colors: '#000000',
                },
                markers: {
                    width: 30,
                    height: 30,
                    strokeWidth: 0,
                    strokeColor: '#ebedf0',
                    fillColors: undefined,
                    radius: 35,
                }
            },
            stroke: {
                show: true,
                width: 6,
                colors: ['transparent']
            },
            grid: {
                borderColor: '#ebedf0',
            },
            xaxis: {
                categories: dates,
                labels: {
                    style: {
                        colors: '#888888',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#78909C',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                crosshairs: {
                    show: false,
                }
            },
            yaxis: {
                show: false, // Hide y-axis labels
            },
            fill: {
                opacity: 1,
                colors: ['#01A3FF', '#1EBA62'],
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val
                    }
                }
            },
            responsive: [{
                breakpoint: 575,
                options: {
                    plotOptions: {
                        bar: {
                            columnWidth: '1%',
                            borderRadius: -1,
                        },
                    },
                    chart: {
                        height: 250,
                    },
                    series: [{
                            name: 'Projects',
                            data: [31, 40, 28, 31, 40, 28, 31, 40]
                        },
                        {
                            name: 'Projects',
                            data: [11, 32, 45, 31, 40, 28, 31, 40]
                        },
                    ],
                }
            }]
        };

        if (jQuery("#chartBarRunning").length > 0) {
            var chart = new ApexCharts(document.querySelector("#chartBarRunning"), options);
            chart.render();

            jQuery('#dzSendSeries').on('change', function() {
                jQuery(this).toggleClass('disabled');
                chart.toggleSeries('Send');
            });

            jQuery('#dzReceiveSeries').on('change', function() {
                jQuery(this).toggleClass('disabled');
                chart.toggleSeries('Receive');
            });
        }
    }

	var pieChart = function(){
		var options = {
		  series: [10,20,35,35],
		  chart: {
		  type: 'donut',
		  height:200,
		  innerRadius: 50,
		},
		dataLabels: {
		  enabled: false
		},
		stroke: {
		  width: 0,
		},
		plotOptions: {
			  pie: {
				 startAngle: 0,
				  endAngle: 360,
				 donut: {
					  size: '80%',
				 },
			 },
		},
		colors:[ '#2A353A', '#2BC844' ,'#9568FF', 'var(--primary)'],
		legend: {
			  position: 'bottom',
			  show:false
			},
		responsive: [{
		  breakpoint: 768,
		  options: {
		   chart: {
			  width:200
			},
		  }
		}]
		};

		var chart = new ApexCharts(document.querySelector("#pieChart"), options);
		chart.render();
	}

	var swipercard = function() {
		var swiper = new Swiper('.mySwiper-counter', {
			speed: 1500,
			slidesPerView: 4,
			spaceBetween: 40,
			parallax: true,
			loop:false,
			autoplay: {
				delay: 5000,
			  },
			breakpoints: {

			  300: {
				slidesPerView: 1,
				spaceBetween: 30,
			  },
			  576: {
				slidesPerView: 2,
				spaceBetween: 30,
			  },
			  991: {
				slidesPerView: 3,
				spaceBetween: 30,
			  },
			  1200: {
				slidesPerView: 4,
				spaceBetween: 30,
			  },
			},
		});
	}
	var swiperreview = function() {
		var swiper = new Swiper('.mySwiper', {
			slidesPerView: 1,
			speed: 1500,
			 spaceBetween: 40,
			loop:false,

			autoplay: {
				delay: 5000,
			  },
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			breakpoints: {

			  300: {
				slidesPerView: 1,
				spaceBetween: 30,
			  },
			  991: {
				slidesPerView: 2,
				spaceBetween: 30,
			  },
			  1200: {
				slidesPerView: 3,
				spaceBetween: 30,
			  },
			},
		});
	}



	/* Function ============ */
		return {
			init:function(){
			},


			load:function(){
				activity();
				chartBarRunning();
				swipercard();
				swiperreview();

			},

			resize:function(){
				chartBarRunning();
			}
		}

	}();



	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000);

	});



})(jQuery);
