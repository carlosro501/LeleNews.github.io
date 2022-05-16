
const letrasRegex = /^[a-zA-Z_ ]*$/;
const emailRegex =
    /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
var strongRegex = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
);
var soloNum = /^[0-9]+$/;

function validaRegistro() {

    let valido = false;
    let apellidos = $("#idfullname").val();
    let user = $("#iduser").val();
    let pass = $("#idpass").val();
    let email = $("#idemail").val();
    let telefono = $("#idphone").val();

    if (
        $("#idImg").get(0).files.length === 0 ||
        apellidos.length < 1 ||
        user.length < 1 ||
        pass.length < 1 ||
        email.length < 1
    ) {
        alert("Ingrese datos faltantes");
        console.log("No files selected.");
        return valido;
    } else if (!letrasRegex.test(apellidos)) {
        alert('Ingrese nombre y/o apellido valido')
        console.log("Nombre y/o apellido no válido");
        return valido;
    } else if (!emailRegex.test(email)) {
        alert('Ingrese email valido');
        console.log("Email no válido");
        return valido;
    } else if (!soloNum.test(telefono)) {
        alert("No ingreso números");
        console.log("No ingreso números");
        return valido;
    } else if (!strongRegex.test(pass)) {
        alert('Ingrese contraseña valida');
        console.log("Contraseña no válida");
        return valido;
    } else {
        valido = true;
        return valido;
    }
}

function validaSesion() {
    let email = $("#idEmail").val();
    let pass = $("#idPassword").val();
    let valido = false;

    if (email.length < 1 || pass.length < 1) {
        alert('Ingrese datos faltantes')
        console.log("Ingrese usuario y/o contraseña");
        return valido;
    } else if (!emailRegex.test(email)) {
        alert('Ingrese email valido');
        console.log("Email no válido");
        return valido;
    } else if (!strongRegex.test(pass)) {
        alert('Ingrese contraseña valida');
        console.log("Contraseña no válida");
        return valido;
    }
    else {
        valido = true;
        return valido;
    }
}
