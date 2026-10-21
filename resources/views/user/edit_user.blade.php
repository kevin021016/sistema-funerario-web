<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Editar usuario</title>
@include("layouts.head")

<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @include('layouts.sidebar')
    @include('layouts.topBar')

    <!-- [ Main Content ] start -->
    <section class="pc-container">
        <div>
            <div id="users" class="pc-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                                    <li class="breadcrumb-item"><a href="./ListaUsuarios">Usuarios</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Editar usuario</li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0">Editar usuario</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->


                <!-- [ Main Content ] start -->

                <div class="row" id="editarUsuario" v-cloak>
                    <div v-if="loading" class="text-center p-5">
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-2 text-muted">Cargando...</p>
                    </div>
                    <div v-else class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h5>Datos del usuario</h5>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="updateUser">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nombre/s:</label>
                                                <input type="text" class="form-control" placeholder="Ingresa el nombre"
                                                    v-model="user.name" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Apellido/s:</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ingresa los apellidos" v-model="user.apellidos" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email:</label>
                                                <input type="email" class="form-control" placeholder="Ingresa el email"
                                                    v-model="user.email" />
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Número de teléfono</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ingresa el número de teléfono"
                                                    v-model="user.telefono" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Contraseña</label>
                                                <div class="input-group">
                                                    <input :type="mostrarClave ? 'text' : 'password'"
                                                        class="form-control" placeholder="********" v-model="contrasena" />

                                                    <button class="btn btn-outline-secondary" type="button"
                                                        @click="mostrarClave = !mostrarClave">
                                                        <i :class="mostrarClave ? 'ti ti-eye-off' : 'ti ti-eye'"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Confirmar contraseña</label>
                                                <div class="input-group">
                                                    <input :type="mostrarConfirmarClave ? 'text' : 'password'"
                                                        class="form-control" placeholder="*********" v-model="confirmar_contrasena" />

                                                    <button class="btn btn-outline-secondary" type="button"
                                                        @click="mostrarConfirmarClave = !mostrarConfirmarClave">
                                                        <i
                                                            :class="mostrarConfirmarClave ? 'ti ti-eye-off' : 'ti ti-eye'"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="text-align: right;">
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- [ form-element ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </section>
    <!-- [ Main Content ] end -->
    @include('layouts.footer')
    <!-- Required Js -->
    @include('layouts.scripts')
    <!-- [Page Specific JS] start -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                // Obtenemos el ID del input desde el atributo data-target
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('ti-eye', 'ti-eye-off');
                } else {
                    input.type = 'password';
                    icon.classList.replace('ti-eye-off', 'ti-eye');
                }
            });
        });
    </script>
    <script>
        const userId = {{ $id }};
    </script>
    <script src="{{ asset('assets/js/vue/users.js') }}"></script>
</body>
<!-- [Body] end -->

</html>