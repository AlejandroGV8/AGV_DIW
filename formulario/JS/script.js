//variables
const btnSignIn = document.getElementById("sign-in");
const btnSignUp = document.getElementById("sign-up");
const formRegister = document.querySelector(".register");
const formLogin = document.querySelector(".login");

btnSignIn.addEventListener("click", e => {
formRegister.classList.add("hide");
formLogin.classList.remove("hide");
})

btnSignUp.addEventListener("click", e => {
formLogin.classList.add("hide");
formRegister.classList.remove("hide");
})


//Variables
// Obtener el elemento del botón de registrar
var btnRegistrar = document.getElementById("registrar");

// Añadir un evento que se ejecute cuando el botón sea presionado
btnRegistrar.addEventListener("click", function() {
// Llamar a la función que verifica las contraseñas
verificarContraseñas();
});

function verificarContraseñas() {
// Obtener los elementos de los campos de contraseña
var contraseña = document.getElementById("contraseña").value;
var contraseña2 = document.getElementById("contraseña2").value;

// Comparar los valores de los campos
if (contraseña !== contraseña2) {
// Si no son iguales, mostrar un mensaje de error
alert("Las contraseñas no coinciden");
} 
}