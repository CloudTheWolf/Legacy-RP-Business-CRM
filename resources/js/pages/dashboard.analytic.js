/**
 *
 * DashboardAnalytic
 *
 * Dashboards.Analytic page content scripts. Initialized from scripts.js file.
 *
 *
 */

class DashboardAnalytic {
  constructor() {
    // References to page items that might require an update
    this._customLegendBarChart = null;
    this._bubbleChart = null;
    this._smallDoughnutChart1 = null;
    this._smallDoughnutChart2 = null;
    this._smallDoughnutChart3 = null;
    this._smallDoughnutChart4 = null;
    this._smallDoughnutChart5 = null;
    this._smallDoughnutChart6 = null;
    this._smallLineChart1 = null;
    this._smallLineChart2 = null;
    this._smallLineChart3 = null;
    this._smallLineChart4 = null;

    // Initialization of the page plugins
    this._initCustomLegendBarChart();
    this._initSmallDoughnutCharts();
    this._initConsumptionBubbleChart();
    this._initCoinsLineCharts();

    this._initEvents();
  }

  _initEvents() {
    // Listening for color change events to update charts
    document.documentElement.addEventListener(Globals.colorAttributeChange, (event) => {
      this._customLegendBarChart && this._customLegendBarChart.destroy();
      this._initCustomLegendBarChart();

      this._bubbleChart && this._bubbleChart.destroy();
      this._initConsumptionBubbleChart();

      this._smallDoughnutChart1 && this._smallDoughnutChart1.destroy();
      this._smallDoughnutChart2 && this._smallDoughnutChart2.destroy();
      this._smallDoughnutChart3 && this._smallDoughnutChart3.destroy();
      this._smallDoughnutChart4 && this._smallDoughnutChart4.destroy();
      this._smallDoughnutChart5 && this._smallDoughnutChart5.destroy();
      this._smallDoughnutChart6 && this._smallDoughnutChart6.destroy();
      this._initSmallDoughnutCharts();

      this._smallLineChart1 && this._smallLineChart1.destroy();
      this._smallLineChart2 && this._smallLineChart2.destroy();
      this._smallLineChart3 && this._smallLineChart3.destroy();
      this._smallLineChart4 && this._smallLineChart4.destroy();
      this._initCoinsLineCharts();
    });
  }

  //Consumptions bubble chart
  _initConsumptionBubbleChart() {
    if (typeof Chart !== 'undefined') {
      this._bubbleChart = new Chart(document.getElementById('bubbleChart'), {
        type: 'bubble',
        data: {
          labels: '',
          datasets: [
            {
              borderWidth: 2,
              label: ['Patty'],
              backgroundColor: 'rgba(' + Globals.primaryrgb + ',0.1)',
              borderColor: Globals.primary,
              data: [
                {
                  x: 240,
                  y: 15,
                  r: 15,
                },
              ],
            },
            {
              borderWidth: 2,
              label: ['Bread'],
              backgroundColor: 'rgba(' + Globals.quaternaryrgb + ',0.1)',
              borderColor: Globals.quaternary,
              data: [
                {
                  x: 140,
                  y: 8,
                  r: 10,
                },
              ],
            },
            {
              borderWidth: 2,
              label: ['Pastry'],
              backgroundColor: 'rgba(' + Globals.tertiaryrgb + ',0.1)',
              borderColor: Globals.tertiary,
              data: [
                {
                  x: 190,
                  y: 68,
                  r: 20,
                },
              ],
            },
          ],
        },
        options: {
          plugins: {
            crosshair: false,
            datalabels: {display: false},
          },
          title: {
            display: true,
            text: 'Consumption',
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [
              {
                scaleLabel: {
                  display: true,
                  labelString: 'Fat',
                },
                ticks: {beginAtZero: true, stepSize: 20, min: 0, max: 100, padding: 20},
              },
            ],
            xAxes: [
              {
                scaleLabel: {
                  display: true,
                  labelString: 'Calories',
                },
                ticks: {stepSize: 20, min: 100, max: 300, padding: 20},
              },
            ],
          },
          tooltips: ChartsExtend.ChartTooltip(),
          legend: {
            position: 'bottom',
            labels: ChartsExtend.LegendLabels(),
          },
        },
      });
    }
  }

