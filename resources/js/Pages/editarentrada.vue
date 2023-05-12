
<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Editar Entrada</h1>
                    <div class="mt-8">
                        <label for="Selecciona la fiesta:">Fiesta:</label>
                        <br>
                        <select v-model="fiesta_elegida" name="lenguajes" id="lang"
                            class="p-1 text-gray-300 rounded-md bg-gray-700">
                            <option value="" selected disabled>Seleccionar una opción</option>
                            <optgroup v-for="e in empresas" :key="e.id" class="text-pink-300" :label="e.nombre">
                                <option
                                    v-for="f in fiestas.filter(f => f.id_empresa == e.id && new Date(f.fecha) >= new Date())"
                                    class="text-white m-40" :key="f.id" v-bind:value="f.id"> {{ formatdate(f.fecha) }}
                                    -> {{ f.musica.nombre }}</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mt-8" v-if="fiesta_elegida != ''">
                        <label for="Selecciona la entrada:">Entrada:</label>
                        <br>
                        <select v-model="entrada_elegida" name="lenguajes" id="lang"
                            class="p-1 text-gray-300 rounded-md bg-gray-700">
                            <option value="" selected disabled>Seleccionar una entrada</option>
                            <option v-for="entrada in entradas.filter(entrada => entrada.id_fiesta == fiesta_elegida)"
                                class="text-white m-40" :key="entrada.id" v-bind:value="entrada.id">
                                {{ entrada.tipo }}
                            </option>
                        </select>
                    </div>
                    <button
                        class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                        @click.prevent="enviar">Eliminar Entrada</button>

                </div>
            </section>
        </Layout>
    </section>
</template>

<style scoped>
input::placeholder {
    text-align: center;
}
</style>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';


export default {
    components: { NavLink, Link, Layout },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            empresas: [],
            entradas: [],
            fiesta_elegida: '',
            entrada_elegida: '',
        };
    },
    mounted() {
        axios.get('/listarfiestas')
            .then(response => {
                this.fiestas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listarempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listarentradas')
            .then(response => {
                this.entradas = response.data;
            })
            .catch(error => {
                console.log(error);
            });

    },
    methods: {
        formatdate(dateTimeString) {
            return dateTimeString.slice(0, 10);
        },
        enviar() {
            const formData = new FormData();
            formData.append('entrada_elegida', this.fiesta_elegida);

            axios.post('/eliminarentrada', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },

    }
};



</script>