document.addEventListener("DOMContentLoaded", function () {
  dragula([
    document.getElementById("task-column-body"),
    document.getElementById("in-progress-column-body"),
    document.getElementById("submitted-column-body"),
    document.getElementById("completed-column-body"),
  ]);
});
