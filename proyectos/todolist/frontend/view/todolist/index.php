<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo List</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/bootstrap-5.3.8-dist/css/bootstrap.min.css">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

<?php include '../component/head.php'; ?>
<?php include '../component/nav.php'; ?>

    <body class="bg-light">
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="text-primary fw-bold mb-0">
                            <i class="bi bi-check2-square-fill me-2"></i>
                            Mis Actividades - <?php echo $_SESSION['nombre']; ?>
                        </h1>
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bi bi-plus-circle me-2"></i>Agregar Actividad
                        </button>
                    </div>

                    <!-- Filtros -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select class="form-select" id="filterEstado">
                                        <option value="">Todos los Estados</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En Progreso">En Progreso</option>
                                        <option value="Completada">Completada</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="filterTipo">
                                        <option value="">Todos los Tipos</option>
                                        <option value="Trabajo">Trabajo</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Estudio">Estudio</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar actividades...">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-secondary w-100" id="clearFilters">
                                        <i class="bi bi-x-circle me-1"></i>Limpiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de actividades -->
                    <div id="activitiesContainer" class="row g-4">
                        <!-- Las actividades se cargarán aquí dinámicamente -->
                    </div>

                    <!-- Mensaje cuando no hay actividades -->
                    <div id="noActivitiesMessage" class="text-center py-5 d-none">
                        <div class="empty-state">
                            <i class="bi bi-clipboard-x display-1 text-muted mb-3"></i>
                            <h3 class="text-muted">No tienes actividades aún</h3>
                            <p class="text-muted">¡Crea tu primera actividad para comenzar!</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus-circle me-2"></i>Crear Primera Actividad
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Crear Actividad -->
        <div class="modal fade" id="createModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i>Nueva Actividad
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formulario_crear_actividad">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="actividad" class="form-label fw-semibold">Nombre de la Actividad</label>
                                    <input type="text" class="form-control" id="actividad" name="actividad" required>
                                </div>
                                <div class="col-12">
                                    <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="estado" class="form-label fw-semibold">Estado</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="">Seleccionar Estado</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En Progreso">En Progreso</option>
                                        <option value="Completada">Completada</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tipo" class="form-label fw-semibold">Tipo</label>
                                    <select class="form-select" id="tipo" name="tipo" required>
                                        <option value="">Seleccionar Tipo</option>
                                        <option value="Trabajo">Trabajo</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Estudio">Estudio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Crear Actividad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ver Actividad -->
        <div class="modal fade" id="viewModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-eye me-2"></i>Detalles de la Actividad
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <h4 id="viewActividad" class="text-primary"></h4>
                            </div>
                            <div class="col-12">
                                <p id="viewDescripcion" class="mb-3"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-flag-fill fs-1 text-warning mb-2"></i>
                                        <h6 class="card-title">Estado</h6>
                                        <span id="viewEstado" class="badge fs-6"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-tag-fill fs-1 text-success mb-2"></i>
                                        <h6 class="card-title">Tipo</h6>
                                        <span id="viewTipo" class="badge fs-6 bg-success"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-calendar-plus fs-1 text-primary mb-2"></i>
                                        <h6 class="card-title">Fecha de Creación</h6>
                                        <p id="viewFechaCreacion" class="mb-0 fw-semibold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-calendar-check fs-1 text-secondary mb-2"></i>
                                        <h6 class="card-title">Última Actualización</h6>
                                        <p id="viewFechaActualizacion" class="mb-0 fw-semibold"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a id="downloadBtn" href="#" class="btn btn-success">
                            <i class="bi bi-download me-2"></i>Descargar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Actividad -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil-square me-2"></i>Editar Actividad
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formulario_editar_actividad">
                        <input type="hidden" id="editId" name="id">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="editActividad" class="form-label fw-semibold">Nombre de la Actividad</label>
                                    <input type="text" class="form-control" id="editActividad" name="actividad" required>
                                </div>
                                <div class="col-12">
                                    <label for="editDescripcion" class="form-label fw-semibold">Descripción</label>
                                    <textarea class="form-control" id="editDescripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="editEstado" class="form-label fw-semibold">Estado</label>
                                    <select class="form-select" id="editEstado" name="estado" required>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En Progreso">En Progreso</option>
                                        <option value="Completada">Completada</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editTipo" class="form-label fw-semibold">Tipo</label>
                                    <select class="form-select" id="editTipo" name="tipo" required>
                                        <option value="Trabajo">Trabajo</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Estudio">Estudio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-2"></i>Actualizar Actividad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar Actividad -->
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle me-2"></i>Eliminar Actividad
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formulario_eliminar_actividad">
                        <input type="hidden" id="deleteId" name="id">
                        <div class="modal-body text-center">
                            <i class="bi bi-question-circle fs-1 text-danger mb-3"></i>
                            <h5>¿Estás seguro de eliminar esta actividad?</h5>
                            <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
                            <div class="alert alert-warning mt-3">
                                <strong>Actividad:</strong> <span id="deleteActividad"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
    <?php include '../component/footer.php'; ?>
    
    <script src="../../js/jquery-3.7.1.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            MostrarActividad();
        });
    </script>
    </body>
</html>
        
    