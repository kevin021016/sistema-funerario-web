const { createApp } = Vue

createApp({
    data() {
        return {
            clients: [],
            client: {},
            search: '',
            loading: true,
            loadingButtonForm: false,

            nombre: "",
            apellidos: "",
            email: "",
            telefono: "",
            contrasena: "",
            confirmar_contrasena: "",
            mostrarClave: false,
            mostrarConfirmarClave: false,

            // Logo placeholder o real en Base64
            logoBase64: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
        }
    },

    computed: {
        filteredClients() {
            // Si el buscador está vacío, mostramos todos
            if (!this.search) {
                return this.clients;
            }

            const term = this.search.toLowerCase();

            return this.clients.filter(user => {
                // Buscamos en nombre, email y rol
                return (
                    user.nombre.toLowerCase().includes(term)
                );
            });
        }
    },

    methods: {
        async createUser() {
            // Validación básica de contraseñas en el cliente
            if (this.contrasena !== this.confirmar_contrasena) {
                swal("Error", "Las contraseñas no coinciden", "error");
                return;
            }

            this.loadingButtonForm = true;
            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/users`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        ...this.user,
                        password: this.contrasena // Enviamos la contraseña del v-model local
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    swal("¡Creado!", "El usuario ha sido registrado", "success")
                        .then(() => window.location.href = '/ListaUsuarios');
                } else {
                    // Si Laravel devuelve error de validación (ej: email repetido)
                    swal("Error", "No se pudo crear el usuario", "error");
                    this.loadingButtonForm = false;
                }
            } catch (error) {
                console.error("Error:", error);
                swal("Error", "Fallo de conexión con el servidor", "error");
            } finally {
                this.loading = false;
            }
        },
        async getClients() {
            this.loading = true; // Iniciamos carga
            const token = localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN);

            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/clients`, {
                    method: 'GET',
                    headers: {
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                });

                this.clients = await response.json();
            } catch (error) {
                console.error("Error al obtener cliente:", error);
            } finally {
                // Pequeño timeout opcional para que el spinner no desaparezca tan brusco
                setTimeout(() => {
                    this.loading = false;
                }, 500);
            }
        },
        async getUserData(id) {
            this.loading = true; // Iniciamos carga
            const token = localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN);

            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/users/${id}`, {
                    method: 'GET',
                    headers: {
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                });

                this.user = await response.json();
            } catch (error) {
                console.error("Error al obtener usuarios:", error);
            } finally {
                // Pequeño timeout opcional para que el spinner no desaparezca tan brusco
                setTimeout(() => {
                    this.loading = false;
                }, 500);
            }
        },

        async updateUser() {
            // 1. Validar rápido en el cliente (opcional pero recomendado)
            if (this.contrasena && this.contrasena !== this.confirmar_contrasena) {
                swal("Error", "Las contraseñas no coinciden", "error");
                return;
            }

            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/users/${this.user.id}`, {
                    method: 'PUT', // Estándar para actualización
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.user) // Convertimos el objeto user a texto JSON
                });

                const result = await response.json();

                if (response.ok) {
                    swal("¡Éxito!", "Usuario actualizado correctamente", "success")
                        .then(() => window.location.href = '/ListaUsuarios');
                } else {
                    // Mostrar errores de validación de Laravel
                    swal("Error", result.message || "Error al actualizar", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                swal("Error", "No se pudo conectar con el servidor", "error");
            }
        },

        async deleteUser(id) {
            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/users/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
                        'Accept': 'application/json'
                    },
                });

                const result = await response.json();
                console.log("id " + id)
                if (response.ok) {
                    this.users = this.users.filter(user => user.id != id);
                    swal("¡Éxito!", "Usuario eliminado", "success")
                } else {
                    // Mostrar errores de validación de Laravel
                    swal("Error", result.message || "No se pudo eliminar", "error");
                }
            } catch (error) {
                console.error("Error:", error);
                swal("Error", "No se pudo conectar con el servidor", "error");
            }
        },
        confirmDelete(id) {
            swal({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                buttons: ["Cancelar", "Sí, eliminar"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        this.deleteUser(id);
                    }
                });
        },

        async generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');
            const primaryColor = [41, 128, 185];
            const businessName = "FUNERARIA DE MASCOTAS";

            // Diseño del encabezado
            doc.setFont("helvetica", "bold");
            doc.setFontSize(18);
            doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
            doc.text(businessName, 14, 20);
              doc.setProperties({
                title: "Lista de usuarios"
            });

            doc.setFontSize(10);
            doc.setTextColor(100);
            doc.setFont("helvetica", "normal");
            doc.text("Reporte administrativo de clientes registrados", 14, 26);
            doc.text(`Generado el: ${new Date().toLocaleString()}`, 14, 31);

            doc.setDrawColor(primaryColor[0], primaryColor[1], primaryColor[2]);
            doc.line(14, 35, 196, 35);

            // Preparar datos de la tabla (usando los filtrados)
            const columns = ["ID", "Nombre", "Email", "Rol", "Teléfono", "Registro"];
            const rows = this.filteredUsers.map(u => [
                u.id,
                u.name,
                u.email,
                u.rol || 'N/A',
                u.telefono || 'N/A',
                u.created_at ? u.created_at.substring(0, 10) : 'N/A'
            ]);

            doc.autoTable({
                head: [columns],
                body: rows,
                startY: 40,
                theme: 'striped',
                headStyles: { fillColor: primaryColor, textColor: 255 },
                styles: { fontSize: 8 },
                didDrawPage: (data) => {
                    doc.setFontSize(8);
                    doc.text(`Página ${doc.internal.getNumberOfPages()}`, data.settings.margin.left, doc.internal.pageSize.height - 10);
                }
            });

            // Salida a Iframe para Modal
            const string = doc.output('bloburl');
            const iframe = document.getElementById('pdfPreview');
            if (iframe) {
                iframe.src = string;
                const modalElement = document.getElementById('pdfModal');
                const bsModal = new bootstrap.Modal(modalElement);
                bsModal.show();
            }
        },
        exportToExcel() {
            // 1. Preparamos los datos: Limpiamos los objetos para que solo tengan lo necesario
            // Usamos filteredUsers para respetar la búsqueda actual del usuario
            const dataToExport = this.filteredUsers.map(u => ({
                "ID": u.id,
                "Nombre": u.name,
                "Apellidos": u.apellidos || 'N/A',
                "Correo Electrónico": u.email,
                "Rol": u.rol || 'N/A',
                "Teléfono": u.telefono || 'N/A',
                "Fecha de Registro": u.created_at ? u.created_at.substring(0, 10) : 'N/A'
            }));

            // 2. Creamos una hoja de trabajo (worksheet)
            const worksheet = XLSX.utils.json_to_sheet(dataToExport);

            // 3. Creamos un libro de trabajo (workbook)
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Usuarios");

            // 4. Ajuste estético: Definir anchos de columna (opcional)
            const wscols = [
                { wch: 5 },  // ID
                { wch: 20 }, // Nombre
                { wch: 20 }, // Apellidos
                { wch: 30 }, // Email
                { wch: 15 }, // Rol
                { wch: 15 }, // Teléfono
                { wch: 15 }  // Fecha
            ];
            worksheet['!cols'] = wscols;

            // 5. Generar archivo y descargar
            const fecha = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(workbook, `Reporte_Usuarios_${fecha}.xlsx`);
        }
    },

    mounted() {
        if (document.getElementById('listaClientes')) {
            this.getClients();
        }
        if (document.getElementById('editarCliente')) {
            this.getUserData(userId);
        }
    }

}).mount('#clients')