  // Sales chart with the custom legend
  _initCustomLegendBarChart() {
    if (document.getElementById('customLegendBarChart')) {
      const ctx = document.getElementById('customLegendBarChart').getContext('2d');
      this._customLegendBarChart = new Chart(ctx, {
        type: 'bar',
        options: {
          cornerRadius: parseInt(Globals.borderRadiusMd),
          plugins: {
            crosshair: false,
            datalabels: {display: false},
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [
              {
                stacked: true,
                gridLines: {
                  display: true,
                  lineWidth: 1,
                  color: Globals.separatorLight,
                  drawBorder: false,
                },
                ticks: {
                  beginAtZero: true,
                  stepSize: 200,
                  min: 0,
                  max: 800,
                  padding: 20,
                },
              },
            ],
            xAxes: [
              {
                stacked: true,
                gridLines: {display: false},
                barPercentage: 0.5,
              },
            ],
          },
          legend: false,
          legendCallback: function (chart) {
            const legendContainer = chart.canvas.parentElement.parentElement.querySelector('.custom-legend-container');
            legendContainer.innerHTML = '';
            const legendItem = chart.canvas.parentElement.parentElement.querySelector('.custom-legend-item');
            for (let i = 0; i < chart.data.datasets.length; i++) {
              var itemClone = legendItem.content.cloneNode(true);
              var total = chart.data.datasets[i].data.reduce(function (total, num) {
                return total + num;
              });
              itemClone.querySelector('.text').innerHTML = chart.data.datasets[i].label.toLocaleUpperCase();
              itemClone.querySelector('.value').innerHTML = total;
              itemClone.querySelector('.value').style = 'color: ' + chart.data.datasets[i].borderColor + '!important';
              itemClone.querySelector('.icon-container').style = 'border-color: ' + chart.data.datasets[i].borderColor + '!important';
              itemClone.querySelector('.icon').style = 'color: ' + chart.data.datasets[i].borderColor + '!important';
              itemClone.querySelector('.icon').setAttribute('data-acorn-icon', chart.data.icons[i]);
              itemClone.querySelector('a').addEventListener('click', (event) => {
                event.preventDefault();
                const hidden = chart.getDatasetMeta(i).hidden;
                chart.getDatasetMeta(i).hidden = !hidden;
                if (event.currentTarget.classList.contains('opacity-50')) {
                  event.currentTarget.classList.remove('opacity-50');
                } else {
                  event.currentTarget.classList.add('opacity-50');
                }
                chart.update();
              });
              legendContainer.appendChild(itemClone);
            }
            new AcornIcons().replace();
          },
          tooltips: {
            enabled: false,
            custom: function (tooltip) {
              var tooltipEl = this._chart.canvas.parentElement.querySelector('.custom-tooltip');
              if (tooltip.opacity === 0) {
                tooltipEl.style.opacity = 0;
                return;
              }
              tooltipEl.classList.remove('above', 'below', 'no-transform');
              if (tooltip.yAlign) {
                tooltipEl.classList.add(tooltip.yAlign);
              } else {
                tooltipEl.classList.add('no-transform');
              }
              if (tooltip.body) {
                var chart = this;
                var index = tooltip.dataPoints[0].index;
                var datasetIndex = tooltip.dataPoints[0].datasetIndex;
                var icon = tooltipEl.querySelector('.icon');
                var iconContainer = tooltipEl.querySelector('.icon-container');
                iconContainer.style = 'border-color: ' + tooltip.labelColors[0].borderColor + '!important';
                icon.style = 'color: ' + tooltip.labelColors[0].borderColor + ';';
                icon.setAttribute('data-acorn-icon', chart._data.icons[datasetIndex]);
                new AcornIcons().replace();
                tooltipEl.querySelector('.text').innerHTML = chart._data.datasets[datasetIndex].label.toLocaleUpperCase();
                tooltipEl.querySelector('.value').innerHTML = chart._data.datasets[datasetIndex].data[index];
                tooltipEl.querySelector('.value').style = 'color: ' + tooltip.labelColors[0].borderColor + ';';
              }
              var positionY = this._chart.canvas.offsetTop;
              var positionX = this._chart.canvas.offsetLeft;
              tooltipEl.style.opacity = 1;
              tooltipEl.style.left = positionX + tooltip.dataPoints[0].x - 75 + 'px';
              tooltipEl.style.top = positionY + tooltip.caretY + 'px';
            },
          },
        },
        data: {
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
          datasets: [
            {
              label: 'Breads',
              backgroundColor: 'rgba(' + Globals.primaryrgb + ',0.1)',
              borderColor: Globals.primary,
              borderWidth: 2,
              data: [213, 434, 315, 367, 289, 354, 242],
            },
            {
              label: 'Cakes',
              backgroundColor: 'rgba(' + Globals.secondaryrgb + ',0.1)',
              borderColor: Globals.secondary,
              borderWidth: 2,
              data: [143, 234, 156, 207, 191, 214, 95],
            },
          ],
          icons: ['loaf', 'cupcake'],
        },
      });
      this._customLegendBarChart.generateLegend();
    }
  }

