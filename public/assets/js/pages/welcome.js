let currentStep = 0;

function assignPage(index) {
  document.querySelectorAll(".welcome-page-section").forEach((section) => {
    section.classList.add("hidden");
  });
  document.querySelector(`#welcome-page-${index}`).classList.remove("hidden");
}

document.querySelector(".next-button").addEventListener("click", function () {
  currentStep += 1;
  assignPage(currentStep);
});

document.querySelector(".back-button").addEventListener("click", function () {
  currentStep -= 1;
  console.log("currentStep", currentStep);
  assignPage(currentStep);
});

document.querySelector(".skip-button").addEventListener("click", function () {
  currentStep = 4;
  assignPage(currentStep);
});
