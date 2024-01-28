
//CARGA INICIAL PREGUNTAS AL ABRIR VENTANA
window.onload = function(){
    cargaPreguntas();

    document.getElementById('iniciarsesion').onclick = function(){
        console.log("Vamos a Iniciar Sesion");
        document.getElementById('modal').style.display = "block";
        document.getElementById('contenedormodal').innerHTML = "";

        let plantilla = document.getElementById('iniciosesion');
        let importado = document.importNode(plantilla.content,true);
        document.getElementById('contenedormodal').appendChild(importado);

        document.getElementById('enviainiciosesion').onclick = function(){
            console.log("Iniciamos Sesion");
            let nombre = document.getElementById('usuario').value;
            let contrasena = document.getElementById('contrasena').value;

            console.log(nombre);
            console.log(contrasena);

            fetch("../../proyectocopia1/API/login.php?usuario="+nombre+"&contrasena="+contrasena)
            .then(function(response){
                    return response.json()
            })
            .then(function(datos){

                console.log(datos);

                if(datos.llave == 'si'){
                    document.getElementById('modal').style.display = "none";
                    document.cookie = "usuario=" + nombre + ";";
                }

                cargaPreguntas();
                window.location = window.location;
            
            })

           
        }
    }

    //P3 PROYECTO
    //Compruebo si se ha iniciado sesion para mostrar o no el boton de incio de sesion
    console.log(valorCookie("usuario"));

    if (valorCookie("usuario") != "" && valorCookie("usuario") != undefined){
        console.log("El usuario existe.");
        let boton = document.getElementById("iniciarsesion");
        boton.innerHTML = "Nueva Pregunta";
        boton.classList.add("botonnuevapregunta");
        //Se quita onclik (=null) para que no vaya a inicio de sesion de nuevo.
        boton.onclick = null;
        boton.setAttribute("id","nuevapregunta");
        boton =  document.getElementById("nuevapregunta");
        boton.onclick = function (){
            console.log("Creamos Nueva Pregunta...");
            let seccion = document.querySelector('section');
            seccion.innerHTML = "";

            let contenedor = document.createElement("div");
            contenedor.classList.add("contenedorinterior");
            //INPUT PARA EL TITULO DE LA PREGUNTA
            let texto = document.createElement("p");
            texto.innerHTML = "Introduce titulo de tu pregunta: ";
            texto.setAttribute("class","textoformpregunta");
            contenedor.appendChild(texto);
            let titulo = document.createElement("input");
            titulo.setAttribute("type","text");
            contenedor.appendChild(titulo);

            //INPUT PARA EL CONTENIDO DE LA PREGUNTA
            texto = document.createElement("p");
            texto.innerHTML = "Contenido de la pregunta: ";
            texto.setAttribute("class","textoformpregunta");
            contenedor.appendChild(texto);
            let textopregunta = document.createElement("textarea");
            contenedor.appendChild(textopregunta);

            //INPUT PARA LAS PALABRAS CLAVE
            texto = document.createElement("p");
            texto.innerHTML = "Palabras Clave: ";
            texto.setAttribute("class","textoformpregunta");
            contenedor.appendChild(texto);
            let palabrasclave = document.createElement("input");
            palabrasclave.setAttribute("type","text");
            contenedor.appendChild(palabrasclave);

            //SELECT CATEGORIA
            texto = document.createElement("p");
            texto.innerHTML = "Elige Categoría: ";
            texto.setAttribute("class","textoformpregunta");
            contenedor.appendChild(texto);
            let categorias = document.createElement("select");
            //SE DECLARAN LAS OPCIONES (EN ESTE CASO 1)
            let opcion = document.createElement("option");
            opcion.setAttribute("value","general");
            opcion.innerHTML= "General";

            //SE APPENDA LA OPCION DENTRO DEL SELECT Y ESTE A SU VEZ EN SECTION
            categorias.appendChild(opcion);
            contenedor.appendChild(categorias);

            let boton = document.createElement("button");
            boton.setAttribute("value","enviar");
            boton.innerHTML = "Enviar";
            contenedor.appendChild(boton);

            boton.onclick = function(){
                console.log("Creamos Nueva Entrada...");

                fetch("../../proyectocopia1/API/nuevapregunta.php?titulo="+titulo.value+"&textopregunta="+textopregunta.value+"&palabrasclave="+palabrasclave.value+"&categorias="+categorias.value)
                .then(function(response){
                    
                    cargaPreguntasCorrecto();
                })
            }

            seccion.appendChild(contenedor);
        }
    }else{
        console.log("El usuario no existe.");
    }
    
    document.querySelector("h1").onclick = function(){
        cargaPreguntas();
    }

    //FIN P3 PROYECTO
}
//CARGA DE UN ARTICULO EN CONCRETO
function cargaArticuloSeleccionado(identificador){

    document.querySelector('section').innerHTML = "";

    fetch("../../proyectocopia1/API/preguntayrespuestas.php?id="+identificador)
    .then(function(response){
        return response.json()
    })

    //UTILIZANDO TEMPLATE
    .then(function(datos){

        console.log(datos);
        //PREGUNTAS
        let plantilla = document.getElementById('plantillapregunta');
        let seccion = document.querySelector('section');
        let pregunta = datos.pregunta[0];
        let importado = document.importNode(plantilla.content,true);
        //SE PASADA IDENTIFICADOR PARA PONER COMO NAME A CADA UNA DE LAS ETIQUETAS HIJAS
        importado.querySelector('article').setAttribute('name',pregunta.identificador);
        importado.querySelector('h3').textContent = pregunta.titulo;
        importado.querySelector('time').textContent = pregunta.fecha;
        importado.querySelector('p').textContent = pregunta.texto;

        seccion.appendChild(importado);

        let cabecerarespuestas = document.getElementById('cabecerarespuestas');
        let importado1 = document.importNode(cabecerarespuestas.content,true);
        importado1.querySelector('p').textContent = "Respuestas Pregunta";
        seccion.appendChild(importado1);

        //RESPUESTA
        let plantilla1 = document.getElementById('plantillarespuesta');
        let respuestas = datos.respuestas;

        console.log(respuestas);
        let contador=0;

        for(let i=0;respuestas.length;i++){

            let importado = document.importNode(plantilla1.content,true);
            //SE PASADA IDENTIFICADOR PARA PONER COMO NAME A CADA UNA DE LAS ETIQUETAS HIJAS
            importado.querySelector('article').setAttribute('name',respuestas[i].identificador);
            importado.querySelector('time').textContent = respuestas[i].fecha;
            importado.querySelector('p').textContent = respuestas[i].texto;
            seccion.appendChild(importado);
            contador++;
        }
        console.log(contador);

        if(contador == 0){
            
            let plantilla2 = document.getElementById('plantillasinresultado');
            let importado2 = document.importNode(plantilla2.content,true);
            importado2.querySelector('p').textContent = "No hay respuestas a esta pregunta";
            seccion.appendChild(importado2);
        }

    })
}

