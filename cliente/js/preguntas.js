
//CARGA INICIAL PREGUNTAS AL ABRIR VENTANA
window.onload = function(){
    fetch("../../proyecto/API/preguntas.php")
    .then(function(response){
        return response.json()
    })
    //UTILIZANDO TEMPLATE
    .then(function(datos){

        let plantilla = document.getElementById('plantillapregunta');
        let seccion = document.querySelector('section');

        for(let i=0;i<datos.length;i++){
            let importado = document.importNode(plantilla.content,true);
            importado.querySelector('h3').textContent = datos[i].titulo;
            importado.querySelector('time').textContent = datos[i].fecha;
            importado.querySelector('p').textContent = datos[i].texto;
            seccion.appendChild(importado);
        }
    })

}