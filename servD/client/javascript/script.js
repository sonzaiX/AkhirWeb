const expand_btn = document.querySelector(".expand-btn");
let activeIndex;

expand_btn.addEventListener("click", () => {
  document.body.classList.toggle("collapsed");
});

const current = window.location.href;
const allLinks = document.querySelectorAll(".sidebar-links a");

allLinks.forEach((elem, index) => {
  if (elem.href === current) {
    activeIndex = index;
    elem.classList.add("active");
  }

  elem.addEventListener("click", function () {
    allLinks.forEach((link) => {
      link.classList.remove("active");
    });
    elem.classList.add("active");
  });
});