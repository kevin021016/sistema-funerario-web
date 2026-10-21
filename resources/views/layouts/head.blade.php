<head>
    <!-- [Meta] -->
    <meta charset="utf-8" />
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective." />
    <meta name="author" content="phoenixcoded" />

    <!-- [Favicon] icon -->
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
    
    <style>
        body.modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }

        [v-cloak] {
            display: none !important;
        }
    </style>

</head>