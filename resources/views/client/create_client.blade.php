<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Agregar cliente</title>
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
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item"><a href="./ListaClientes">Lista de usuarios</a></li>
                                <li class="breadcrumb-item" aria-current="page">Agregar cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Agregar cliente</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ form-element ] start -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>Datos del usuario</h5>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" value="" placeholder="Ingrese el nombre..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno:</label>
                                            <input type="text" class="form-control" value="" placeholder="Ingrese el apellido paterno..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Materno:</label>
                                            <input type="text" class="form-control" value="" placeholder="Ingrese el apellido materno..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" class="form-control" value="" placeholder="Ingrese el correo..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Estado:</label>
                                            <input type="text" class="form-control" value="Baja California Sur" placeholder="Ingrese el estado..." />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono</label>
                                            <input type="text" class="form-control" value="" placeholder="Ingrese el número de teléfono..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ciudad:</label>
                                            <input type="text" class="form-control" value="La Paz" placeholder="Ingrese la ciudad..." />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Colonia:</label>
                                                    <input type="text" class="form-control" value="" placeholder="Seleccionar colonia..." />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">C.P.:</label>
                                                    <input type="text" class="form-control" value="" placeholder="Ingrese el código postal" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Calle:</label>
                                            <input type="text" class="form-control" value="" placeholder="Ingrese la calle..." />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entre calles:</label>
                                            <input type="text" class="form-control" value="" placeholder="Entre calles..." />
                                        </div>

                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button style="margin-left: auto" class="btn btn-primary">Agregar cliente</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- [ form-element ] end -->
        </div>
        <!-- [ Main Content ] end -->
        </div>
    </section>
    <!-- [ Main Content ] end -->
    @include('layouts.footer')
    <!-- Required Js -->
    @include('layouts.scripts')
    <!-- [Page Specific JS] start -->
</body>
<!-- [Body] end -->

</html>