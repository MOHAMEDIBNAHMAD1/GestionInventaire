const btns = document.querySelectorAll(".voir");
const modals = document.querySelectorAll(".voir-prod");
const closes = document.querySelectorAll(".fa-times");

console.log(btns);
console.log(modals);
for (let i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", () => {
    modals[i].style.opacity = "1";
    modals[i].style.zIndex = "999";
  });
  closes[i].addEventListener("click", () => {
    modals[i].style.opacity = "0";
    modals[i].style.zIndex = "-1";
  });
}