  // Progress doughnut charts
  _initSmallDoughnutCharts() {
    if (document.getElementById('smallDoughnutChart1')) {
      this._smallDoughnutChart1 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart1', [14, 0], 'PURCHASING');
    }
    if (document.getElementById('smallDoughnutChart2')) {
      this._smallDoughnutChart2 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart2', [12, 6], 'PRODUCTION');
    }
    if (document.getElementById('smallDoughnutChart3')) {
      this._smallDoughnutChart3 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart3', [22, 8], 'PACKAGING');
    }
    if (document.getElementById('smallDoughnutChart4')) {
      this._smallDoughnutChart4 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart4', [1, 5], 'DELIVERY');
    }
    if (document.getElementById('smallDoughnutChart5')) {
      this._smallDoughnutChart5 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart5', [4, 6], 'EDUCATION');
    }
    if (document.getElementById('smallDoughnutChart6')) {
      this._smallDoughnutChart6 = ChartsExtend.SmallDoughnutChart('smallDoughnutChart6', [3, 8], 'PAYMENTS');
    }
  }

  // Coin small line charts
  _initCoinsLineCharts() {
    this._smallLineChart1 = ChartsExtend.SmallLineChart('smallLineChart1', {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      datasets: [
        {
          label: 'BTC / USD',
          data: [9415.1, 9430.3, 9436.8, 9471.5, 9467.2],
          icons: ['chevron-bottom', 'chevron-top', 'chevron-top', 'chevron-top', 'chevron-bottom'],
          borderColor: Globals.primary,
          pointBackgroundColor: Globals.primary,
          pointBorderColor: Globals.primary,
          pointHoverBackgroundColor: Globals.foreground,
          pointHoverBorderColor: Globals.primary,
          borderWidth: 2,
          pointRadius: 2,
          pointBorderWidth: 2,
          pointHoverBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false,
        },
      ],
    });

    this._smallLineChart2 = ChartsExtend.SmallLineChart('smallLineChart2', {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      datasets: [
        {
          label: 'ETH / USD',
          data: [325.3, 310.4, 338.2, 347.1, 348.0],
          icons: ['chevron-top', 'chevron-bottom', 'chevron-top', 'chevron-top', 'chevron-top'],
          borderColor: Globals.primary,
          pointBackgroundColor: Globals.primary,
          pointBorderColor: Globals.primary,
          pointHoverBackgroundColor: Globals.foreground,
          pointHoverBorderColor: Globals.primary,
          borderWidth: 2,
          pointRadius: 2,
          pointBorderWidth: 2,
          pointHoverBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false,
        },
      ],
    });

    this._smallLineChart3 = ChartsExtend.SmallLineChart('smallLineChart3', {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      datasets: [
        {
          label: 'LTC / USD',
          data: [43.3, 42.8, 45.3, 45.3, 41.4],
          icons: ['chevron-top', 'chevron-bottom', 'chevron-top', 'circle', 'chevron-top'],
          borderColor: Globals.primary,
          pointBackgroundColor: Globals.primary,
          pointBorderColor: Globals.primary,
          pointHoverBackgroundColor: Globals.foreground,
          pointHoverBorderColor: Globals.primary,
          borderWidth: 2,
          pointRadius: 2,
          pointBorderWidth: 2,
          pointHoverBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false,
        },
      ],
    });

    this._smallLineChart4 = ChartsExtend.SmallLineChart('smallLineChart4', {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      datasets: [
        {
          label: 'XRP / USD',
          data: [0.25, 0.253, 0.268, 0.243, 0.243],
          icons: ['chevron-top', 'chevron-top', 'chevron-top', 'chevron-bottom', 'circle'],
          borderColor: Globals.primary,
          pointBackgroundColor: Globals.primary,
          pointBorderColor: Globals.primary,
          pointHoverBackgroundColor: Globals.foreground,
          pointHoverBorderColor: Globals.primary,
          borderWidth: 2,
          pointRadius: 2,
          pointBorderWidth: 2,
          pointHoverBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false,
        },
      ],
    });
  }
}