//INICIO P3 PROYECTO
function cargaPreguntas(){
    
    fetch("../../proyectocopia1/API/preguntas.php")
    .then(function(response){
        return response.json()
    })

    //UTILIZANDO TEMPLATE
    .then(function(datos){

        console.log(datos);

        let plantilla = document.getElementById('plantillapregunta');
        let seccion = document.querySelector('section');
        seccion.innerHTML = "";

        for(let i=0;i<datos.length;i++){
            let importado = document.importNode(plantilla.content,true);
            //SE PASADA IDENTIFICADOR PARA PONER COMO NAME A CADA UNA DE LAS ETIQUETAS HIJAS
            importado.querySelector('article').setAttribute('name',datos[i].identificador);
            importado.querySelector('h3').textContent = datos[i].titulo;
            importado.querySelector('time').textContent = datos[i].fecha;
            importado.querySelector('p').textContent = datos[i].texto;

            importado.querySelector('article').onclick = function(){
                let identificador = this.getAttribute('name');

                console.log("Has hecho click en la pregunta con ID: " + identificador);
                console.log(plantilla.content);
                cargaArticuloSeleccionado(identificador);
            }
            seccion.appendChild(importado);
        }
    })
}
function cargaPreguntasCorrecto(){
    fetch("../../proyectocopia1/API/preguntas.php")
    .then(function(response){
        return response.json()
    })

    //UTILIZANDO TEMPLATE
    .then(function(datos){

        console.log(datos);

        let plantilla = document.getElementById('plantillapregunta');
        let seccion = document.querySelector('section');
        seccion.innerHTML = "";

        //AÑADIMOS MENSAJE INSERT CORRECTO
        let correcto = document.createElement("div");
        let mensaje = document.createElement("p");
        correcto.classList.add("insertcorrecto");
        mensaje.innerHTML = "Se ha insertado correctamente la pregunta.";
        correcto.appendChild(mensaje);
        seccion.appendChild(correcto);

        for(let i=0;i<datos.length;i++){
            let importado = document.importNode(plantilla.content,true);
            //SE PASADA IDENTIFICADOR PARA PONER COMO NAME A CADA UNA DE LAS ETIQUETAS HIJAS
            importado.querySelector('article').setAttribute('name',datos[i].identificador);
            importado.querySelector('h3').textContent = datos[i].titulo;
            importado.querySelector('time').textContent = datos[i].fecha;
            importado.querySelector('p').textContent = datos[i].texto;

            importado.querySelector('article').onclick = function(){
                let identificador = this.getAttribute('name');

                console.log("Has hecho click en la pregunta con ID: " + identificador);
                console.log(plantilla.content);
                cargaArticuloSeleccionado(identificador);
            }
            seccion.appendChild(importado);
        }
    })
}
//FIN P3 PROYECTO