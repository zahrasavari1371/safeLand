// chart-demo.js

class Chart {
  static init() {
    const basicOptions = {
      series: [
        {
          name: "دسکتاپ ها",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
          color: "#34c38f",
        },
      ],
      chart: {
        height: 350,
        type: "line",
        zoom: {
          enabled: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 3,
        curve: "smooth",
      },
      title: {
        text: "روند محصول بر اساس ماه",
        align: "left",
      },
      grid: {
        borderColor: "#f1f1f1",
      },
      xaxis: {
        categories: [
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
          "آذر",
        ],
      },
    };
    new ApexCharts(
      document.querySelector("#basic-chart"),
      basicOptions
    ).render();

    const dashLineOption = {
      series: [
        {
          name: "مدت زمان جلسه",
          data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10],
          color: "#556ee6",
        },
        {
          name: "بازدید از صفحه",
          data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35],
          color: "#f1b44c",
        },
        {
          name: "مجموع بازدیدها",
          data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47],
          color: "#f46a6a",
        },
      ],
      chart: {
        height: 350,
        type: "line",
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 3,
        curve: "smooth",
        dashArray: [0, 8, 5],
      },
      title: {
        text: "Page Statistics",
        align: "left",
      },
      legend: {
        tooltipHoverFormatter: function (val, opts) {
          return (
            val +
            " - <strong>" +
            opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
            "</strong>"
          );
        },
      },
      markers: {
        size: 0,
        hover: {
          sizeOffset: 6,
        },
      },
      xaxis: {
        labels: {
          trim: false,
        },
        categories: [
          "01 فروردین",
          "02 فروردین",
          "03 فروردین",
          "04 فروردین",
          "05 فروردین",
          "06 فروردین",
          "07 فروردین",
          "08 فروردین",
          "09 فروردین",
          "10 فروردین",
          "11 فروردین",
          "12 فروردین",
        ],
      },
      tooltip: {
        y: [
          {
            title: {
              formatter: function (val) {
                return val + " (mins)";
              },
            },
          },
          {
            title: {
              formatter: function (val) {
                return val + " per session";
              },
            },
          },
          {
            title: {
              formatter: function (val) {
                return val;
              },
            },
          },
        ],
      },
    };
    new ApexCharts(
      document.querySelector("#dashline-chart"),
      dashLineOption
    ).render();

    const basicAreaOption = {
      series: [
        {
          name: "سهام ABC",
          data: [
            8107.85, 8128.0, 8122.9, 8165.5, 8340.7, 8423.7, 8423.5, 8514.3,
            8481.85, 8487.7, 8506.9, 8626.2, 8668.95, 8602.3, 8607.55, 8512.9,
            8496.25, 8600.65, 8881.1, 9340.85,
          ],
          color: "#34c38f",
        },
      ],
      chart: {
        height: 350,
        type: "area",
        zoom: {
          enabled: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      title: {
        text: "تحلیل بنیادی سهام",
        align: "left",
      },
      subtitle: {
        text: "حرکات قیمت",
        align: "left",
      },
      labels: [
        "13 Nov 2017",
        "14 Nov 2017",
        "15 Nov 2017",
        "16 Nov 2017",
        "17 Nov 2017",
        "20 Nov 2017",
        "21 Nov 2017",
        "22 Nov 2017",
        "23 Nov 2017",
        "24 Nov 2017",
        "27 Nov 2017",
        "28 Nov 2017",
        "29 Nov 2017",
        "30 Nov 2017",
        "01 Dec 2017",
        "04 Dec 2017",
        "05 Dec 2017",
        "06 Dec 2017",
        "07 Dec 2017",
        "08 Dec 2017",
      ],
      xaxis: {
        type: "datetime",
      },
      yaxis: {
        opposite: true,
      },
      legend: {
        horizontalAlign: "left",
      },
      stroke: {
        width: 3,
        curve: "smooth",
      },
    };
    new ApexCharts(
      document.querySelector("#basic-area-chart"),
      basicAreaOption
    ).render();

    const splineChartOption = {
      series: [
        {
          name: "سری 1",
          data: [31, 40, 28, 51, 42, 109, 100],
          color: "#556ee6",
        },
        {
          name: "سری 2",
          data: [11, 32, 45, 32, 34, 52, 41],
          color: "#f1b44c",
        },
      ],
      chart: {
        height: 350,
        type: "area",
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 3,
        curve: "smooth",
      },
      xaxis: {
        type: "datetime",
        categories: [
          "2018-09-19T00:00:00.000Z",
          "2018-09-19T01:30:00.000Z",
          "2018-09-19T02:30:00.000Z",
          "2018-09-19T03:30:00.000Z",
          "2018-09-19T04:30:00.000Z",
          "2018-09-19T05:30:00.000Z",
          "2018-09-19T06:30:00.000Z",
        ],
      },
      tooltip: {
        x: {
          format: "dd/MM/yy HH:mm",
        },
      },
    };
    new ApexCharts(
      document.querySelector("#spline-area-chart"),
      splineChartOption
    ).render();

    const basicColumnOption = {
      series: [
        {
          name: "سود خالص",
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          color: "#34c38f",
        },
        {
          name: "درآمد",
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          color: "#556ee6",
        },
        {
          name: "جریان ازاد نقدینگی",
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
          color: "#f1b44c",
        },
      ],
      chart: {
        height: 350,
        type: "bar",
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: [
          "اسفند",
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
        ],
      },
      yaxis: {
        title: {
          text: "$ (هزاران)",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " هزاران";
          },
        },
      },
    };
    new ApexCharts(
      document.querySelector("#basic-column-chart"),
      basicColumnOption
    ).render();

    const stackedColumnOption = {
      series: [
        {
          name: "محصول A",
          data: [44, 55, 41, 67, 22, 43],
          color: "#34c38f",
        },
        {
          name: "محصول B",
          data: [13, 23, 20, 8, 13, 27],
          color: "#556ee6",
        },
        {
          name: "محصول C",
          data: [11, 17, 15, 15, 21, 14],
          color: "#f1b44c",
        },
      ],
      chart: {
        type: "bar",
        height: 350,
        stacked: true,
        toolbar: {
          show: true,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
        },
      },
      stroke: {
        width: 1,
        colors: ["#fff"],
      },
      title: {
        text: "نمودار میله ای انباشته",
        align: "left",
      },
      xaxis: {
        categories: [
          "2011 Q1",
          "2011 Q2",
          "2011 Q3",
          "2011 Q4",
          "2012 Q1",
          "2012 Q2",
        ],
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "K";
          },
        },
      },
      fill: {
        opacity: 1,
      },
      legend: {
        position: "top",
        horizontalAlign: "left",
        offsetX: 40,
      },
    };
    new ApexCharts(
      document.querySelector("#stack-column-chart"),
      stackedColumnOption
    ).render();

    const basicBarOption = {
      series: [
        {
          name: "سود خالص",
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          color: "#34c38f",
        },
        {
          name: "درآمد",
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          color: "#556ee6",
        },
      ],
      chart: {
        type: "bar",
        height: 350,
        toolbar: {
          show: true,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: [
          "اسفند",
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
        ],
      },
      yaxis: {
        title: {
          text: "$ (هزاران)",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " هزاران";
          },
        },
      },
    };
    new ApexCharts(
      document.querySelector("#basic-bar-chart"),
      basicBarOption
    ).render();

    const groupedBarOption = {
      series: [
        {
          name: "سود خالص",
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          color: "#34c38f",
        },
        {
          name: "درآمد",
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          color: "#556ee6",
        },
      ],
      chart: {
        type: "bar",
        height: 350,
        toolbar: {
          show: true,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: [
          "اسفند",
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
        ],
      },
      yaxis: {
        title: {
          text: "$ (هزاران)",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " هزاران";
          },
        },
      },
    };
    new ApexCharts(
      document.querySelector("#grouped-bar-chart"),
      groupedBarOption
    ).render();

    const simplePieOption = {
      series: [44, 55, 13, 43, 22],
      chart: {
        width: 380,
        type: "pie",
      },
      labels: ["تیم A", "تیم B", "تیم C", "تیم D", "تیم E"],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    };
    new ApexCharts(
      document.querySelector("#simple-pie"),
      simplePieOption
    ).render();

    const simpleDonutOption = {
      series: [44, 55, 41, 17, 15],
      chart: {
        width: 380,
        type: "donut",
      },
      labels: ["تیم A", "تیم B", "تیم C", "تیم D", "تیم E"],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
    };
    new ApexCharts(
      document.querySelector("#simple-donut"),
      simpleDonutOption
    ).render();
  }
}

// Initialize charts
Chart.init();
