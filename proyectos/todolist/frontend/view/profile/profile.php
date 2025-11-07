<!DOCTYPE html>
<html lang="es">
<?php include '../componet/head.php'; ?>
<body>
<?php include '../componet/nav.php'; ?>

<!-- Hero Section - Register -->
<section class="hero-section-register">
  <div class="register-overlay"></div>
  <div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
  </div>
  
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-95">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="register-card card shadow-lg border-0">
          <div class="card-body p-5">
            <!-- Header -->
            <div class="text-center mb-4">
              <div class="register-icon mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-plus-fill text-primary" viewBox="0 0 16 16">
                  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
              </div>
              <h2 class="fw-bold mb-2">Crear Cuenta</h2>
              <p class="text-muted">Únete a Todo List y organiza tu vida</p>
            </div>

            <!-- Formulario -->
            <form id="formulario_registro" action="" method="POST">
              <div class="row">
                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                  <label for="nombre" class="form-label fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                    Nombre
                  </label>
                  <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Juan" required>
                </div>

                <!-- Apellido -->
                <div class="col-md-6 mb-3">
                  <label for="apellido" class="form-label fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                    Apellido
                  </label>
                  <input type="text" class="form-control form-control-lg" id="apellido" name="apellido" placeholder="Pérez" required>
                </div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope me-2" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                  </svg>
                  Correo Electrónico
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-at text-muted" viewBox="0 0 16 16">
                      <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                    </svg>
                  </span>
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
              </div>

              <!-- Usuario -->
              <div class="mb-3">
                <label for="usuario" class="form-label fw-semibold">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge me-2" viewBox="0 0 16 16">
                    <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                  </svg>
                  Nombre de Usuario
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle text-muted" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                  </span>
                  <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="juanperez" required>
                </div>
                <small class="text-muted">Solo letras, números y guión bajo</small>
              </div>

              <div class="row">
                <!-- Contraseña -->
                <div class="col-md-6 mb-3">
                  <label for="password" class="form-label fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock me-2" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                    Contraseña
                  </label>
                  <div class="input-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="••••••••" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eyeIcon">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                      </svg>
                    </button>
                  </div>
                  <small class="text-muted">Mínimo 8 caracteres</small>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="col-md-6 mb-3">
                  <label for="confirmar_password" class="form-label fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill me-2" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                    Confirmar
                  </label>
                  <div class="input-group">
                    <input type="password" class="form-control form-control-lg" id="confirmar_password" name="confirmar_password" placeholder="••••••••" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eyeIconConfirm">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Password Strength Indicator -->
              <div class="mb-3">
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%"></div>
                </div>
                <small class="text-muted" id="passwordStrengthText">Ingresa una contraseña</small>
              </div>

              <!-- Términos y Condiciones -->
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terminos" name="terminos" required>
                  <label class="form-check-label" for="terminos">
                    Acepto los <a href="#" class="text-primary">Términos y Condiciones</a> y la <a href="#" class="text-primary">Política de Privacidad</a>
                  </label>
                </div>
              </div>

              <!-- Botón de Registro -->
              <button type="submit" class="btn btn-primary btn-lg w-100 mb-3 btn-register">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check me-2" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                  <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                </svg>
                Crear Cuenta
              </button>

              <!-- Divider -->
              <div class="divider-text">
                <span>O regístrate con</span>
              </div>

              <!-- Social Register -->
              <div class="row g-2 mb-4">
                <div class="col-6">
                  <button type="button" class="btn btn-outline-dark w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                      <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                    </svg>
                    Google
                  </button>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-outline-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-facebook me-2" viewBox="0 0 16 16">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                    Facebook
                  </button>
                </div>
              </div>

              <!-- Login -->
              <div class="text-center">
                <p class="mb-0">¿Ya tienes una cuenta? <a href="Login.php" class="text-primary fw-semibold text-decoration-none">Inicia sesión aquí</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../componet/footer.php'; ?>

<!-- Custom Styles -->
<style>
  /* Hero Section Register */
  .hero-section-register {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 80px 0;
  }
  
  .register-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><path d="M0,200 Q300,100 600,200 T1200,200 L1200,600 L0,600 Z" fill="rgba(255,255,255,0.05)"/></svg>') no-repeat bottom;
    background-size: cover;
  }
  
  .min-vh-95 {
    min-height: 95vh;
  }
  
  /* Register Card */
  .register-card {
    border-radius: 20px;
    backdrop-filter: blur(10px);
    animation: slideUpCard 0.6s ease-out;
    position: relative;
    z-index: 10;
  }
  
  @keyframes slideUpCard {
    from {
      opacity: 0;
      transform: translateY(50px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .register-icon {
    animation: fadeInIcon 0.8s ease-out 0.3s backwards;
  }
  
  @keyframes fadeInIcon {
    from {
      opacity: 0;
      transform: scale(0.5) rotate(-180deg);
    }
    to {
      opacity: 1;
      transform: scale(1) rotate(0deg);
    }
  }
  
  /* Form Styles */
  .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
  }
  
  .input-group-text {
    background-color: #f8f9fa;
  }
  
  .input-group:focus-within .input-group-text {
    border-color: #667eea;
  }
  
  /* Button Register */
  .btn-register {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s ease;
    font-weight: 600;
    padding: 12px;
  }
  
  .btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
  }
  
  /* Password Strength */
  .progress {
    background-color: #e9ecef;
  }
  
  .progress-bar {
    transition: all 0.3s ease;
  }
  
  /* Divider */
  .divider-text {
    position: relative;
    text-align: center;
    margin: 25px 0;
  }
  
  .divider-text::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #dee2e6;
  }
  
  .divider-text span {
    position: relative;
    background-color: white;
    padding: 0 15px;
    color: #6c757d;
    font-size: 0.9rem;
  }
  
  /* Social Buttons */
  .btn-outline-dark:hover,
  .btn-outline-primary:hover {
    transform: translateY(-2px);
  }
  
  /* Floating Shapes */
  .floating-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: 1;
  }
  
  .shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 8s ease-in-out infinite;
  }
  
  @keyframes float {
    0%, 100% {
      transform: translateY(0px) rotate(0deg);
    }
    50% {
      transform: translateY(-30px) rotate(180deg);
    }
  }
  
  .shape-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 5%;
    animation-delay: 0s;
  }
  
  .shape-2 {
    width: 150px;
    height: 150px;
    top: 50%;
    right: 5%;
    animation-delay: 2s;
  }
  
  .shape-3 {
    width: 80px;
    height: 80px;
    bottom: 10%;
    left: 60%;
    animation-delay: 4s;
  }
  
  .shape-4 {
    width: 120px;
    height: 120px;
    top: 70%;
    left: 10%;
    animation-delay: 6s;
  }
  
  /* Form Check */
  .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
  }
  
  /* Links */
  a {
    transition: all 0.3s ease;
  }
  
  a:hover {
    opacity: 0.8;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .hero-section-register {
      padding: 40px 0;
    }
    
    .register-card .card-body {
      padding: 2rem !important;
    }
    
    .btn-lg {
      padding: 10px !important;
    }
    
    .col-md-6 {
      margin-bottom: 0 !important;
    }
  }
