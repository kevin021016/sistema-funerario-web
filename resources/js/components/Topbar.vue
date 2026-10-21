<template>
    <header class="pc-header">
        <div class="header-wrapper">

            <!-- Mobile -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">

                    <!-- Sidebar -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide" @click.prevent="toggleSidebar">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                    <!-- Mobile collapse -->
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse" @click.prevent="toggleMobileSidebar">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                    <!-- Search mobile -->
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#">
                            <i class="ph-duotone ph-magnifying-glass"></i>
                        </a>

                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="mb-0 d-flex align-items-center">
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Buscar..." />

                                    <button class="btn btn-light-secondary btn-search">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>

                </ul>
            </div>

            <!-- Right side -->
            <div class="ms-auto">
                <ul class="list-unstyled">

                    <!-- Apps -->
                    <li class="dropdown pc-h-item d-none d-md-inline-flex">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#">
                            <i class="ph-duotone ph-circles-four"></i>
                        </a>

                        <div class="dropdown-menu dropdown-qta dropdown-menu-end pc-h-dropdown">
                            <div class="overflow-hidden">
                                <div class="qta-links m-n1">
                                    <a v-for="app in apps" :key="app.name" href="#!" class="dropdown-item">
                                        <i :class="app.icon"></i>
                                        <span>{{ app.name }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Theme -->
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#">
                            <i class="ph-duotone ph-sun-dim"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item" @click.prevent="changeTheme('dark')">
                                <i class="ph-duotone ph-moon"></i>
                                <span>Dark</span>
                            </a>

                            <a href="#!" class="dropdown-item" @click.prevent="changeTheme('light')">
                                <i class="ph-duotone ph-sun-dim"></i>
                                <span>Light</span>
                            </a>

                            <a href="#!" class="dropdown-item" @click.prevent="resetTheme">
                                <i class="ph-duotone ph-cpu"></i>
                                <span>Default</span>
                            </a>
                        </div>
                    </li>

                    <!-- Settings -->
                    <li class="pc-h-item">
                        <a class="pc-head-link pct-c-btn" href="#" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas_pc_layout">
                            <i class="ph-duotone ph-gear-six"></i>
                        </a>
                    </li>

                    <!-- Notifications -->
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#">
                            <i class="ph-duotone ph-bell"></i>
                            <span class="badge bg-success pc-h-badge">
                                {{ notifications.length }}
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notifications</h5>
                            </div>
                            <div class="dropdown-body text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 295px)">
                                <ul class="list-group list-group-flush w-100">
                                    <li v-for="(notification, index) in notifications" :key="index"
                                        class="list-group-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-primary">
                                                    <i :class="notification.icon"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 me-3 position-relative">
                                                        <h6 class="mb-0 text-truncate">
                                                            {{ notification.title }}
                                                        </h6>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <span class="text-sm">
                                                            {{ notification.time }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <p class="position-relative mt-1 mb-2">
                                                    {{ notification.message }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Profile -->
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            data-bs-auto-close="outside">
                            <img :src="user.avatar" alt="user-image" class="user-avtar" />
                        </a>

                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc( 225px)">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 mx-3">
                                                    <h5 class="mb-0">{{ user.name }}</h5>
                                                    <a class="link-primary" :href="`mailto:${user.email}`">
                                                        {{ user.email }}
                                                    </a>
                                                </div>
                                                <span class="badge bg-primary">PRO</span>
                                            </div>
                                        </li>
                                        <!-- Dark Mode Switch from Blade -->
                                        <li class="list-group-item">
                                            <div class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph-duotone ph-moon"></i>
                                                    <span>Dark mode</span>
                                                </span>
                                                <div class="form-check form-switch form-check-reverse m-0">
                                                    <input class="form-check-input f-18" type="checkbox" role="switch" @change="toggleDarkMode" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <button class="dropdown-item" @click="cerrarSesion">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph-duotone ph-power"></i>
                                                    <span>Logout</span>
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Topbar',
    data() {
        return {
            apps: [
                { name: 'E-commerce', icon: 'ph-duotone ph-shopping-cart' },
                { name: 'Helpdesk', icon: 'ph-duotone ph-lifebuoy' },
                { name: 'Invoice', icon: 'ph-duotone ph-scroll' },
                { name: 'Chat', icon: 'ph-duotone ph-chats-circle' }
            ],
            notifications: [
                { title: 'Nuevo mensaje', message: 'Tienes un nuevoaaaaaaaaaaa mensaje.', time: '2 min ago', icon: 'ph-duotone ph-chat-circle f-18' },
                { title: 'Nuevo usuario', message: 'Se registró un nuevo usuario.', time: '1 hour ago', icon: 'ph-duotone ph-user f-18' }
            ],
            user: {
                name: 'Carson Darrin',
                email: 'carson.darrin@company.io',
                avatar: '../assets/images/user/avatar-2.jpg'
            }
        }
    },
    methods: {
        changeTheme(theme) {
            // Ejecutar lógica nativa del template
            if (typeof window.layout_change === 'function') {
                window.layout_change(theme);
            }
            
            // Forzar limpieza para que cambie a Light correctamente
            document.body.setAttribute('data-pc-theme', theme);
            if (theme === 'light') {
                document.body.classList.remove('pc-dark-theme', 'dark-mode');
            }
        },

        resetTheme() {
            if (typeof window.layout_change_default === 'function') {
                window.layout_change_default();
            } else {
                document.body.removeAttribute('data-pc-theme');
            }
        },

        toggleDarkMode() {
            if (typeof window.dark_mode === 'function') {
                window.dark_mode();
            }
        },

        toggleSidebar() {
            document.body.classList.toggle('pc-sidebar-hide')
        },

        toggleMobileSidebar() {
            document.body.classList.toggle('mob-sidebar-active')
        },

        async cerrarSesion() {
            // Tu lógica de Logout...
            window.location.href = '/login';
        }
    }
}
</script>

<style scoped>
.pc-header {
    left: 260px;
    right: 0;
    width: auto;
    transition: left .3s ease;
}

.pc-container {
    margin-left: 260px;
    transition: margin-left .3s ease;
}

.pc-sidebar-collapse {
    margin-left: 28px;
    transition: margin-left .3s ease;
}

.pc-sidebar-hide .pc-header { left: 0; }
.pc-sidebar-hide .pc-container { margin-left: 0; }
.pc-sidebar-hide .pc-sidebar-collapse { margin-left: 0; }

@media (max-width: 1024px) {
    .pc-header { left: 0 !important; }
    .pc-container { margin-left: 0 !important; }
}
</style>