function EliminarActividad(){

  $('#formulario_eliminar_actividad').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '../backend/api/endpoint.php',
      type: 'DELETE',
      dataType: 'json',
      data: {
        eliminar_actividad_postmethod: true,
        id: $('#id').val(),
      },
  });
});
}


function CrearActividad(){
   $('#formulario_crear_actividad').submit(function(e){
     e.preventDefault();
   $.ajax({
     url: '../backend/api/endpoint.php',
     type: 'POST',
     dataType: 'json',
     data: {
       crear_actividad_postmethod: true,
       actividad: $('#actividad').val(),
       descripcion: $('#descripcion').val(),
       estado: $('#estado').val(),
     },
     success: function(data){
       console.log(data);
       if(data.success){
         Swal.fire({
           icon: 'success',
           title: '¡Éxito!',
           text: 'Actividad creada correctamente',
           showConfirmButton: false,
           timer: 1500
         }).then(() => {
           $('#formulario_crear_actividad')[0].reset();
           window.location.href = 'index.html';
         });
       } else {
         Swal.fire({
           icon: 'error',
           title: 'Error',
           text: 'Error al crear la actividad',
           confirmButtonText: 'Aceptar'
         });
       }
     },
     error: function(error){
       console.log(error);
       Swal.fire({
         icon: 'error',
         title: 'Error de conexión',
         text: 'No se pudo conectar con el servidor',
         confirmButtonText: 'Aceptar'
       });
     }
   });
 });
 }
 
 
    function MostrarActividad(){
 
       $.ajax({
         url: '../backend/api/endpoint.php',
         type: 'GET',
         dataType: 'json',
         data: {
           mostar_actividades_getmethod: true
         },
         success: function(data){
          console.log(data);
           let tbody= document.querySelector('tbody');
           tbody.innerHTML ='';
           data.forEach(element => {
             tbody.innerHTML += `
             <tr>
               <td>${element.id}</td>
               <td>${element.actividad}</td>
               <td>${element.descripcion}</td>
               <td>${element.estado}</td>
               <td>${element.fecha_de_creacion}</td>
               <td>${element.fecha_de_actualizacion}</td>
               <td><a href="ver_actividad.html?id=${element.id}" class="btn btn-info">Ver</a></td>
               <td><a href="editar_actividad.html?id=${element.id}" class="btn btn-warning">Editar</a></td>
               <td><a href="eliminar_actividad.php?id=${element.id}" class="btn btn-danger">Eliminar</a></td>
             </tr>
           `;
           });
         },
         error: function(error){
           console.log(error);
           Swal.fire({
             icon: 'error',
             title: 'Error',
             text: 'No se pudieron cargar las actividades',
             confirmButtonText: 'Aceptar'
           });
         }
       });
    }