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









<script>
    layout_sidebar_change('light');
</script>

<script>
    change_box_container('false');
</script>

<script>
    layout_caption_change('true');
</script>

<script>
    layout_rtl_change('false');
</script>

<script>
    preset_change('preset-1');
</script>