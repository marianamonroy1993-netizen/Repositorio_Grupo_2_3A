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
          url: '../../../../backend/api/endpoint.php',
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
                window.location.href = 'index.php';
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
      window.location.href = 'index.php';
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
          window.location.href = 'index.php';
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
            window.location.href = 'index.php';
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
      window.location.href = 'index.php';
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

        // Convertir el estado a texto legible
        let estadoTexto = actividad.estado;
        if(actividad.estado.toLowerCase() === 'pendiente') {
          estadoTexto = 'Pendiente';
        } else if(actividad.estado.toLowerCase() === 'en progreso') {
          estadoTexto = 'En Progreso';
        } else if(actividad.estado.toLowerCase() === 'completada') {
          estadoTexto = 'Completada';
        }

        $('#estado').text(estadoTexto);
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
          window.location.href = 'index.php';
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
      window.location.href = 'index.php';
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

        // Convertir el estado a texto legible
        let estadoTexto = actividad.estado;
        if(actividad.estado.toLowerCase() === 'pendiente') {
          estadoTexto = 'Pendiente';
        } else if(actividad.estado.toLowerCase() === 'en progreso') {
          estadoTexto = 'En Progreso';
        } else if(actividad.estado.toLowerCase() === 'completada') {
          estadoTexto = 'Completada';
        }

        $('#estado').text(estadoTexto);
        $('#fecha_creacion').text(actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.php';
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
    const activitiesContainer = document.getElementById('activitiesContainer');
    const noActivitiesMessage = document.getElementById('noActivitiesMessage');

    // Mostrar loading
    activitiesContainer.innerHTML = '<div class="col-12 text-center py-5"><div class="loading"></div><p class="text-muted mt-2">Cargando actividades...</p></div>';

    $.ajax({
        url: '../../../backend/api/endpoint.php',
        type: 'GET',
        dataType: 'json',
        data: {
          mostrar_actividades_getmethod: true
        },
        success: function(data){
            console.log(data);

            if(data.length === 0) {
                activitiesContainer.innerHTML = '';
                noActivitiesMessage.classList.remove('d-none');
                return;
            }

            noActivitiesMessage.classList.add('d-none');
            activitiesContainer.innerHTML = '';

            data.forEach(element => {
                // Determinar clase CSS basada en el estado
                let statusClass = 'pending';
                let statusText = element.estado;
                let statusColor = 'warning';

                if(element.estado.toLowerCase() === 'completada') {
                    statusClass = 'completed';
                    statusColor = 'success';
                } else if(element.estado.toLowerCase() === 'en progreso') {
                    statusClass = 'in-progress';
                    statusColor = 'info';
                }

                // Crear card para cada actividad
                const cardHtml = `
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="activity-card ${statusClass}" data-id="${element.id}">
                            <div class="card-body">
                                <div class="activity-title">
                                    <i class="bi bi-check-circle-fill text-${statusColor} me-2"></i>
                                    ${element.actividad}
                                </div>
                                <div class="activity-description">
                                    ${element.descripcion}
                                </div>
                                <div class="activity-meta">
                                    <span class="status-badge ${statusClass}">${element.estado}</span>
                                    <span class="type-badge">${element.tipo}</span>
                                </div>
                                <div class="activity-actions">
                                    <button class="btn btn-action btn-view" onclick="openViewModal(${element.id})">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-action btn-edit" onclick="openEditModal(${element.id})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-action btn-delete" onclick="openDeleteModal(${element.id}, '${element.actividad}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <a href="descargar_actividad.php?id=${element.id}" class="btn btn-action btn-download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                activitiesContainer.innerHTML += cardHtml;
            });

            // Aplicar filtros iniciales
            applyFilters();
        },
        error: function(error){
            console.log(error);
            activitiesContainer.innerHTML = '<div class="col-12 text-center py-5"><i class="bi bi-exclamation-triangle text-danger fs-1 mb-3"></i><h5 class="text-muted">Error al cargar actividades</h5><p class="text-muted">Por favor, intenta de nuevo más tarde.</p></div>';
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar las actividades',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

// Funciones para abrir modales
function openViewModal(id) {
    // Cargar datos de la actividad
    $.ajax({
        url: '../../../backend/api/endpoint.php',
        type: 'GET',
        dataType: 'json',
        data: {
            obtener_actividad_por_id: true,
            id: id
        },
        success: function(response){
            if(response.success){
                const actividad = response.data;
                $('#viewActividad').text(actividad.actividad);
                $('#viewDescripcion').text(actividad.descripcion);
                $('#viewEstado').removeClass().addClass('badge').addClass(getStatusBadgeClass(actividad.estado)).text(actividad.estado);
                $('#viewTipo').text(actividad.tipo);
                $('#viewFechaCreacion').text(formatDate(actividad.fecha_de_creacion));
                $('#viewFechaActualizacion').text(formatDate(actividad.fecha_de_actualizacion));
                $('#downloadBtn').attr('href', `descargar_actividad.php?id=${id}`);
                $('#viewModal').modal('show');
            }
        },
        error: function(){
            Swal.fire('Error', 'No se pudo cargar la actividad', 'error');
        }
    });
}

function openEditModal(id) {
    // Cargar datos de la actividad
    $.ajax({
        url: '../../../backend/api/endpoint.php',
        type: 'GET',
        dataType: 'json',
        data: {
            obtener_actividad_por_id: true,
            id: id
        },
        success: function(response){
            if(response.success){
                const actividad = response.data;
                $('#editId').val(actividad.id);
                $('#editActividad').val(actividad.actividad);
                $('#editDescripcion').val(actividad.descripcion);
                $('#editEstado').val(actividad.estado);
                $('#editTipo').val(actividad.tipo);
                $('#editModal').modal('show');
            }
        },
        error: function(){
            Swal.fire('Error', 'No se pudo cargar la actividad', 'error');
        }
    });
}

function openDeleteModal(id, actividad) {
    $('#deleteId').val(id);
    $('#deleteActividad').text(actividad);
    $('#deleteModal').modal('show');
}

// Función auxiliar para obtener clase de badge de estado
function getStatusBadgeClass(estado) {
    switch(estado.toLowerCase()) {
        case 'completada': return 'bg-success';
        case 'en progreso': return 'bg-info';
        default: return 'bg-warning';
    }
}

// Función auxiliar para formatear fecha
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Funciones de filtrado
function applyFilters() {
    const estadoFilter = $('#filterEstado').val().toLowerCase();
    const tipoFilter = $('#filterTipo').val().toLowerCase();
    const searchTerm = $('#searchInput').val().toLowerCase();

    $('.activity-card').each(function() {
        const card = $(this);
        const estado = card.find('.status-badge').text().toLowerCase();
        const tipo = card.find('.type-badge').text().toLowerCase();
        const titulo = card.find('.activity-title').text().toLowerCase();
        const descripcion = card.find('.activity-description').text().toLowerCase();

        const matchesEstado = !estadoFilter || estado === estadoFilter;
        const matchesTipo = !tipoFilter || tipo === tipoFilter;
        const matchesSearch = !searchTerm ||
            titulo.includes(searchTerm) ||
            descripcion.includes(searchTerm);

        if (matchesEstado && matchesTipo && matchesSearch) {
            card.parent().show();
        } else {
            card.parent().hide();
        }
    });

    // Verificar si hay actividades visibles
    const visibleCards = $('.activity-card:visible').length;
    const noActivitiesMessage = $('#noActivitiesMessage');

    if (visibleCards === 0 && $('.activity-card').length > 0) {
        if (!noActivitiesMessage.find('.no-filter-results').length) {
            noActivitiesMessage.find('h3').text('No se encontraron actividades');
            noActivitiesMessage.find('p').text('Intenta con otros filtros de búsqueda.');
            noActivitiesMessage.find('button').hide();
            noActivitiesMessage.addClass('no-filter-results');
        }
        noActivitiesMessage.removeClass('d-none');
    } else {
        noActivitiesMessage.addClass('d-none');
    }
}

// Event listeners para filtros
$(document).ready(function() {
    $('#filterEstado, #filterTipo').change(applyFilters);
    $('#searchInput').on('input', applyFilters);
    $('#clearFilters').click(function() {
        $('#filterEstado').val('');
        $('#filterTipo').val('');
        $('#searchInput').val('');
        applyFilters();
    });
});

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
