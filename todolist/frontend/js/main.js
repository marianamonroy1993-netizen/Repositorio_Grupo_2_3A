// Función para formatear fechas
function formatearFecha(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

// Función para obtener el texto del estado
function obtenerTextoEstado(estado) {
    switch(estado) {
        case 'pending': return 'Pendiente';
        case 'inprogress': return 'En progreso';
        case 'completed': return 'Completado';
        default: return 'Desconocido';
    }
}

// Función para actualizar el tiempo de última actualización
function actualizarTiempoActualizacion(fechaActualizacion) {
    // Implementación simple: mostrar la fecha formateada
    const elemento = document.getElementById('ultimaActualizacion');
    if (elemento) {
        elemento.textContent = formatearFecha(fechaActualizacion);
    }
}

// Función para cargar actividades desde el backend
async function cargarActividades() {
    try {
        const response = await fetch('backend/api/endpoint.php?mostrar_actividades_getmethod=1');
        if (!response.ok) {
            throw new Error('Error al cargar actividades');
        }
        const actividades = await response.json();
        return actividades;
    } catch (error) {
        console.error('Error cargando actividades:', error);
        return [];
    }
}

// Función para mostrar actividades
async function mostrarActividades(activities = null) {
    if (activities === null) {
        activities = await cargarActividades();
    }
    const tbody = document.getElementById('activitiesBody');
    if (!tbody) return; // Si no existe, no hacer nada (para páginas que no tienen tabla)

    tbody.innerHTML = '';

    if (activities.length === 0) {
        const noActivities = document.getElementById('noActivities');
        const activitiesTable = document.getElementById('activitiesTable');
        if (noActivities) noActivities.style.display = 'block';
        if (activitiesTable) activitiesTable.style.display = 'none';
        actualizarEstadisticas(0, 0, 0, 0);
        return;
    }

    const noActivities = document.getElementById('noActivities');
    const activitiesTable = document.getElementById('activitiesTable');
    if (noActivities) noActivities.style.display = 'none';
    if (activitiesTable) activitiesTable.style.display = 'table';

    let pendingCount = 0;
    let inProgressCount = 0;
    let completedCount = 0;

    activities.forEach(activity => {
        const row = document.createElement('tr');

        // Determinar clase de estado
        let statusClass = '';
        let statusText = '';

        switch(activity.estado) {
            case 'pending':
                statusClass = 'status-pending';
                statusText = 'Pendiente';
                pendingCount++;
                break;
            case 'inprogress':
                statusClass = 'status-inprogress';
                statusText = 'En progreso';
                inProgressCount++;
                break;
            case 'completed':
                statusClass = 'status-completed';
                statusText = 'Completado';
                completedCount++;
                break;
        }

        row.innerHTML = `
            <td>${activity.id}</td>
            <td>${activity.actividad}</td>
            <td>${activity.descripcion}</td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
            <td>${formatearFecha(activity.fecha_creacion)}</td>
            <td>${formatearFecha(activity.fecha_actualizacion)}</td>
            <td class="actions">
                <button class="btn btn-success btn-sm" onclick="verActividad(${activity.id})">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" onclick="editarActividad(${activity.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="eliminarActividad(${activity.id})">
                    <i class="fas fa-trash"></i>
                </button>
                <button class="btn btn-secondary btn-sm" onclick="descargarActividad(${activity.id})">
                    <i class="fas fa-download"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });

    actualizarEstadisticas(activities.length, pendingCount, inProgressCount, completedCount);
}

// Función para actualizar estadísticas
function actualizarEstadisticas(total, pending, inProgress, completed) {
    const totalEl = document.getElementById('totalActivities');
    const pendingEl = document.getElementById('pendingCount');
    const inProgressEl = document.getElementById('inProgressCount');
    const completedEl = document.getElementById('completedCount');

    if (totalEl) totalEl.textContent = total;
    if (pendingEl) pendingEl.textContent = pending;
    if (inProgressEl) inProgressEl.textContent = inProgress;
    if (completedEl) completedEl.textContent = completed;
}

// Función para filtrar actividades
async function filtrarActividades() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('filterStatus').value;

    const allActivities = await cargarActividades();
    const filteredActivities = allActivities.filter(activity => {
        const matchesSearch = activity.actividad.toLowerCase().includes(searchTerm) ||
                             activity.descripcion.toLowerCase().includes(searchTerm);
        const matchesStatus = statusFilter === '' || activity.estado === statusFilter;

        return matchesSearch && matchesStatus;
    });

    mostrarActividades(filteredActivities);
}

// Función para ver actividad en modal
async function verActividad(id) {
    try {
        const response = await fetch(`backend/api/endpoint.php?obtener_actividad_getmethod=1&id=${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener actividad');
        }
        const data = await response.json();
        if (data.success) {
            const activity = data.actividad;
            const statusText = obtenerTextoEstado(activity.estado);

            const modalBody = document.getElementById('activityModalBody');
            if (modalBody) {
                modalBody.innerHTML = `
                    <div class="activity-detail">
                        <label>ID:</label>
                        <p>${activity.id}</p>
                    </div>
                    <div class="activity-detail">
                        <label>Actividad:</label>
                        <p>${activity.actividad}</p>
                    </div>
                    <div class="activity-detail">
                        <label>Descripción:</label>
                        <p>${activity.descripcion}</p>
                    </div>
                    <div class="activity-detail">
                        <label>Estado:</label>
                        <p>${statusText}</p>
                    </div>
                    <div class="activity-detail">
                        <label>Fecha de Creación:</label>
                        <p>${formatearFecha(activity.fecha_creacion)}</p>
                    </div>
                    <div class="activity-detail">
                        <label>Fecha de Actualización:</label>
                        <p>${formatearFecha(activity.fecha_actualizacion)}</p>
                    </div>
                `;

                const modal = document.getElementById('activityModal');
                if (modal) modal.style.display = 'flex';
            }
        } else {
            alert('Actividad no encontrada');
        }
    } catch (error) {
        console.error('Error obteniendo actividad:', error);
        alert('Error al cargar la actividad');
    }
}

// Función para cerrar modal
function closeModal() {
    const modal = document.getElementById('activityModal');
    if (modal) modal.style.display = 'none';
}

// Función para editar actividad
function editarActividad(id) {
    // En una implementación real, redirigirías a la página de edición
    window.location.href = `editar_actividad.html?id=${id}`;
}

// Función para eliminar actividad
async function eliminarActividad(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta actividad? Esta acción no se puede deshacer.')) {
        try {
            const formData = new FormData();
            formData.append('eliminar_actividad_deletemethod', '1');
            formData.append('id', id);

            const response = await fetch('backend/api/endpoint.php', {
                method: 'DELETE',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Error al eliminar actividad');
            }

            const data = await response.json();
            if (data.success) {
                alert('Actividad eliminada correctamente');
                await mostrarActividades(); // Recargar la lista
            } else {
                alert('Error al eliminar la actividad');
            }
        } catch (error) {
            console.error('Error eliminando actividad:', error);
            alert('Error al eliminar la actividad');
        }
    }
}

// Función para descargar actividad (placeholder)
function descargarActividad(id) {
    // Implementación pendiente
    alert('Función de descarga no implementada aún');
}

// Función para obtener los detalles de una actividad por su ID
async function obtenerDetallesActividad(idActividad) {
    try {
        const response = await fetch(`../backend/api/endpoint.php?obtener_actividad_getmethod=1&id=${idActividad}`);
        if (!response.ok) {
            throw new Error('Error al obtener los detalles de la actividad');
        }
        const data = await response.json();
        if (data.success) {
            const actividad = data.actividad;

            // Actualizar la interfaz de usuario con los detalles de la actividad
            const actividadTitle = document.getElementById('actividadTitle');
            if (actividadTitle) actividadTitle.textContent = actividad.actividad;

            const actividadEl = document.getElementById('actividad');
            if (actividadEl) actividadEl.textContent = actividad.actividad;

            const descripcionEl = document.getElementById('descripcion');
            if (descripcionEl) descripcionEl.textContent = actividad.descripcion;

            const estadoTexto = obtenerTextoEstado(actividad.estado);
            const estadoBadge = document.getElementById('estadoBadge');
            if (estadoBadge) {
                estadoBadge.textContent = estadoTexto;
                estadoBadge.className = 'status-badge';

                if (actividad.estado === 'pending') {
                    estadoBadge.classList.add('status-pending');
                } else if (actividad.estado === 'inprogress') {
                    estadoBadge.classList.add('status-inprogress');
                } else {
                    estadoBadge.classList.add('status-completed');
                }
            }

            const fechaCreacionEl = document.getElementById('fecha_creacion');
            if (fechaCreacionEl) fechaCreacionEl.textContent = formatearFecha(actividad.fecha_creacion);

            const fechaActualizacionEl = document.getElementById('fecha_actualizacion');
            if (fechaActualizacionEl) fechaActualizacionEl.textContent = formatearFecha(actividad.fecha_actualizacion);

            const activityIdEl = document.getElementById('activityId');
            if (activityIdEl) activityIdEl.textContent = `#${actividad.id.toString().padStart(3, '0')}`;

            // Actualizar el tiempo de última actualización
            actualizarTiempoActualizacion(actividad.fecha_actualizacion);
        } else {
            alert('Actividad no encontrada');
        }
    } catch (error) {
        console.error(error);
        alert('No se pudieron cargar los detalles de la actividad.');
    }
}

// Función auxiliar para obtener el ID desde la URL
function obtenerIdDesdeUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id'); // Asegúrate de que la URL tenga un parámetro 'id'
}

// Event listeners para la página principal
document.addEventListener('DOMContentLoaded', async function() {
    // Verificar si estamos en la página principal (con tabla de actividades)
    const tbody = document.getElementById('activitiesBody');
    if (tbody) {
        await mostrarActividades();

        // Configurar eventos para búsqueda y filtros
        const searchInput = document.getElementById('searchInput');
        if (searchInput) searchInput.addEventListener('input', filtrarActividades);

        const filterStatus = document.getElementById('filterStatus');
        if (filterStatus) filterStatus.addEventListener('change', filtrarActividades);

        // Configurar eventos del modal
        const closeBtn = document.querySelector('.close-btn');
        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        const closeModalBtn = document.getElementById('closeModal');
        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);

        const activityModal = document.getElementById('activityModal');
        if (activityModal) activityModal.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    }

    // Verificar si estamos en la página de detalles
    const idActividad = obtenerIdDesdeUrl();
    if (idActividad) {
        obtenerDetallesActividad(idActividad);
    }
});
