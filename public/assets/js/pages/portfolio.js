const ApexChartDefault = {
  type: "line",
  zoom: {
    enabled: false,
  },
  toolbar: {
    show: false,
  },
};

const ApexStrokeDefault = {
  width: 3,
  curve: "smooth",
  lineCap: "round",
};

const ApexBarDefault = {
  chart: {
    zoom: {
      enabled: false,
    },
    toolbar: {
      show: false,
    },
    type: "bar",
    height: 300,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "30px",
      borderRadius: 2,
    },
  },
  colors: [
    "#6574cd",
    "#2563eb",
    "#10b981",
    "#f59e0b",
    "#ef4444",
    "#8b5cf6",
    "#3b82f6",
  ],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 6,
    curve: "smooth",
    colors: ["transparent"],
  },
  legend: {
    itemMargin: {
      vertical: 10,
    },
    tooltipHoverFormatter: function (val, opts) {
      return (
        val +
        " - " +
        opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
        ""
      );
    },
  },
  xaxis: {
    categories: [],
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return `${val}`;
      },
    },
  },
};

const ApexDataLabelDefault = {
  enabled: false,
};

const ApexDonutChartDefault = {
  colors: [
    "#6574cd",
    "#2563eb",
    "#10b981",
    "#f59e0b",
    "#ef4444",
    "#8b5cf6",
    "#3b82f6",
  ],
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          total: {
            show: true,
            showAlways: true,
            label: "دارایی‌ها",
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                return a + b;
              }, 0);
            },
          },
        },
        size: "85%",
      },
    },
  },
  stroke: {
    colors: ["transparent"],
  },
  labels: [],
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
};

const ApexLineChartDefault = {
  chart: {
    zoom: {
      enabled: false,
    },
    toolbar: {
      show: false,
    },
  },
  colors: [
    "#6574cd",
    "#2563eb",
    "#10b981",
    "#f59e0b",
    "#ef4444",
    "#8b5cf6",
    "#3b82f6",
  ],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 2.5,
    curve: "smooth",
    lineCap: "round",
  },
  legend: {
    itemMargin: {
      vertical: 10,
    },
    tooltipHoverFormatter: function (val, opts) {
      return (
        val +
        " - " +
        opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
        ""
      );
    },
  },
  xaxis: {
    categories: [
      "01 Jan",
      "02 Jan",
      "03 Jan",
      "04 Jan",
      "05 Jan",
      "06 Jan",
      "07 Jan",
      "08 Jan",
      "09 Jan",
      "10 Jan",
      "11 Jan",
      "12 Jan",
    ],
  },
};

const ApexColorDefault = [
  "#6574cd",
  "#2563eb",
  "#10b981",
  "#f59e0b",
  "#ef4444",
  "#8b5cf6",
  "#3b82f6",
];

// Usage example:
const assetsDonutOption = {
  chart: {
    ...ApexChartDefault,
    height: 230,
    type: "donut",
  },
  ...ApexDonutChartDefault,
  series: [15032, 11246, 8273],
  labels: ["بیت کوین", "اتریوم", "سولانا"],
};

new ApexCharts(
  document.querySelector("#assets-chart"),
  assetsDonutOption
).render();

const statisticChartOptions = {
  ...ApexLineChartDefault,
  series: [
    {
      name: "بیت کوین",
      data: [
        16375, 18954, 16869, 19569, 17381, 18981, 21403, 18902, 20244, 19706,
      ],
    },
    {
      name: "اتریوم",
      data: [
        10689, 12646, 11420, 13520, 11655, 13826, 13092, 13805, 12560, 13993,
      ],
    },
    {
      name: "سولانا",
      data: [8163, 8921, 8337, 9614, 9063, 9998, 9041, 10224, 9332, 10379],
    },
  ],
  chart: {
    ...ApexChartDefault,
    height: 350,
    type: "line",
    zoom: {
      enabled: false,
    },
  },
  xaxis: {
    categories: [
      "01 دی",
      "02 دی",
      "03 دی",
      "04 دی",
      "05 دی",
      "06 دی",
      "07 دی",
      "08 دی",
      "09 دی",
      "10 دی",
      "11 دی",
      "12 دی",
    ],
  },
};

new ApexCharts(
  document.querySelector("#statistic-chart"),
  statisticChartOptions
).render();
