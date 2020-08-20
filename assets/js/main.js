

function getHtmlAlert(tipo, mensaje){
    return `<div class="alert alert-${tipo}" style="width: 20rem;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${mensaje}
            </div>`
}

function showAlert(tipo, mensaje, divElement){
    divElement.innerHTML= getHtmlAlert(tipo, mensaje)
}
 
 
function validarLogin(){
    let correo= document.getElementById("correo").value;
    let contraseña=document.getElementById("password").value;;

    if(!preg_match("/^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+.([a-zA-Z]{2,4})+$/",correo)){
        showAlert("danger", "El Correo es invalido", document.getElementById("alert"))
    }else if(contraseña.length == 0){
        showAlert("danger", "La contraseña no puede estar vacia", document.getElementById("alert"))
    }else{
        return true
    }
}

function validarUsuario(){
    let correo = document.getElementById("correo").value;
    let contraseña =document.getElementById("contraseña").value;
    let confirmpass = document.getElementById("confirmpass").value;

    if(correo.lenght == 0 || !preg_match("/^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+.([a-zA-Z]{2,4})+$/",correo)){
        showAlert("danger", "El correo es invalido", document.getElementById("alert"))
    }else if(contraseña.length == 0){
        showAlert("danger", "La contraseña no puede estar vacia", document.getElementById("alert"))
    }else if(contraseña !== confirmpass){
        showAlert("danger", "Las contraseñas no coinciden", document.getElementById("alert"))
    }else{
        showAlert("success", "Usuario agregado correctamente", document.getElementById("alert"))        
        return true
    }
}
 
function validarEditarUsuario(){
    let correo = document.getElementById("correo").value;
    let contraseña =document.getElementById("contraseña").value;
    let confirmpass = document.getElementById("confirmpass").value;

    if(correo.length == 0 || !preg_match("/^[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+.([a-zA-Z]{2,4})+$/",correo)){
        showAlert("danger", "El correo es invalido", document.getElementById("alert"))
    }else if(contraseña.length == 0){
        showAlert("danger", "La contraseña no puede estar vacia", document.getElementById("alert"))
    }else if(contraseña !== confirmpass){
        showAlert("danger", "Las contraseñas no coinciden", document.getElementById("alert"))
    }else{
        showAlert("success", "Usuario editado correctamente", document.getElementById("alert"))        
        return true
    }
}

function validacuil(cuil){

    let resultado = 0;
    let digitos = cuil.split("");
    let ultimoDigito = digitos.pop();
 
    for(let i = 0; i < digitos.length; i++) {
        resultado += digitos[9 - i] * (2 + (i % 6));
    }
 
    let digitoVerificador = 11 - (resultado % 11);

    return ultimoDigito == digitoVerificador
}

function validarPersona(){
    let nombre = document.getElementById("apeynom").value;
    let cuil = document.getElementById("cuil").value;
    let edad = document.getElementById("edad").value;
    let localidad = document.getElementById("localidad").value;
    //let cuil= cuilD.replace(/\s/g, "");


    if(nombre.length == 0 || !isNaN(nombre)){
        showAlert("danger", "Ingrese un nombre valido", document.getElementById("alert"));
        return false
      } else if(!validacuil(cuil)){
        showAlert("danger", "El CUIL es invalido", document.getElementById("alert"));
        return false
      } else if(edad.length == 0 || isNaN(edad)){
        showAlert("danger", "Ingrese una edad valida", document.getElementById("alert"));
        return false
      } else if(localidad.length == 0){
        showAlert("danger", "Ingrese una localidad", document.getElementById("alert"));
        return false
      } else {      
        return true
      }
}

function validarAlumno(){
    let persona = document.getElementById("persona").value;

    if(persona == ""){
        showAlert("danger", "No hay o no has seleccionado una persona", document.getElementById("alert"))
        return false
    }else{
        showAlert("success", "Alumno agregado correctamente", document.getElementById("alert"))
        return true
    }
}

function validarEditarAlumno(){
    let persona = document.getElementById("persona").value;

    if(persona == ""){
        showAlert("danger", "El alumno no existe", document.getElementById("alert"))
        return false
    }else{
        return true
    }
}

function validateNumbers(event){
    return (event.charCode >= 48 && event.charCode <= 57);
}

function validateLetters(event){
    return (event.charCode >= 65 && event.charCode <= 122) || event.charCode == 32;
}