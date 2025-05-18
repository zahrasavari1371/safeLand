function copyToClipboard(text) {
  const textArea = document.createElement("textarea");
  textArea.value = text;
  document.body.appendChild(textArea);
  textArea.select();
  document.execCommand("copy");
  document.body.removeChild(textArea);
}

$(".icon-button").on("click", function () {
  const codeContainers = $(this).find(".icon-wrapper").children();
  const codeToastWrapperId = "#code-copy-toast-wrapper";

  if (codeContainers.length > 0) {
    copyToClipboard(codeContainers[0].outerHTML);
    if ($(`${codeToastWrapperId}`).length == 0) {
      $("body").append(
        '<div id="code-copy-toast-wrapper" class="toast-wrapper top-center"></div>'
      );
    }

    const toastHTML = `<div class="toast fade">
          <div class="notification">
              <div class="notification-content">
                  <div class="mr-3">
                      <span class="text-2xl text-emerald-400">
                          <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                          </svg>
                      </span>
                  </div>
                  <div class="mr-4">
                      <div class="notification-title">نماد کپی شد</div>
                  </div>
              </div>
          </div>
      </div>`;
    $(`${codeToastWrapperId}`).append(toastHTML);
    $(`${codeToastWrapperId} .toast:last-child`).toast("show");
    setTimeout(function () {
      $(`${codeToastWrapperId} .toast:first-child`).remove();
    }, 2000);
  }
});
