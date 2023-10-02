/**
 *
 * ProfileStandard
 *
 * Pages.Profile.Standard page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ProfileStandard {
  constructor() {
    // References to page items that might require an update
    this._bubbleChart = null;
    // Initialization of the page plugins
    if (typeof Chart !== 'undefined') {
      this._initActivityBubbleChart();
      this._initEvents();
    } else {
      console.error('[CS] Chart is undefined.');
    }
  }

  // Activity bubble chart
  _initActivityBubbleChart() {
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

  // Listening for color change events to update charts
  _initEvents() {
    document.documentElement.addEventListener(Globals.colorAttributeChange, (event) => {
      this._bubbleChart && this._bubbleChart.destroy();

      this._initActivityBubbleChart();
    });
  }
}
