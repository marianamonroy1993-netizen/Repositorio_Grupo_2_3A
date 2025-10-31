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
        
        document.addEventListener('DOMContentLoaded', async function() {
            await mostrarActividades();

            // Configurar eventos para búsqueda y filtros
            document.getElementById('searchInput').addEventListener('input', filtrarActividades);
            document.getElementById('filterStatus').addEventListener('change', filtrarActividades);

            // Configurar eventos del modal
            document.querySelector('.close-btn').addEventListener('click', closeModal);
            document.getElementById('closeModal').addEventListener('click', closeModal);
            document.getElementById('activityModal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
        });
        
        async function mostrarActividades(activities = null) {
            if (activities === null) {
                activities = await cargarActividades();
            }
            const tbody = document.getElementById('activitiesBody');
            tbody.innerHTML = '';
            
            if (activities.length === 0) {
                document.getElementById('noActivities').style.display = 'block';
                document.getElementById('activitiesTable').style.display = 'none';
                actualizarEstadisticas(0, 0, 0, 0);
                return;
            }
            
            document.getElementById('noActivities').style.display = 'none';
            document.getElementById('activitiesTable').style.display = 'table';
            
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
                    <td>${formatDate(activity.fecha_creacion)}</td>
                    <td>${formatDate(activity.fecha_actualizacion)}</td>
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
        
        function actualizarEstadisticas(total, pending, inProgress, completed) {
            document.getElementById('totalActivities').textContent = total;
            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('inProgressCount').textContent = inProgress;
            document.getElementById('completedCount').textContent = completed;
        }
        
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
        
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
        
        async function verActividad(id) {
            try {
                const response = await fetch(`backend/api/endpoint.php?obtener_actividad_getmethod=1&id=${id}`);
                if (!response.ok) {
                    throw new Error('Error al obtener actividad');
                }
                const data = await response.json();
                if (data.success) {
                    const activity = data.actividad;
                    let statusText = '';
                    switch(activity.estado) {
                        case 'pending': statusText = 'Pendiente'; break;
                        case 'inprogress': statusText = 'En progreso'; break;
                        case 'completed': statusText = 'Completado'; break;
                    }

                    document.getElementById('activityModalBody').innerHTML = `
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
                            <p>${formatDate(activity.fecha_creacion)}</p>
                        </div>
                        <div class="activity-detail">
                            <label>Fecha de Actualización:</label>
                            <p>${formatDate(activity.fecha_actualizacion)}</p>
                        </div>
                    `;

                    document.getElementById('activityModal').style.display = 'flex';
                } else {
                    alert('Actividad no encontrada');
                }
            } catch (error) {
                console.error('Error obteniendo actividad:', error);
                alert('Error al cargar la actividad');
            }
        }
        
        function closeModal() {
            document.getElementById('activityModal').style.display = 'none';
        }
        
        function editarActividad(id) {
            
            // En una implementación real, redirigirías a la página de edición
             window.location.href = `editar_actividad.html?id=${id}`;
        }
        
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
        

        