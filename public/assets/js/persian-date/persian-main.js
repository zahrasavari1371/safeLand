$(document).ready(function () {
    $(".datepicker").persianDatepicker({
        format: "YYYY/MM/DD HH:mm",  // فرمت تاریخ و ساعت
        autoClose: true,
        direction: "rtl",
        navigator: {
            enabled: true,
            text: {
                btnNextText: "«",
                btnPrevText: "»",
            },
        },
        toolbox: {
            calendarSwitch: {
                enabled: false, // غیر فعال کردن سوئیچ تقویم
            },
        },
        timePicker: {              // فعال کردن انتخاب ساعت
            enabled: true,         // فعال کردن انتخاب ساعت
            minuteStep: 1,         // گام دقیقه، یعنی 1 دقیقه
            showOn: "focus",       // زمان فقط وقتی که فیلد فوکوس است نمایش داده شود
        },
        onSelect: function (unixDate) {
            // تبدیل مقدار `unixDate` به تاریخ شمسی و فرمت `YYYY/MM/DD HH:mm`
            var formattedDate = new persianDate(unixDate).format("YYYY/MM/DD - HH:mm");
            $(this).val(formattedDate);  // اعمال تاریخ و ساعت به فیلد
        },
    });

    // $(".datepicker").persianDatepicker({
    //     format: "YYYY/MM/DD",
    //     autoClose: true,
    //     direction: "rtl",
    //     navigator: {
    //         enabled: true,
    //         text: {
    //             btnNextText: "«",
    //             btnPrevText: "»",
    //         },
    //     },
    //     toolbox: {
    //         calendarSwitch: {
    //             enabled: false, // Disable the calendar switch
    //         },
    //     },
    //     onSelect: function (unixDate) {
    //         // تبدیل مقدار `unixDate` به تاریخ شمسی و فرمت `YYYY/MM/DD`
    //         var formattedDate = new persianDate(unixDate).format("YYYY/MM/DD");
    //         $(this).val(formattedDate);
    //     },
    // });
});

$(document).ready(function () {
  $("#datepicker2").persianDatepicker({
    format: "YYYY/MM/DD",
    direction: "rtl",
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
    onSelect: function (date) {
      // تبدیل تاریخ به فرمت دلخواه
      var formattedDate = date.format("YYYY/MM/DD");
      $(".datepicker").val(formattedDate);
    },
  });
});
$(document).ready(function () {
  $("#startDate").persianDatepicker({
    format: "YYYY/MM/DD", // تنظیم فرمت تاریخ
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
    onSelect: function (date) {
      console.log("تاریخ شروع انتخاب شده:", date);
      // هنگام انتخاب تاریخ شروع، تاریخ پایان باید بعد از آن باشد
      var endDate = $("#endDate").persianDatepicker("getDate");
      if (endDate && date[0] > endDate) {
        $("#endDate").persianDatepicker("setDate", date[0]);
      }
    },
  });

  $("#endDate").persianDatepicker({
    format: "YYYY/MM/DD", // تنظیم فرمت تاریخ
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
    onSelect: function (date) {
      // هنگام انتخاب تاریخ پایان، تاریخ شروع باید قبل از آن باشد
      var startDate = $("#startDate").persianDatepicker("getDate");
      if (startDate && date[0] < startDate) {
        $("#startDate").persianDatepicker("setDate", date[0]);
      }
    },
  });
});
$(document).ready(function () {
  $(".locale-fa").persianDatepicker({
    inline: true,
    calendarType: "persian",
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
  });
});
$(".normal-example").persianDatepicker({
  navigator: {
    enabled: true,
    text: {
      btnNextText: "«",
      btnPrevText: "»",
    },
  },
  toolbox: {
    calendarSwitch: {
      enabled: false, // Disable the calendar switch
    },
  },
});
$(document).ready(function () {
  $("#pickerOprientation").persianDatepicker({
    format: "YYYY/MM/DD",
    position: [-360, 0],
    direction: "rtl",
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
    onSelect: function (date) {
      // تبدیل تاریخ به فرمت دلخواه
      var formattedDate = date.format("YYYY/MM/DD");
      $(".datepicker").val(formattedDate);
    },
  });
});
$(document).ready(function () {
  $("#pickerOprientation2").persianDatepicker({
    format: "YYYY/MM/DD",
    position: [-360, 0],
    direction: "rtl",
    navigator: {
      enabled: true,
      text: {
        btnNextText: "«",
        btnPrevText: "»",
      },
    },
    toolbox: {
      calendarSwitch: {
        enabled: false, // Disable the calendar switch
      },
    },
    onSelect: function (date) {
      // تبدیل تاریخ به فرمت دلخواه
      var formattedDate = date.format("YYYY/MM/DD");
      $(".datepicker").val(formattedDate);
    },
  });
});
