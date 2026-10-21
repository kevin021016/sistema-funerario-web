<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Login | Sistema Funerario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    
    <!-- [Favicon] -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />
    
    <!-- [Google Font : Public Sans] -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- [Iconos] -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />

    <!-- [Estilos de la Plantilla] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

    <!-- IMPORTANTE: Carga de configuración antes del script de login -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
        /* Ajuste para centrar el formulario profesionalmente */
        .auth-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .auth-wrapper.v1 {
            width: 100%;
            max-width: 450px;
            padding: 1rem;
        }
    </style>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <!-- Logo / Imagen decorativa -->
                            <a href="#"><img src="{{ asset('assets/images/authentication/img-auth-login.png') }}" alt="images" class="img-fluid mb-3" /></a>
                            
                            <h4 class="f-w-500 mb-1">Iniciar Sesión</h4>
                            <p class="mb-3 text-muted">Bienvenido al Sistema de Gestión de Urnas</p>
                        </div>

                        <!-- El ID loginForm es capturado por tu JS -->
                        <form id="loginForm">
                            <div class="mb-3">
                                <label class="form-label">Correo electrónico</label>
                                <!-- Se mantiene id="email" para match con JS -->
                                <input type="email" id="email" class="form-control" placeholder="nombre@correo.com" required />
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <!-- Se mantiene id="password" para match con JS -->
                                <input type="password" id="password" class="form-control" placeholder="••••••••" required />
                            </div>

                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                                    <label class="form-check-label text-muted" for="customCheckc1">Recordarme</label>
                                </div>
                            </div>

                            <!-- ID error-message para que el JS lo muestre al fallar -->
                            <div id="error-message" class="alert alert-danger mt-3" style="display: none;">
                                <i class="ti ti-alert-circle me-2"></i> Correo o contraseña incorrectos.
                            </div>

                            <div class="d-grid mt-4">
                                <!-- ID btnEntrar usado por tu JS -->
                                <button type="submit" id="btnEntrar" class="btn btn-primary">Entrar al Sistema</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted small">&copy; 2026 Funeraria Grupo Espino</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [Scripts de soporte de la plantilla] -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

    <!-- Tu lógica JS personalizada para el Login -->
    <script src="{{ asset('assets/js/pages/login.js') }}"></script>

    <script>
        // Configuración visual inicial requerida por la plantilla
        layout_caption_change('true');
        layout_sidebar_change('light');
        preset_change('preset-1');
    </script>
</body>
</html>