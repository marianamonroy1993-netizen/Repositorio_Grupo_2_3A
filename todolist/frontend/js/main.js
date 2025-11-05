function EliminarActividad(){

  $('#formulario_eliminar_actividad').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '../backend/api/endpoint.php',
      type: 'DELETE',
      dataType: 'json',
      data: {
        eliminar_actividad_deletemethod: true,
        id: $('#id').val(),
      },
      success: function(data){
        console.log(data);
        if(data.success){
          Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: data.message || 'Actividad eliminada',
            timer: 1200,
            showConfirmButton: false
          }).then(() => { window.location.href = 'index.php'; });
        } else {
          Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'No se pudo eliminar' });
        }
      },
      error: function(err){
        console.log(err);
        Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor' });
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
         window.location.href = 'index.php';
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
 
 
    function obtenerDetallesActividad() {
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');

  if (!id) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó ID de actividad',
      confirmButtonText: 'Volver',
      allowOutsideClick: false
    }).then((result) => {
      window.location.href = 'index.php';
    });
    return;
  }

  $.ajax({
    url: '../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_getmethod: true,
      id: id
    },
    success: function(data) {
      if (data.success && data.actividad) {
        $('#actividad').text(data.actividad.actividad);
        $('#descripcion').text(data.actividad.descripcion);
        $('#estado').text(data.actividad.estado);
        $('#fecha_creacion').text(data.actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(data.actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se encontró la actividad',
          confirmButtonText: 'Volver',
          allowOutsideClick: false
        }).then((result) => {
          window.location.href = 'index.php';
        });
      }
    },
    error: function(error) {
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo conectar con el servidor',
        confirmButtonText: 'Volver',
        allowOutsideClick: false
      }).then((result) => {
        window.location.href = 'index.php';
      });
    }
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