const themeColors = {
  indigo: { 600: "#5a67d8", 100: "#e0e7ff" },
  blue: { 500: "#3b82f6", 100: "#eff6ff" },
  emerald: { 500: "#10b981", 100: "#ecfdf5" },
  amber: { 500: "#f59e0b", 100: "#fffbeb" },
  red: { 500: "#ef4444", 100: "#fee2e2" },
  purple: { 500: "#8b5cf6", 100: "#f3ebff" },
  cyan: { 500: "#06b6d4", 100: "#effdfd" },
};

// Define color constants
const COLOR_1 = themeColors.indigo["600"];
const COLOR_2 = themeColors.blue["500"];
const COLOR_3 = themeColors.emerald["500"];
const COLOR_4 = themeColors.amber["500"];
const COLOR_5 = themeColors.red["500"];
const COLOR_6 = themeColors.purple["500"];
const COLOR_7 = themeColors.cyan["500"];

const COLOR_1_LIGHT = themeColors.indigo["100"];
const COLOR_2_LIGHT = themeColors.blue["100"];
const COLOR_3_LIGHT = themeColors.emerald["100"];
const COLOR_4_LIGHT = themeColors.amber["100"];
const COLOR_5_LIGHT = themeColors.red["100"];
const COLOR_6_LIGHT = themeColors.purple["100"];
const COLOR_7_LIGHT = themeColors.cyan["100"];

// Define chart configurations
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
  colors: [COLOR_1, COLOR_2, COLOR_3, COLOR_4, COLOR_5, COLOR_6, COLOR_7],
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
  colors: [COLOR_1, COLOR_2, COLOR_3, COLOR_4, COLOR_5, COLOR_6, COLOR_7],
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          total: {
            show: true,
            showAlways: true,
            label: "",
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
  colors: [COLOR_1, COLOR_2, COLOR_3, COLOR_4, COLOR_5, COLOR_6, COLOR_7],
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
    categories: [],
  },
};

const ApexColorDefault = [
  COLOR_1,
  COLOR_2,
  COLOR_3,
  COLOR_4,
  COLOR_5,
  COLOR_6,
  COLOR_7,
];

// Portfolio performance chart options
const portfolioPerfomanceChartOption = {
  ...ApexLineChartDefault,
  series: [
    {
      name: "موجودی نمونه کارها",
      data: [
        14576.39, 23895.12, 19473.64, 26454.96, 24741.98, 33153.32, 30218.32,
        37645.11, 35556.15, 38886.34, 36135.95, 45966.12,
      ],
    },
  ],
  xaxis: {
    categories: [
      "13 دی",
      "16 دی",
      "18 دی",
      "21 دی",
      "24 دی",
      "26 دی",
      "29 دی",
      "31 دی",
      "03 بهمن",
      "06 بهمن",
      "09 بهمن",
      "11 بهمن",
    ],
  },
  legend: {
    show: false,
  },
};

// Render portfolio performance chart
new ApexCharts(
  document.querySelector("#portfolio-perfomance-chart"),
  portfolioPerfomanceChartOption
).render();
