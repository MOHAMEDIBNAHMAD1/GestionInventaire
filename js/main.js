const link = document.querySelector("#achat");
const modal = document.querySelector("#modal");
const ann = document.querySelector(".ann");

link.addEventListener("click", () => {
  modal.style.opacity = "1";
  modal.style.zIndex = "99999";
});

ann.addEventListener("click", () => {
  modal.style.opacity = "0";
  modal.style.zIndex = "-1";
});
