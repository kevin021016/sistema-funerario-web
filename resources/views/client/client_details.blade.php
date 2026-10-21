<!doctype html>
<html lang="en">
<title>Detalles de cliente</title>
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
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Lista de clientes</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de cliente</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>Información de cliente</h5>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" value="Juan" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Paterno:</label>
                                            <input type="text" class="form-control" value="Pérez" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellido Materno:</label>
                                            <input type="text" class="form-control" value="Pérez" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" class="form-control" value="Sin correo" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Estado:</label>
                                            <input type="text" class="form-control" value="Pérez" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono</label>
                                            <input type="text" class="form-control" value="612-111-4422" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ciudad:</label>
                                            <input type="text" class="form-control" value="23000" disabled />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Colonia:</label>
                                                    <input type="text" class="form-control" value="Pérez" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">C.P.:</label>
                                                    <input type="text" class="form-control" value="23000" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Calle:</label>
                                            <input type="text" class="form-control" value="Pérez" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entre calles:</label>
                                            <input type="text" class="form-control" value="Pérez" disabled />
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Observaciones:</label>
                                            <textarea class="form-control" name="observaciones" id="observaciones"
                                                rows="1" style="resize: none; overflow: hidden; min-height: 38px;"
                                                oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                                disabled>Aquí va el texto que viene de tu base de datos...</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success">Imprimir carátula</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Contratos del cliente</h5>
                            <a href="{{ route('contratos.crearPorID', ['id' => 1]) }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-plus me-1"></i> Agregar contrato
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Folio</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">Forma de pago</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>0001</td>
                                                    <td>$4200</td>
                                                    <td>Contado</td>
                                                    <td><span
                                                            class="badge bg-light-success text-success">Liquidado</span>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item m-0">
                                                                <a href="./detallesCliente/1"
                                                                    class="avtar avtar-s btn btn-info me-1">
                                                                    <i class="ti ti-eye f-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item m-0">
                                                                <a href="#" class="avtar avtar-s btn btn-warning me-1">
                                                                    <i class="ti ti-pencil f-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item m-0">
                                                                <form action="tu_ruta_aqui" method="POST"
                                                                    style="display:inline;">
                                                                    <button type="button"
                                                                        class="delete_user avtar avtar-s btn btn-danger">
                                                                        <i class="ti ti-trash f-18"
                                                                            style="color: #ffffffee"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-success mt-3">Imprimir lista</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tx = document.getElementById('observaciones');
            if (tx) {
                tx.style.height = 'auto';
                tx.style.height = tx.scrollHeight + 'px';
            }
        });
    </script>
</body>

</html>