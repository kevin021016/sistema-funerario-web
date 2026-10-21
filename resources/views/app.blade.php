<!DOCTYPE html>
<html lang="es">
<head>
     <script>
        (function () {
            try {
                const savedTheme = localStorage.getItem("theme") || "light";

                document.documentElement.setAttribute("data-bs-theme", savedTheme);
                document.documentElement.setAttribute("data-pc-theme", savedTheme);

                // Cambiar logos inmediatamente
                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelectorAll("[data-logo-light]").forEach(function (logo) {
                        const light = logo.getAttribute("data-logo-light");
                        const dark = logo.getAttribute("data-logo-dark");
                        logo.setAttribute("src", savedTheme === "dark" ? dark : light);
                    });
                });

            } catch (e) { }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Espino Mascotas</title>
    <link rel="icon" href={{asset("/assets/images/favicon.svg")}} type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('assets/js/auth-guard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- map-vector css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/plugins/jsvectormap.min.css') }}" />
    <link rel="stylesheet" href={{asset("/assets/css/plugins/style.css")}} />
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href={{asset("/assets/fonts/phosphor/duotone/style.css")}} />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href={{asset("/assets/fonts/tabler-icons.min.css")}} />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href={{asset("/assets/fonts/feather.css")}} />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href={{asset("/assets/fonts/fontawesome.css")}} />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href={{asset("/assets/fonts/material.css")}} />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href={{asset("/assets/css/style.css")}} id="main-style-link" />
    <link rel="stylesheet" href={{asset("/assets/css/style-preset.css")}} />
    <link rel="stylesheet" href={{asset("/assets/css/custom-dark-table.css")}} />
    {{-- Aquí cargamos los estilos y el JS de Vue mediante Vite --}}
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app"></div> {{-- Aquí es donde Vue se "montará" --}}
</body>

<!-- [Page Specific JS] start -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/world.js') }}"></script>
<script src="{{ asset('assets/js/plugins/world-merc.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeSwitch = document.getElementById('dark-mode');
        const currentTheme = localStorage.getItem("theme") || "light";

        // Sincronizar el checkbox con el estado actual
        if (currentTheme === "dark") {
            themeSwitch.checked = true;
        }

        // Función que llama el botón
        window.dark_mode = function () {
            const isDark = themeSwitch.checked;
            const newTheme = isDark ? "dark" : "light";

            // 1. Guardar en Storage
            localStorage.setItem("theme", newTheme);

            // 2. Aplicar a los atributos que lee tu script del Head
            document.documentElement.setAttribute("data-bs-theme", newTheme);
            document.documentElement.setAttribute("data-pc-theme", newTheme);

            // 3. Actualizar logos (opcional pero recomendado para consistencia)
            document.querySelectorAll("[data-logo-light]").forEach(function (logo) {
                const light = logo.getAttribute("data-logo-light");
                const dark = logo.getAttribute("data-logo-dark");
                logo.setAttribute("src", newTheme === "dark" ? dark : light);
            });
        };
    });
</script>

<!-- Required JS -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('assets/js/pages/logout.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</html>