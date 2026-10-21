const { createApp } = Vue

createApp({
    data() {
        return {
            users: [],
            search: '' // Almacena el texto del buscador
        }
    },

    computed: {
        // Esta función se encarga de filtrar la lista de usuarios
        filteredUsers() {
            if (!this.search) {
                return this.users;
            }
            
            const term = this.search.toLowerCase();
            
            return this.users.filter(user => {
                return (
                    user.name.toLowerCase().includes(term) ||
                    user.email.toLowerCase().includes(term) ||
                    (user.rol && user.rol.toLowerCase().includes(term))
                );
            });
        }
    },

    methods: {
        async getUsers() {
            const token = localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)

            try {
                const response = await fetch(`${CONFIG.API_BASE_URL}/users`, {
                    method: 'GET',
                    headers: {
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                })

                this.users = await response.json()
                console.log("Usuarios cargados:", this.users)

            } catch (error) {
                console.error("Error al obtener usuarios:", error)
            }
        }
    },

    mounted() {
        this.getUsers()
    }

}).mount('#users')