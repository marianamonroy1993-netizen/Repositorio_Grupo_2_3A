function EliminarActividad() {
    $('#formulario_eliminar_actividad').submit(function(e) {
        e.preventDefault();
        
        const id = $('#id').val();
        
        if(!id) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'ID de actividad no válido'
            });
            return;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../backend/api/endpoint.php',
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        eliminar_actividad_postmethod: true,
                        id: id
                    },
                    success: function(data) {
                        if(data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: data.message || 'Actividad eliminada correctamente',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = 'index.html';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error al eliminar la actividad'
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error de conexión con el servidor'
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
      window.location.href = 'index.html';
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
          window.location.href = 'index.html';
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
        window.location.href = 'index.html';
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
      let tbody = document.querySelector('tbody');
      tbody.innerHTML = '';
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
            <td><button class="btn btn-success" onclick="descargarActividad(${element.id})">Descargar</button></td>
            <td><a href="editar_actividad.html?id=${element.id}" class="btn btn-warning">Editar</a></td>
            <td>
              <form class="eliminar-form" method="post">
                <input type="hidden" name="id" value="${element.id}">
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        `;
      });
      
      // Agregar event listeners a los formularios de eliminación
      document.querySelectorAll('.eliminar-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          const id = this.querySelector('input[name="id"]').value;
          
          Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) { 
              $.ajax({
                url: '../backend/api/endpoint.php',
                type: 'DELETE',
                dataType: 'json',
                data: {
                  eliminar_actividad_postmethod: true,
                  id: id
                },
                success: function(data) {
                  if(data.success) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Éxito',
                      text: data.message || 'Actividad eliminada correctamente',
                      timer: 1500,
                      showConfirmButton: false
                    }).then(() => {
                      MostrarActividad(); // Recargar la tabla
                    });
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: data.message || 'Error al eliminar la actividad'
                    });
                  }
                },
                error: function(error) {
                  console.error('Error:', error);
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión con el servidor'
                  });
                }
              });
            }
          });
        });
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

    function EditarActividad(){
      $('formulario_editar_actividad').submit(function(e){
        e.preventDefault();
      $.ajax({
        url: '../backend/api/endpoint.php',
        type: 'PUT',
        dataType: 'json',
        data: {
          editar_actividad_postmethod: true,  
          id: $('#id').val(),
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
              text: 'Actividad editada correctamente',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              $('#formulario_editar_actividad')[0].reset();
              window.location.href = 'index.html';
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al editar la actividad',
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

    function eliminarActividad(id) {
    if(!id) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de actividad no válido'
        });
        return;
    }

    fetch('../backend/api/endpoint.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            eliminar_actividad_postmethod: 'true',
            id: id
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Error al eliminar'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión'
        });
    });
}

// Nueva función para descargar la actividad como archivo desde el backend
function descargarActividad(id) {
  // Llamar al endpoint que genera el PDF y descargar el blob
  const url = `../backend/api/endpoint.php?descargar_actividad_getmethod=true&id=${encodeURIComponent(id)}`;

  fetch(url, {
    method: 'GET',
    credentials: 'same-origin'
  }).then(async (res) => {
    if (!res.ok) {
      // intentar leer JSON de error
      let txt = await res.text();
      try {
        const json = JSON.parse(txt);
        Swal.fire({ icon: 'error', title: 'Error', text: json.error || 'Error al descargar' });
      } catch (e) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Error al descargar el archivo' });
      }
      return;
    }

    const blob = await res.blob();

    // obtener filename desde header Content-Disposition si está presente
    const cd = res.headers.get('Content-Disposition') || '';
    let filename = 'actividad_' + id + '.pdf';
    const match = cd.match(/filename\*?=(?:UTF-8'')?["']?([^;"']+)/i);
    if (match && match[1]) {
      filename = decodeURIComponent(match[1]);
    }

    const urlBlob = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = urlBlob;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(urlBlob);
  }).catch((err) => {
    console.error(err);
    Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor' });
  });
}

