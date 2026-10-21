<template>
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item"><router-link to="/clientes">Lista de usuarios</router-link>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Editar cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Editar información de usuario</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="loading" class="text-center p-5">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Cargando datos...</span>
                </div>
                <p class="mt-2 text-muted">Cargando información del usuario...</p>
            </div>

            <div v-else class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Datos personales</h5>
                            <span class="badge bg-light-primary text-primary">ID Usuario: #CL-{{ user.id }}</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="updateUser">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" v-model="user.name" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellidos:</label>
                                            <input type="text" class="form-control" v-model="user.apellidos" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono</label>
                                            <input type="text" class="form-control" v-model="user.telefono" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="text" class="form-control" v-model="user.email" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contraseña</label>
                                            <div class="input-group">
                                                <input :type="mostrarClave ? 'text' : 'password'" class="form-control"
                                                    placeholder="********" v-model="contrasena" />

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
                                                    class="form-control" placeholder="*********"
                                                    v-model="confirmar_contrasena" />

                                                <button class="btn btn-outline-secondary" type="button"
                                                    @click="mostrarConfirmarClave = !mostrarConfirmarClave">
                                                    <i
                                                        :class="mostrarConfirmarClave ? 'ti ti-eye-off' : 'ti ti-eye'"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <div class="gap-2">
                                        <button type="button" class="btn btn-light-secondary me-2"
                                            @click="cancelEdit">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" :disabled="saving">
                                            <span v-if="saving" class="spinner-border spinner-border-sm me-1"></span>
                                            Guardar cambios
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

// Estados Reactivos
const loading = ref(true);
const saving = ref(false);
const user = ref({});

// Variables para mostrar/ocultar contraseñas
const mostrarClave = ref(false);
const mostrarConfirmarClave = ref(false);

// Modelos para los inputs de contraseña
const contrasena = ref('');
const confirmar_contrasena = ref('');

// Capturar el ID que viene en la URL por Vue Router (ej: /EditarUsuario/89)
const userId = route.params.id;

// Configuración de cabeceras seguras
const getAuthHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
        'Accept': 'application/json'
    }
});

// Cargar información del backend al inicializar
onMounted(async () => {
    try {
        // 1. Obtener datos personales del cliente
        const clientResponse = await axios.get(`${CONFIG.API_BASE_URL}/users/${userId}`, getAuthHeaders());
        user.value = clientResponse.data;

        // 2. Obtener contratos relacionados y resumen de cuenta (puedes ajustar los endpoints según tu API)
        //
        //

    } catch (error) {
        console.error("Error al cargar detalles del cliente:", error);
        if (window.swal) swal("Error", "No se pudo recuperar la información del cliente.", "error");
    } finally {
        loading.value = false;
    }
});

// Enviar actualizaciones mediante método PUT o POST a Laravel
const updateUser = async () => {
    // Validar contraseñas antes de enviar si el usuario escribió algo
    if (contrasena.value) {
        if (contrasena.value !== confirmar_contrasena.value) {
            if (window.swal) swal("Error", "Las contraseñas no coinciden.", "error");
            return;
        }
        // Añadir la contraseña al objeto que se enviará al backend
        user.value.password = contrasena.value;
    } else {
        // Asegurar que no se mande una clave vacía si no se modificó
        delete user.value.password;
    }

    saving.value = true;
    try {
        const response = await axios.put(`${CONFIG.API_BASE_URL}/users/${userId}`, user.value, getAuthHeaders());
        if (response.status === 200) {
            if (window.swal) {
                swal("¡Éxito!", "La información se ha actualizado correctamente.", "success")
                    .then(() => router.push('/usuarios'));
            } else {
                router.push('/usuarios');
            }
        }
    } catch (error) {
        console.error("Error al actualizar:", error);
        const msg = error.response?.data?.message || "Ocurrió un error en el servidor.";
        if (window.swal) swal("Error", msg, "error");
    } finally {
        saving.value = false;
    }
};


const cancelEdit = () => {
    router.push('/clientes');
};

// Helper estético para renderizar dinero con formato local de México
const formatCurrency = (value) => {
    return parseFloat(value).toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
};
</script>

<style scoped>
/* Estilos locales para mantener compatibilidad con tu template */
.avtar.avtar-s {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>