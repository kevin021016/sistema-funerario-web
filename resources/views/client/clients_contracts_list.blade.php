<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Lista de contratos</title>
@include('layouts.head')
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
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.sidebar')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    @include('layouts.topbar')
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Lista de contratos</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de contratos</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">

                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card border-0 table-card user-profile-list">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>No. de contrato</th>
                                            <th>Cliente</th>
                                            <th>Tipo de servicio</th>
                                            <th>Fecha de contrato</th>
                                            <th>Monto total</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>00001</td>
                                            <td>Kevin Alberto</td>
                                            <td>Cremación</td>
                                            <td>2011/04/25</td>
                                            <td>$1000</td>
                                            <td>Activo</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item m-0">
                                                        <a href="{{ route('contratos.detalles') }}" class="avtar avtar-s btn btn-info me-1">
                                                            <i class="ti ti-eye f-18"></i>
                                                        </a>
                                                    </li>

                                                    <li class="list-inline-item m-0">
                                                        <a href="{{ route('contratos.editar') }}" class="avtar avtar-s btn btn-warning me-1">
                                                            <i class="ti ti-pencil f-18"></i>
                                                        </a>
                                                    </li>

                                                    <li class="list-inline-item m-0">
                                                        <form action="tu_ruta_aqui" method="POST"
                                                            style="display:inline;">
                                                            <button type="button"
                                                                class="delete_user avtar avtar-s btn btn-danger">
                                                                <i class="ti ti-trash f-18" style="color: #ffffffee"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                    

                                </table>
                                <button class="btn btn-primary">Descargar PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer')

    <!-- Scripts start -->
    @include('layouts.scripts')
    <!-- Scripts end -->
    <!-- [Page Specific JS] start -->
    <script src="../assets/js/plugins/simple-datatables.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
            sortable: false,
            perPage: 5
        });

        dataTable.on('datatable.init', function () {
            // Mostrar tabla ya renderizada
            document.querySelector('.table-responsive').classList.add('table-ready');

            const top = document.querySelector('.datatable-top');

            const btn = document.createElement('div');
            btn.className = 'mt-2 text-end';
            btn.innerHTML = `
            <a href="{{ route('contratos.crear') }}">
             <button class="btn btn-primary">
                Agregar contrato
            </button>
            
            </a>
           
            `;

            top.after(btn);
        });
    </script>


    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_user', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');
                swal({
                    title: "¿Estás seguro?",
                    text: "Una vez eliminado, ya no se podrá recuperar al usuario",
                    icon: "warning",
                    buttons: true,
                    danger: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("El usuario ha sido eliminado!", {
                                icon: "success",
                            }).then(() => {
                                form.submit();
                            });

                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            });
        });
    </script>
    <!-- [Page Specific JS] end -->

</body>
<!-- [Body] end -->

</html>