</style>

<script>
  // Optimized: Prevent multiple event listener bindings and improve performance
  (function() {
    'use strict';
    
    // Toggle Password Visibility Helper
    function togglePasswordVisibility(input, icon) {
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>';
      } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>';
      }
    }
    
    // Toggle Password - Prevent duplicate bindings
    const toggleBtn = document.getElementById('togglePassword');
    if (toggleBtn && !toggleBtn.dataset.initialized) {
      toggleBtn.dataset.initialized = 'true';
      toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        togglePasswordVisibility(passwordInput, eyeIcon);
      });
    }

    const toggleConfirmBtn = document.getElementById('toggleConfirmPassword');
    if (toggleConfirmBtn && !toggleConfirmBtn.dataset.initialized) {
      toggleConfirmBtn.dataset.initialized = 'true';
      toggleConfirmBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const confirmPasswordInput = document.getElementById('confirmar_password');
        const eyeIconConfirm = document.getElementById('eyeIconConfirm');
        togglePasswordVisibility(confirmPasswordInput, eyeIconConfirm);
      });
    }

    // Password Strength Checker - Optimized with debounce
    const passwordInput = document.getElementById('password');
    if (passwordInput && !passwordInput.dataset.initialized) {
      passwordInput.dataset.initialized = 'true';
      
      let debounceTimer;
      passwordInput.addEventListener('input', function() {
        // Debounce for better performance
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
          const password = this.value;
          const strengthBar = document.getElementById('passwordStrength');
          const strengthText = document.getElementById('passwordStrengthText');
          
          let strength = 0;
          let text = '';
          let color = '';
          
          if (password.length >= 8) strength += 25;
          if (password.match(/[a-z]+/)) strength += 25;
          if (password.match(/[A-Z]+/)) strength += 25;
          if (password.match(/[0-9]+/)) strength += 15;
          if (password.match(/[$@#&!]+/)) strength += 10;
          
          if (strength === 0) {
            text = 'Ingresa una contraseña';
            color = '';
          } else if (strength <= 30) {
            text = 'Débil';
            color = 'bg-danger';
          } else if (strength <= 60) {
            text = 'Media';
            color = 'bg-warning';
          } else if (strength <= 80) {
            text = 'Buena';
            color = 'bg-info';
          } else {
            text = 'Excelente';
            color = 'bg-success';
          }
          
          strengthBar.style.width = strength + '%';
          strengthBar.className = 'progress-bar ' + color;
          strengthText.textContent = text;
        }, 150); // 150ms debounce
      });
    }

    // Form Submit Handler - Optimized
    const registroForm = document.getElementById('formulario_registro');
    if (registroForm && !registroForm.dataset.initialized) {
      registroForm.dataset.initialized = 'true';
      registroForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmar_password').value;
        
        // Validate password match
        if (password !== confirmPassword) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden',
            confirmButtonText: 'Aceptar'
          });
          return false;
        }
        
        // Disable submit button to prevent multiple submissions
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registrando...';
        }
        
        // Get form data
        const formData = {
          registrar_usuario_postmethod: true,
          nombre: document.getElementById('nombre').value,
          apellido: document.getElementById('apellido').value,
          email: document.getElementById('email').value,
          usuario: document.getElementById('usuario').value,
          password: password
        };
        
        // AJAX request with timeout
        $.ajax({
          url: '../../../backend/api/endpoint.php',
          type: 'POST',
          dataType: 'json',
          timeout: 10000, // 10 second timeout
          data: formData,
          success: function(data){
            console.log(data);
            if(data.success){
              Swal.fire({
                icon: 'success',
                title: '¡Registro exitoso!',
                text: 'Tu cuenta ha sido creada correctamente',
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'Login.php';
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Error al registrar el usuario',
                confirmButtonText: 'Aceptar'
              });
              // Re-enable button
              if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check me-2" viewBox="0 0 16 16"><path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/></svg>Crear Cuenta';
              }
            }
          },
          error: function(xhr, status, error){
            console.error('Error:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: 'No se pudo conectar con el servidor',
              confirmButtonText: 'Aceptar'
            });
            // Re-enable button
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check me-2" viewBox="0 0 16 16"><path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/><path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/></svg>Crear Cuenta';
            }
          }
        });
      });
    }
  })();
</script>

</body>
</html>