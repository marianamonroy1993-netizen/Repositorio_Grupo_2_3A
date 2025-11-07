<!DOCTYPE html>
<html lang="es">
<?php include '../componet/head.php'; ?>
<body>
<?php include '../componet/nav.php'; ?>

<!-- Hero Section - Landing Page -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <div class="row align-items-center min-vh-80">
      <div class="col-lg-7 text-white hero-text">
        <span class="badge bg-primary mb-3 px-4 py-2 fs-6 animate-fade-in">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-fill me-2" viewBox="0 0 16 16">
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
          </svg>
          Organiza tu vida, simplifica tus días
        </span>
        
        <h1 class="display-2 fw-bold mb-4 animate-slide-up">
          Las Tareas Son
          <span class="text-primary d-block">En Casa</span>
        </h1>
        
        <p class="lead mb-5 fs-4 animate-slide-up-delay">
          Gestiona tus actividades diarias de manera eficiente y mantén el control 
          de todo lo que necesitas hacer. Simple, rápido y efectivo.
        </p>
        
        <div class="d-flex gap-3 flex-wrap animate-slide-up-delay-2">
          <a href="../todolist/crear_actividad.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Crear Tarea
          </a>
          <a href="../todolist/index.php" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-check me-2" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
            </svg>
            Ver Mis Tareas
          </a>
        </div>
      </div>
      
  
  
 
</section>

<!-- Features Section -->
<section class="features-section py-5 bg-light">
  <div class="container py-5">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bold mb-3">¿Por qué elegir nuestro Todo List?</h2>
      <p class="lead text-muted">Características diseñadas para hacer tu vida más fácil</p>
    </div>
    
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-lightning-charge" viewBox="0 0 16 16">
                <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
              </svg>
            </div>
            <h4 class="mb-3">Rápido y Eficiente</h4>
            <p class="text-muted">Crea, edita y completa tus tareas en segundos. Interfaz intuitiva y fácil de usar.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="feature-card card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="feature-icon bg-success bg-gradient text-white rounded-circle mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
              </svg>
            </div>
            <h4 class="mb-3">Seguro y Confiable</h4>
            <p class="text-muted">Tus tareas están seguras y siempre disponibles cuando las necesites.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="feature-card card h-100 border-0 shadow-sm">
          <div class="card-body text-center p-4">
            <div class="feature-icon bg-warning bg-gradient text-white rounded-circle mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
              </svg>
            </div>
            <h4 class="mb-3">Responsive</h4>
            <p class="text-muted">Accede desde cualquier dispositivo: móvil, tablet o computadora.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="cta-section py-5 bg-primary text-white">
  <div class="container py-5 text-center">
    <h2 class="display-5 fw-bold mb-3">¿Listo para organizar tus tareas?</h2>
    <p class="lead mb-4">Comienza ahora y descubre lo fácil que es mantener el control</p>
    <a href="../todolist/crear_actividad.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow">
      Empezar Gratis
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
      </svg>
    </a>
  </div>
</section>

<?php include '../componet/footer.php'; ?>

<!-- Custom Styles -->
<style>
 
</style>

</body>
</html>