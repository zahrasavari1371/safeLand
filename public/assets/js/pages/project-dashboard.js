const themeColors = {
  indigo: {
    100: "#EBF4FF",
    500: "#3F8AFF",
    600: "#1A4DFF",
  },
  blue: {
    100: "#EBF8FF",
    500: "#1E88E5",
  },
  emerald: {
    100: "#F0FFF4",
    500: "#10B981",
  },
  amber: {
    100: "#FFFBEB",
    500: "#F59E0B",
  },
  red: {
    100: "#FEF2F2",
    500: "#EF4444",
  },
  purple: {
    100: "#F5F3FF",
    500: "#8B5CF6",
  },
  cyan: {
    100: "#ECFEFF",
    500: "#06B6D4",
  },
};

const COLOR_1 = themeColors.indigo[600];
const COLOR_3 = themeColors.emerald[500];

const ApexBarDefault = {
  chart: {
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
  colors: [COLOR_1, COLOR_3],
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
    categories: [
      "21 آذر",
      "22 آذر",
      "23 آذر",
      "24 آذر",
      "25 آذر",
      "26 آذر",
      "27 آذر",
    ],
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: (val) => `${val}`,
    },
  },
};

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

const ApexDataLabelDefault = {
  enabled: false,
};

const ApexDonutChartDefault = {
  colors: [COLOR_1, COLOR_3],
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
              return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
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
  colors: [COLOR_1, COLOR_3],
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
      "21 آذر",
      "22 آذر",
      "23 آذر",
      "24 آذر",
      "25 آذر",
      "26 آذر",
      "27 آذر",
    ],
  },
};

const ApexColorDefault = [COLOR_1, COLOR_3];

const taskOverviewChartOption = {
  ...ApexBarDefault,
  series: [
    {
      name: "در دست اقدام",
      data: [45, 52, 68, 84, 103, 112, 126],
      color: COLOR_1,
    },
    {
      name: "تمام شده",
      data: [35, 41, 62, 62, 75, 81, 87],
      color: COLOR_3,
    },
  ],
  chart: {
    ...ApexChartDefault,
    type: "bar",
    height: 300,
  },
  xaxis: {
    categories: [
      "21 آذر",
      "22 آذر",
      "23 آذر",
      "24 آذر",
      "25 آذر",
      "26 آذر",
      "27 آذر",
    ],
  },
  legend: {
    show: false,
  },
};

new ApexCharts(
  document.querySelector("#task-overview-chart"),
  taskOverviewChartOption
).render();

const newDate = new Date();
const formattedDate = formatDate(newDate);
const divElement = document.querySelector(".project-calendar");
divElement.setAttribute("data-date", formattedDate);

function formatDate(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const day = String(date.getDate()).padStart(2, "0");
  return `${month}/${day}/${year}`;
}
