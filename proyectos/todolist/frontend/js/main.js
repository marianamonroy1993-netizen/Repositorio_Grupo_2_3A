function EliminarActividad(){
  $('#formulario_eliminar_actividad').submit(function(e){
    e.preventDefault();
    
    Swal.fire({
      title: '¿Estás seguro?',
      text: "Esta acción no se puede revertir",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../../../backend/api/endpoint.php',
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
                title: '¡Eliminado!',
                text: 'La actividad ha sido eliminada correctamente',
                showConfirmButton: false,
                timer: 1500
              }).then(() => {
                window.location.href = 'index.html';
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al eliminar la actividad',
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
      }
    });
  });
}


function CrearActividad(){
   $('#formulario_crear_actividad').submit(function(e){
     e.preventDefault();
   $.ajax({
     url: '../../../backend/api/endpoint.php',
     type: 'POST',
     dataType: 'json',
     data: {
       crear_actividad_postmethod: true,
       actividad: $('#actividad').val(),
       descripcion: $('#descripcion').val(),
       estado: $('#estado').val(),
       tipo: $('#tipo').val(),
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
 
 
function EditarActividad(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Cargar los datos de la actividad
  $.ajax({
    url: '../../../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#id').val(actividad.id);
        $('#actividad').val(actividad.actividad);
        $('#descripcion').val(actividad.descripcion);
        $('#estado').val(actividad.estado);
        $('#tipo').val(actividad.tipo);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });

  // Manejar el envío del formulario
  $('#formulario_editar_actividad').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '../../../backend/api/endpoint.php',
      type: 'POST',
      dataType: 'json',
      data: {
        editar_actividad_postmethod: true,
        id: $('#id').val(),
        actividad: $('#actividad').val(),
        descripcion: $('#descripcion').val(),
        estado: $('#estado').val(),
        tipo: $('#tipo').val(),
      },
      success: function(data){
        console.log(data);
        if(data.success){
          Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: 'Actividad actualizada correctamente',
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = 'index.html';
          });
        } else {
          Swal.fire({
            icon: 'info',
            title: 'Información',
            text: data.message,
            confirmButtonText: 'Aceptar'
          });
        }
      },
      error: function(error){
        console.log(error);
        Swal.fire({
          icon: 'error',
          title: 'Error de conexión',
          text: 'No se pudo actualizar la actividad',
          confirmButtonText: 'Aceptar'
        });
      }
    });
  });
}

function VerActividad(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Cargar los datos de la actividad
  $.ajax({
    url: '../../../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#actividad').text(actividad.actividad);
        $('#descripcion').text(actividad.descripcion);
        
        // Convertir el estado numérico a texto
        let estadoTexto = '';
    
        $('#estado').text(actividad.estado);
        $('#tipo').text(actividad.tipo);
        $('#fecha_creacion').text(actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });
}

function CargarActividadParaEliminar(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Establecer el ID en el campo oculto
  $('#id').val(id);

  // Cargar los datos de la actividad
  $.ajax({
    url: '../../../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#actividad').text(actividad.actividad);
        $('#descripcion').text(actividad.descripcion);
        
        // Convertir el estado numérico a texto
        let estadoTexto = '';
    
        $('#estado').text(actividad.estado);
        $('#fecha_creacion').text(actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });
}

function MostrarActividad(){
 
      $.ajax({
        url: '../../../backend/api/endpoint.php',
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
            // Convertir el estado numérico a texto
            let estadoTexto = '';
          
            
            tbody.innerHTML += `
            <tr>
              <td>${element.id}</td>
              <td>${element.actividad}</td>
              <td>${element.descripcion}</td>
              <td>${element.estado}</td>
              <td>${element.tipo}</td>
              <td>${element.fecha_de_creacion}</td>
              <td>${element.fecha_de_actualizacion}</td>
              <td><a href="descargar_actividad.html?id=${element.id}" class="btn btn-info">Descargar</a></td>
              <td><a href="ver_actividad.html?id=${element.id}" class="btn btn-info">Ver</a></td>
              <td><a href="editar_actividad.html?id=${element.id}" class="btn btn-warning">Editar</a></td>
              <td><a href="eliminar_actividad.html?id=${element.id}" class="btn btn-danger">Eliminar</a></td>
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

function ImprimirActividad(){
  // Agregar evento al botón de descargar
  $('#descargar_actividad').click(function(e){
    e.preventDefault();
    
    // Obtener el contenido del div a imprimir
    const contenidoOriginal = document.body.innerHTML;
    const contenidoImprimir = document.getElementById('DescargarActividad').innerHTML;
    
    // Guardar el contenido original y reemplazar con el contenido a imprimir
    document.body.innerHTML = contenidoImprimir;
    
    // Imprimir
    window.print();
    
    // Restaurar el contenido original
    document.body.innerHTML = contenidoOriginal;
    
    // Recargar la página para restaurar los eventos
    location.reload();
  });
}