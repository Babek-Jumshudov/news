let btnadd = document.getElementById("add");
let btnclose = document.getElementById("close");
let poupup = document.getElementById("poupup");

btnadd.addEventListener("click", () => {
  poupup.classList.add("active");
});
btnclose.addEventListener("click", () => {
  poupup.classList.remove("active");
});
