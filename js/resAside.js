const bar = document.querySelector(".fa-bars");
const aside = document.querySelector("aside");
const elemts = document.querySelectorAll(".mobile");
let mobile = true;

bar.addEventListener("click", () => {
  aside.classList.toggle("aside-mobile");
  if (!aside.classList.contains("aside-mobile")) {
    elemts.forEach((elemt) => {
      elemt.style.opacity = "1";
    });
  } else {
    elemts.forEach((elemt) => {
      elemt.style.opacity = "0";
    });
  }
});
