<!doctype html>
<html lang="en">
<title>Editar cliente | Juan Pérez</title>
@include("layouts.head")

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('layouts.sidebar')
    @include('layouts.topBar')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item"><a href="./ListaClientes">Lista de usuarios</a></li>
                                <li class="breadcrumb-item" aria-current="page">Editar cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Editar información de cliente</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Datos personales</h5>
                            <span class="badge bg-light-primary text-primary">ID Cliente: #CL-089</span>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" value="Juan" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno:</label>
                                            <input type="text" class="form-control" value="Pérez" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Materno:</label>
                                            <input type="text" class="form-control" value="Sánchez" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" class="form-control" value="juan.perez@email.com" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Estado:</label>
                                            <input type="text" class="form-control" value="Baja California Sur" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono</label>
                                            <input type="text" class="form-control" value="6121234567" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ciudad:</label>
                                            <input type="text" class="form-control" value="La Paz" />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Colonia:</label>
                                                    <input type="text" class="form-control" value="Centro" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">C.P.:</label>
                                                    <input type="text" class="form-control" value="23000" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Calle:</label>
                                            <input type="text" class="form-control" value="Av. Álvaro Obregón #123" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entre calles:</label>
                                            <input type="text" class="form-control" value="Madero y Revolución" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-outline-danger">Desactivar Cliente</button>
                                    <div class="gap-2">
                                        <button type="button" class="btn btn-light-secondary">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Contratos vinculados</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="./DetallesContrato/1" class="list-group-item list-group-item-action border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-success flex-shrink-0">
                                            <i class="ti ti-file-check f-20"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Folio: #000001</h6>
                                            <p class="mb-0 small text-muted">Mascota: Max (Labrador)</p>
                                        </div>
                                        <i class="ti ti-chevron-right"></i>
                                    </div>
                                </a>
                                <a href="./DetallesContrato/2" class="list-group-item list-group-item-action border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-warning flex-shrink-0">
                                            <i class="ti ti-file-invoice f-20"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Folio: #000045</h6>
                                            <p class="mb-0 small text-muted">Mascota: Toby (Chihuahua)</p>
                                        </div>
                                        <i class="ti ti-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="./NuevoContrato?cliente=89" class="btn btn-sm btn-light-primary">
                                <i class="ti ti-plus"></i> Generar nuevo contrato
                            </a>
                        </div>
                    </div>

                    <div class="card bg-light-info shadow-none">
                        <div class="card-body">
                            <h6 class="mb-2">Resumen de cuenta</h6>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Total pagado:</span>
                                <span class="fw-bold">$4,500.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Saldo deudor:</span>
                                <span class="fw-bold text-danger">$1,200.00</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>