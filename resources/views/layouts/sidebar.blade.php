<style>
    /* Tamaño */
    .logo-svg {
        width: 220px;
        transition: all 0.3s ease;
    }

    /* TRANSICIÓN SUAVE DE TODO */
    .logo-svg * {
        transition: all 0.3s ease;
    }

    /* =========================
   🌞 TEMA CLARO (DEFAULT)
========================= */
    :root {
        --logo-text: #1f2937;

        --dog-main: #f4c38a;
        --dog-ear: #e0ad6d;
        --dog-eye: #2f2f2f;
        --dog-mouth: #ffe2c2;

        --urn-top: #c68642;
        --urn-bottom: #8a4f2d;
        --urn-mid: #a86235;
    }

    /* =========================
   🌙 TEMA OSCURO
========================= */
    [data-pc-theme="dark"] {
        --logo-text: #ffffff;

        /* look nocturno */
        --dog-main: #e6b67f;
        --dog-ear: #c9975f;
        --dog-eye: #1a1a1a;
        --dog-mouth: #f5d7b5;

        --urn-top: #d89a5a;
        --urn-bottom: #6e3f24;
        --urn-mid: #8c4f2a;
    }

    /* Aplicación al texto */
    .logo-text {
        fill: var(--logo-text);
    }

    /* =========================
   ✨ HOVER 
========================= */
    .b-brand:hover .logo-svg {
        transform: scale(1.03);
    }
</style>
<nav class="pc-sidebar" x-data="{ user: JSON.parse(localStorage.getItem(CONFIG.STORAGE_KEYS.USER) || '{}') }">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href={{asset("./")}} class="b-brand">

                <svg class="logo-svg" viewBox="0 0 820 160">
                    <g transform="translate(-60,-10) scale(1.25)">

                        <defs>
                            <linearGradient id="urnGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="var(--urn-top)" />
                                <stop offset="100%" stop-color="var(--urn-bottom)" />
                            </linearGradient>
                        </defs>

                        <!-- ICONO -->
                        <g transform="translate(20,20) scale(0.6)">

                            <!-- cabeza -->
                            <circle cx="128" cy="110" r="55" fill="var(--dog-main)" />

                            <!-- orejas -->
                            <ellipse cx="90" cy="120" rx="18" ry="35" fill="var(--dog-ear)" />
                            <ellipse cx="166" cy="120" rx="18" ry="35" fill="var(--dog-ear)" />

                            <!-- ojos -->
                            <circle cx="112" cy="105" r="6" fill="var(--dog-eye)" />
                            <circle cx="144" cy="105" r="6" fill="var(--dog-eye)" />

                            <!-- hocico -->
                            <ellipse cx="128" cy="125" rx="18" ry="14" fill="var(--dog-mouth)" />
                            <circle cx="128" cy="122" r="4" fill="var(--dog-eye)" />

                            <!-- sonrisa -->
                            <path d="M118 135 Q128 142 138 135" stroke="var(--dog-eye)" stroke-width="3" fill="none"
                                stroke-linecap="round" />

                            <!-- urna -->
                            <path d="M60 150 Q128 180 196 150 L180 245 Q128 265 76 245 Z" fill="url(#urnGrad)" />

                            <ellipse cx="128" cy="150" rx="70" ry="18" fill="var(--urn-mid)" />

                        </g>

                        <!-- TEXTO -->
                        <text class="logo-text" x="210" y="100" font-family="Inter, Segoe UI, Arial, sans-serif"
                            font-size="44" font-weight="600" dominant-baseline="middle">
                            Funeraria Mascotas
                        </text>

                    </g>
                </svg>

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                    <i class="ph-duotone ph-gauge"></i>
                </li>
                <li class="pc-item">
                    <a href="./" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Opciones</label>
                    <i class="ph-duotone ph-chart-pie"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('usuarios.lista') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-user-circle"></i>
                        </span>
                        <span class="pc-mtext">Usuarios</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('clientes.lista') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-users"></i>
                        </span>
                        <span class="pc-mtext">Clientes</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('contratos.lista') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-notebook"></i>
                        </span>
                        <span class="pc-mtext">Contratos</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ph-duotone ph-cube"></i></span><span
                            class="pc-mtext">Inventario</span><span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('urnas.lista') }}">Urnas</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-database"></i></span><span class="pc-mtext">Reportes</span><span
                            class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="">General de recibos</a></li>
                        <li class="pc-item"><a class="pc-link" href="../admins/invoice-view.html">Movimientos de usuario</a></li>
                    </ul>
                </li>

        </div>
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 ms-3">
                        <div class="dropdown">
                            <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-offset="0,20">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <h6 id="user-name-sidebar" class="mb-0" x-text="user.nombre || 'Usuario'"></h6>
                                        <small id="user-role-sidebar" x-text="user.role || 'Rol'"></small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn btn-icon btn-link-secondary avtar">
                                            <i class="ph-duotone ph-windows-logo"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <a class="pc-user-links">
                                            <i class="ph-duotone ph-power"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>