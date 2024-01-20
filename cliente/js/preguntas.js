
//CARGA INICIAL PREGUNTAS AL ABRIR VENTANA
window.onload = function(){
    fetch("../../proyecto/API/preguntas.php")
    .then(function(response){
        return response.json()
    })

    //UTILIZANDO TEMPLATE
    .then(function(datos){

        console.log(datos);

        let plantilla = document.getElementById('plantillapregunta');
        let seccion = document.querySelector('section');

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

            fetch("../../proyecto/API/login.php?usuario="+nombre+"&contrasena="+contrasena)
            .then(function(response){
                    return response.json()
            })
            .then(function(datos){

                console.log(datos);

                if(datos.llave == 'si'){
                    document.getElementById('modal').style.display = "none";
                    document.cookie = "usuario=" + nombre + ";";
                }

                window.location = window.location;
            })

           
        }
    }

    

}

function cargaArticuloSeleccionado(identificador){

    document.querySelector('section').innerHTML = "";

    fetch("../../proyecto/API/preguntayrespuestas.php?id="+identificador)
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