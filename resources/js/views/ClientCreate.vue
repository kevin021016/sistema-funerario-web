<template>
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item"><router-link to="/clientes">Lista de clientes</router-link>
                                </li>
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

            <div v-if="loading" class="text-center p-5">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Cargando datos...</span>
                </div>
                <p class="mt-2 text-muted">Cargando información del cliente de la funeraria...</p>
            </div>

            <div v-else class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Datos personales</h5>
                            <span class="badge bg-light-primary text-primary">ID Cliente: #CL-{{ client.id }}</span>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="createClient">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" v-model="client.nombre" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellidos:</label>
                                            <input type="text" class="form-control" v-model="client.apellidos" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Celular:</label>
                                            <input type="text" class="form-control" v-model="client.celular" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono</label>
                                            <input type="text" class="form-control" v-model="client.telefono" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ciudad:</label>
                                            <input type="text" class="form-control" v-model="client.ciudad" />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Colonia:</label>
                                                    <input type="text" class="form-control" v-model="client.colonia" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">C.P.:</label>
                                                    <input type="text" class="form-control"
                                                        v-model="client.codigo_postal" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Calle:</label>
                                            <input type="text" class="form-control" v-model="client.calle" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entre calles:</label>
                                            <input type="text" class="form-control" v-model="client.entre_calles" />
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
const client = ref({});
const contracts = ref([]);
const accountSummary = ref({ total_paid: 0, balance_due: 0 });

// Capturar el ID que viene en la URL por Vue Router (ej: /EditarUsuario/89)
const clientId = route.params.id;

// Configuración de cabeceras seguras
const getAuthHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
        'Accept': 'application/json'
    }
});

// Cargar información del backend al inicializar
onMounted(async () => {
    loading.value = false;
});

// Enviar actualizaciones mediante método PUT o POST a Laravel
const createClient = async () => {
    saving.value = true;
    try {
        const response = await axios.post(`${CONFIG.API_BASE_URL}/clients`, client.value, getAuthHeaders());
        if (response.status === 201) {
            if (window.swal) {
                swal("¡Éxito!", "El usuario ha sido creado correctamente.", "success")
                    .then(() => router.push('/clientes')); // Redirección fluida de Vue Router
            } else {
                router.push('/clientes');
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

// Activar o desactivar estado del registro
/*const toggleClientStatus = async () => {
  const currentStatus = client.value.status === 'inactive' ? 'activar' : 'desactivar';
  
  if (window.swal) {
    swal({
      title: `¿Deseas ${currentStatus} este cliente?`,
      text: `Esta acción cambiará los permisos de acceso en el sistema.`,
      icon: "warning",
      buttons: ["Cancelar", "Confirmar"],
      dangerMode: true,
    }).then(async (willChange) => {
      if (willChange) {
        try {
          const targetStatus = client.value.status === 'inactive' ? 'active' : 'inactive';
          await axios.post(`${CONFIG.API_BASE_URL}/clients/${clientId}/toggle-status`, { status: targetStatus }, getAuthHeaders());
          client.value.status = targetStatus;
          swal("¡Modificado!", `El cliente ha sido cambiado a: ${targetStatus}`, "success");
        } catch (err) {
          swal("Error", "No se pudo cambiar el estado del cliente", "error");
        }
      }
    });
  }
}; */

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