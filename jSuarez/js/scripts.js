const validarSignIn = () => {
    const nombre = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;
    const parrafo = document.createElement("P");
    const seccion = document.getElementById("seccion-form");

    const mostrarError = (mensaje) => {
        parrafo.textContent = mensaje;
        parrafo.style.color = "red";
        parrafo.style.fontSize = "1.5rem";
        seccion.appendChild(parrafo);
        setTimeout(function(){
            parrafo.remove();
        },3000);
    }

    if(nombre === ""){
        mostrarError("Usuario incompleto");
       
        return false;
    }

    if(password === ""){
        mostrarError("Contraseña incompleta");
        return false;
    }

    // Expresión para detectar caracteres o patrones de inyección SQL
    const invalidPattern = /['";=\-\-#]|\b(or|and|select|drop|insert|delete|update|exec)\b/i;

    
    if (invalidPattern.test(nombre)) {
        mostrarError("Usuario contiene caracteres o palabras no permitidas");
        return false;
    }

    
    if (invalidPattern.test(password)) {
        mostrarError("Contraseña contiene caracteres o palabras no permitidas");
        return false;
    }

    return true;
} 

const validarRegistrar = () =>{
    const nombre = document.getElementById("nombre").value;
    const apellidos = document.getElementById("apellidos").value;
    const email = document.getElementById("email").value;
    const direccion = document.getElementById("direccion").value;
    const colonia = document.getElementById("colonia").value;
    const ciudad = document.getElementById("ciudad").value;
    const estado = document.getElementById("estado").value;
    const pais = document.getElementById("pais").value;
    const cp = document.getElementById("c.p").value;
    const usuario = document.getElementById("nombre_usuario").value;
    const password = document.getElementById("password").value;
    
    if(nombre === ""){
        alert("Nombre incompleto");
        return false;
    }
    if(apellidos === ""){
        alert("Apellidos incompletos");
        return false;
    }
    if(email === ""){
        alert("Email incompleto");
        return false;
    }
    if(direccion === ""){
        alert("Direccion incompleta");
        return false;
    }
    if(colonia === ""){
        alert("Colonia incompleta");
        return false;
    }
    if(ciudad === ""){
        alert("Ciudad incompleta");
        return false;
    }
    if(estado === ""){
        alert("Estado incompleto");
        return false;
    }
    if(pais === ""){
        alert("Pais incompleto");
        return false;
    }
    if(cp === ""){
        alert("Codigo postal incompleto");
        return false;
    }
    if(usuario === ""){
        alert("Usuario incompleto");
        return false;
    }
    if(password === ""){
        alert("Contraseña incompleta");
        return false;
    }

    const valor = email.trim();

    const regexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,63}$/;

    if (!regexEmail.test(valor)) {
        alert("Por favor ingresa un correo electrónico válido.");
        return false;
    }
    return true;
}

const mostrarUsername = (usr,rol) => {
        const botonSignIn = document.querySelector(".session a");
        const session = document.querySelector(".session");
        botonSignIn.remove();
        const nombreUsuario = document.createElement("P");

        const hora = new Date().getHours();
        //console.log(hora);
        if(hora >= 0 && hora < 12)
            nombreUsuario.textContent = "Buenos Días, " + usr;
        else if(hora >= 12 && hora < 18)
            nombreUsuario.textContent = "Buenas Tardes, " + usr;
        else
            nombreUsuario.textContent = "Buenas Noches, " + usr;

        
        if(rol === "root"){
            nombreUsuario.style.color = "darkgoldenrod";
            nombreUsuario.style.fontSize = "2rem";
        }
        nombreUsuario.style.fontSize = "1.6rem";
        nombreUsuario.classList.add("nombre-usuario");
        session.appendChild(nombreUsuario);
}

const mostrarBotonLogOut = () => {
    const session = document.querySelector(".session");
    const botonLogOut = document.createElement("A");
    botonLogOut.textContent = "Cerrar Sesión";
    botonLogOut.classList.add("boton");
    botonLogOut.classList.add("boton-log-out");
    session.classList.add("session-logOut");
    botonLogOut.href = "logOut.php";
    session.appendChild(botonLogOut);
    session.innerHTML += `
    <a href='configUser.php' style='text-decoration:none;'><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="black"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg></a>
        `;
}

//const printTable = () => window.print();
  
const exportarXcel = () => {
    const wb = XLSX.utils.table_to_book(
      document.getElementById('miTabla'),
      { sheet: 'Datos' }
    );
    XLSX.writeFile(wb, 'tabla.xlsx');
  };
  
