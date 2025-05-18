// theme-constant.js
const tailwindcssColors = {
  indigo: {
    100: "#c3dafe",
    600: "#5a67d8",
  },
  blue: {
    100: "#bee3f8",
    500: "#4299e1",
  },
  emerald: {
    100: "#c6f6d5",
    500: "#48bb78",
  },
  amber: {
    100: "#fefcbf",
    500: "#ecc94b",
  },
  red: {
    100: "#fed7d7",
    500: "#f56565",
  },
  purple: {
    100: "#e9d8fd",
    500: "#9f7aea",
  },
  cyan: {
    100: "#cffafe",
    500: "#00bcd4",
  },
};

const themeColors = tailwindcssColors;

// chart.constant.js
const twColor = themeColors;

const COLOR_1 = twColor.indigo["600"];
const COLOR_2 = twColor.blue["500"];
const COLOR_3 = twColor.emerald["500"];
const COLOR_4 = twColor.amber["500"];
const COLOR_5 = twColor.red["500"];
const COLOR_6 = twColor.purple["500"];
const COLOR_7 = twColor.cyan["500"];

const COLOR_1_LIGHT = twColor.indigo["100"];
const COLOR_2_LIGHT = twColor.blue["100"];
const COLOR_3_LIGHT = twColor.emerald["100"];
const COLOR_4_LIGHT = twColor.amber["100"];
const COLOR_5_LIGHT = twColor.red["100"];
const COLOR_6_LIGHT = twColor.purple["100"];
const COLOR_7_LIGHT = twColor.cyan["100"];

const COLORS = [COLOR_1, COLOR_2, COLOR_3, COLOR_4, COLOR_5, COLOR_6, COLOR_7];

const COLORS_LIGHT = [
  COLOR_1_LIGHT,
  COLOR_2_LIGHT,
  COLOR_3_LIGHT,
  COLOR_4_LIGHT,
  COLOR_5_LIGHT,
  COLOR_6_LIGHT,
  COLOR_7_LIGHT,
];

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
  colors: [...COLORS],
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
      formatter: (val) => `${val}`,
    },
  },
};

const ApexDataLabelDefault = {
  enabled: false,
};

const ApexDonutChartDefault = {
  colors: [...COLORS],
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
  colors: [...COLORS],
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

const ApexColorDefault = [...COLORS];

// sales-dashboard.js
ApexLineChartDefault.chart.height = "380px";

const salesReportChartOption = {
  ...ApexLineChartDefault,
  series: [
    {
      name: "فروش آنلاین",
      data: [24, 33, 29, 36, 34, 43, 40, 47, 45, 48, 46, 55],
    },
    {
      name: "فروش بازاریابی",
      data: [20, 26, 23, 24, 22, 29, 27, 36, 32, 35, 32, 38],
    },
  ],
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
  legend: {
    show: false,
  },
};
new ApexCharts(
  document.querySelector("#sales-report-chart"),
  salesReportChartOption
).render();

ApexDonutChartDefault.plotOptions.pie.donut.labels.total.formatter = () =>
  "محصول فروخته شده";
ApexDonutChartDefault.plotOptions.pie.donut.labels.total.label = "284";

const categoriesChartOption = {
  chart: {
    ...ApexChartDefault,
    height: 300,
    type: "donut",
  },
  ...ApexDonutChartDefault,
  series: [351, 246, 144, 83],
  labels: ["دستگاه ها", "ساعت‌ها", "کیف ها", "کفش ها"],
};
new ApexCharts(
  document.querySelector("#categories-chart"),
  categoriesChartOption
).render();

const newDate = new Date();
const formattedDate = formatDate(newDate, "rtl"); // مثلاً تابع به جای rtl می تواند ltr باشد
const divElement = document.querySelector("#date-query-input");
divElement.setAttribute("value", formattedDate);

function formatDate(date, direction = "ltr") {
  const year = "2021";
  const month = "09";
  const day = "10";

  if (direction === "rtl") {
    return `${day}/${month}/${year}`; // ترتیب پیش‌فرض: روز/ماه/سال
  } else {
    return `${year}/${month}/${day}`; // ترتیب جدید: سال/ماه/روز
  }
}
// function formatDate(date) {
//   const year = date.getFullYear();
//   const month = String(date.getMonth() + 1).padStart(2, "0");
//   const day = String(date.getDate()).padStart(2, "0");
//   return `${month}/${day}/${year}`;
// }
