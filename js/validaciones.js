//Nombres y apellidos : nombre , apellido
function nombre1() { 
    let nombre = document.getElementById("nombre").value;
    let RegEx = /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/g;

    if(nombre.length < 50)
      if (RegEx.test(nombre) == true) {
        document.getElementById("nombre").style.borderColor = "#008000";
      } else {
        document.getElementById("nombre").style.borderColor = "#FF0000";
        Swal.fire({
          icon: 'error',
          title: 'Por Favor',
          text: 'Evite el uso de números y caracteres especiales(" , . ; { } [ ] ")',
          });
          document.getElementById("nombre").value = "";
        return false;
  } else {
      document.getElementById("nombre").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "El nombre es muy largo",
      });
      document.getElementById("nombre").value = "";
    }
}
function apellido1() {
    let apellido = document.getElementById("apellido").value;
    let RegEx = /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/g;

    if (apellido.length < 50)
      if (RegEx.test(apellido) == true) {
        document.getElementById("apellido").style.borderColor = "#008000";
      } else {
        document.getElementById("apellido").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: 'Evite el uso de números y caracteres especiales(" , . ; { } [ ] ")',
        });
        document.getElementById("apellido").value= "";
        return false;
      }
    else {
      document.getElementById("apellido").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "El apellido es muy largo",
      });
      document.getElementById("apellido").value= "";
    }
}

//dirección : dirección
function direccion1() {
    let direccion = document.getElementById("direccion").value;
    let regEx = /^[A-Za-z0-9ñÑAÉÍÓÚáéíóúäëïöüÄËÏÖÜ#./(), -]+$/

    if (direccion.length < 60){
      if (regEx.test(direccion) ){
      document.getElementById("direccion").style.borderColor = "#008000";
      } else {
        document.getElementById("direccion").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: "Ingrese una dirección valida",
        });
        document.getElementById("direccion").value = "";
      }
    } else {
      document.getElementById("direccion").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "Ingrese una dirección valida",
      });
      document.getElementById("direccion").value = "";
    }
}

//teléfonos de 7 o 10 dígitos : teléfono
function telefono1() {
    let telefono = document.getElementById("telefono").value;
    let TelLen = telefono.length;
    let RegEx = /^[+<0-9]+$/g; 

    if (RegEx.test(telefono)){
      if ((TelLen == 7) || (TelLen == 10) || (TelLen == 13)) {
        document.getElementById("telefono").style.borderColor = "#008000";
      } else {
        document.getElementById("telefono").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: "Ingrese números de 7 o 10 dígitos",
        });
        document.getElementById("telefono").value = "";
      }
    }else {
      document.getElementById("telefono").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "Ingrese números de 10 o 7 dígitos",
      });
      document.getElementById("telefono").value = "";
    }
}

//correos en general : correo
function ValidacionCorreo() {
  let correo = document.getElementById("correo").value;
/*   let regex =/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(.[a-zA-Z0-9-]+)*$/;
 */  let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
  
  if (regex.test(correo)) {
    if(correo.length <60 ){
      document.getElementById("correo").style.borderColor = "#008000";
      } else {
      document.getElementById("correo").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: 'Ingrese un correo con menos de 60 dígitos',
      });
      document.getElementById("correo").value = ""
    }
  }else {
    document.getElementById("correo").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: 'Ingrese un correo valido añadiendo "@"',
    });
    document.getElementById("correo").value = ""
  }
}

//Nombres con números incluidos : nombre
function NombresNumeros(){
  let nombre = document.getElementById("nombre").value;
  let RegEx = /^[0-9A-ZÑa-zñáéíóúÁÉÍÓÚ'° -]+$/g;

  if(nombre.length < 50)
    if (RegEx.test(nombre) == true) {
      document.getElementById("nombre").style.borderColor = "#008000";
    } else {
      document.getElementById("nombre").style.borderColor = "#FF0000";
      Swal.fire({
        icon: 'error',
        title: 'Por Favor',
        text: 'Evite el uso de números y caracteres especiales(" , . ; { } [ ] ")',
        });
      document.getElementById("nombre").value = "";
      return false;
  } else {
    document.getElementById("nombre").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "El nombre es muy largo",
    });
    document.getElementById("nombre").value = ""
  }
}

//paginas web : direccion_web
function PaginaWeb(){
    let Pagina = document.getElementById("direccion_web").value;
    let regex = /^[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/;
    
  if (regex.test(Pagina)){
    if (Pagina.length <60){
      document.getElementById("direccion_web").style.borderColor = "#008000";
      }else{document.getElementById("direccion_web").style.borderColor = "#FF0000";
        Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "La direccion web es demasiado larga",
        });
        document.getElementById("direccion_web").value = ""
      }
  }else{
    document.getElementById("direccion_web").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "Ingrese una direccion web valida",
    });
    document.getElementById("direccion_web").value = ""
    }
}

//contraseña con mas de 8 dígitos, una mayúscula, minúscula y números
// : clave
function contraseña(){
    let contraseña = document.getElementById("clave").value;

    if(6 > contraseña.length){
        document.getElementById("clave").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'La contraseña debe tener mas de 6 caracteres'
            });
            document.getElementById("clave").value = "";
    } else if (/[A-Z]+/.test(contraseña) != true){
        document.getElementById("clave").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'La contraseña tiene que tener al menos una mayúscula'
            });
            document.getElementById("clave").value = "";
    } else if (/[a-z]+/.test(contraseña) != true){
        document.getElementById("clave").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'La contraseña tiene que tener al menos una minúscula'
            });
            document.getElementById("clave").value = "";
    } else if (/[0-9]+/.test(contraseña) != true){
        document.getElementById("clave").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'La contraseña tiene que tener al menos un número'
            });
            document.getElementById("clave").value = "";
    }else{
        document.getElementById("clave").style.borderColor = "#008000";
    }
}

