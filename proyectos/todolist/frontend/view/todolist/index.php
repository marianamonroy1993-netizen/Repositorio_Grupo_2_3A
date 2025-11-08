<!DOCTYPE html>
<html lang="es">
<<<<<<< Updated upstream
      <head>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo List</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../../css/bootstrap-5.3.8-dist/css/bootstrap.min.css">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

<?php include '../componet/head.php'; ?>
<?php include '../componet/nav.php'; ?>
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>
<?php include '../component/head.php'; ?>
<?php include '../component/nav.php'; ?>
>>>>>>> Stashed changes

    <body>
        <div class="container cont_todolist">
            <h1 class="text-center">LISTAS DE ACTIVIDADES  <?php echo $_SESSION['nombre']; ?></h1>
         <a href="crear_actividad.php" class="btn btn-primary">Agregar Actividad</a>
        <div class="table-responsive">
            <table class="table table-dark table-striped" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Actividad</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                    <th>Descargar</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                
            </thead>
            <tbody>
              
            </tbody>
            </table>
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
        
    