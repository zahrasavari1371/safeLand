$(document).ready(function () {
  $(".category").on("click", function () {
    $(".categories").addClass("hidden");
    $(".article-list").removeClass("hidden");
  });
});
