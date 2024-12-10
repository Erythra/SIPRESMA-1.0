
// document.getElementById("loginForm").addEventListener("submit", function (e) {
//   const username = document.getElementById("username").value.trim();
//   const password = document.getElementById("password").value;

//   const errorContainer = document.getElementById("errorContainer");
//   errorContainer.textContent = "";

//   let errorMessages = [];

//   if (username === "" || password === "") {
//     errorMessages.push("Username atau Password harus terisi.");
//   } else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password)) {
//     errorMessages.push(
//       "Password harus terdiri dari huruf besar dan kecil."
//     );
//   }

//   if (errorMessages.length > 0) {
//     e.preventDefault();
//     errorContainer.innerHTML = errorMessages.join("<br>");
//     errorContainer.style.display = "block";
//   }
// });
// const roleButtons = document.querySelectorAll(".btnuser");
// roleButtons.forEach((button) => {
//   button.addEventListener("click", () => {
//     roleButtons.forEach((btn) => btn.classList.remove("active"));
//     button.classList.add("active");
//     console.log("Selected role:", button.textContent);
//   });
// });
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", () => {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  togglePassword.classList.toggle("bi-eye");
  togglePassword.classList.toggle("bi-eye-slash");
});