//mira si las contraseñas son iguales : clave_c
function verificarContraseña(){
    let contraseña = document.getElementById("clave").value;
    let contraseña_c = document.getElementById("clave_c").value;

    if(contraseña === contraseña_c){
        document.getElementById("clave_c").style.borderColor = "#008000";
        document.getElementById("clave").style.borderColor = "#008000";

    }else{
        Swal.fire({
            title:'Oops..',
            text: 'Las contraseñas no son iguales',
            icon: 'error'
        });
        
        document.getElementById("clave_c").value = "";
        document.getElementById("clave_c").style.borderColor = "#FF0000";

        return false;
    }
}

function Valores1234(){
  let precio = document.getElementById("precio").value;

  if(/^[0-9.]+$/.test(precio) != true){
    document.getElementById("precio").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'El precio debe tener un formato valido, para decimales usar "." '
            });
            document.getElementById("precio").value = "";
  /* }else if(Math.sign(precio) == 1){
    document.getElementById("precio").style.borderColor = "#FF0000";
        Swal.fire({
            icon: 'error',
            title: 'Por Favor',
            text: 'El precio no puede ser negativo'
            });
            document.getElementById("precio").value = ""; */
  }else{
    document.getElementById("precio").style.borderColor = "#008000";
  }
}

function Serial1(){
  let serial = document.getElementById("serial").value;
  let RegEx = /^[0-9A-Za-z]+$/g;

  if(serial.length < 30)
    if (RegEx.test(serial) == true) {
      document.getElementById("serial").style.borderColor = "#008000";
    } else {
      document.getElementById("serial").style.borderColor = "#FF0000";
      Swal.fire({
        icon: 'error',
        title: 'Por Favor',
        text: 'Evite el uso de caracteres especiales(" , . ; { } [ ] ")',
        });
      document.getElementById("serial").value = "";
      return false;
  } else {
    document.getElementById("serial").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "El serial es muy largo",
    });
    document.getElementById("serial").value = "";
  }
}

function Descripciones1(){
  regex = /^[0-9A-ZÑa-zñáéíóúÁÉÍÓÚ'°,." -]+$/;
  description = document.getElementById("descripcion").value;

  if(regex.test(description)){
    document.getElementById("descripcion").style.borderColor = "#008000";
  }else{
    document.getElementById("descripcion").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "La descripción tiene caracteres invalidos o es muy larga",
    });
    document.getElementById("descripcion").value = "";
  }
}

function Cantidad123(){
  regex = /^[0-9]+$/g;
  cantidad= document.getElementById("cantidad").value;

  if (regex.test(cantidad)){
    document.getElementById("cantidad").style.borderColor = "#008000";
  }else{
    document.getElementById("cantidad").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "La cantidad solo acepta números",
    });
    document.getElementById("cantidad").value = "";
  }
}

function Descripciones2(){
  regex = /^[0-9A-ZÑa-zñáéíóúÁÉÍÓÚ'°,." -]+$/;
  description = document.getElementById("descripcion_breve").value;

  if(regex.test(description)){
    document.getElementById("descripcion_breve").style.borderColor = "#008000";
  }else{
    document.getElementById("descripcion_breve").style.borderColor = "#FF0000";
    Swal.fire({
      icon: "error",
      title: "Por Favor",
      text: "La descripción tiene caracteres invalidos o es muy larga",
    });
    document.getElementById("descripcion_breve").value = "";
  }
}

function NIT123(){
  regex = /[0-9]+$/;
  numero = document.getElementById("nit").value;

  if(regex.test(numero)){
    if(numero.length == 10){
      document.getElementById("nit").style.borderColor = "#008000";
    }else{
      document.getElementById("nit").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "El nit no tiene el tamaño correcto (10 dígitos)",
      });
    document.getElementById("nit").value = "";}
  }else {
  document.getElementById("nit").style.borderColor = "#FF0000";
    Swal.fire({
    icon: "error",
    title: "Por Favor",
    text: "El nit solo acepta numeros",
  });
  document.getElementById("nit").value = "";}
}

function cedula1(){
  let cedula = document.getElementById("numero_documento").value;
  let regex = /^[0-9]+$/g;
  let tamaño = cedula.length;

  if(regex.test(cedula)){
    if (7 <= tamaño &&  tamaño <= 11){
      document.getElementById("numero_documento").style.borderColor = "#008000";
    }else{
      document.getElementById("numero_documento").style.borderColor = "#FF0000";
        Swal.fire({
          icon: "error",
          title: "Por Favor",
          text: "La cedula acepta solo numeros entre 7 y 11 digitos",});
          document.getElementById("numero_documento").value = "";
    }
  }else{
    document.getElementById("numero_documento").style.borderColor = "#FF0000";
      Swal.fire({
        icon: "error",
        title: "Por Favor",
        text: "La cedula acepta solo numeros",});
        document.getElementById("numero_documento").value = "";
  }
}