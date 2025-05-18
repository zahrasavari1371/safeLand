$(document).ready(function () {
  new Quill("#rich-text-editor", {
    theme: "snow",
    toolbar: [
      ["bold", "italic", "underline", "strike"],
      ["blockquote", "code-block"],
      [{ header: 1 }, { header: 2 }],
      [{ list: "ordered" }, { list: "bullet" }],
      [{ size: ["small", false, "large", "huge"] }],
      [{ align: [] }],
      ["link", "image"],
    ],
  });
});
