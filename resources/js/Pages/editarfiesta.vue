<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Entrada</h1>
                    <form action="">
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
                        <div class="mt-8">
                            <label for="tematica">Tematica</label>
                            <br>
                            <select name="tematica" v-model="id_tematica" class="p-1 text-gray-300 rounded-md bg-gray-700"
                                id="tematica">
                                <option v-for="tematica in tematicas" :key="tematica.id" :value="tematica.id">
                                    {{ tematica.nombre }}</option>
                            </select>
                        </div>
                        <div class="mt-8">
                            <label for="musica">Musica</label>
                            <br>
                            <select name="musica" v-model="id_musica" id="musica"
                                class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option v-for="musica in musicas" :key="musica.id" :value="musica.id">{{ musica.nombre }}
                                </option>

                            </select>
                        </div>


                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviar">Actualizar</button>

                    </form>
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


export default {
    components: { NavLink, Link },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            empresas: [],
            tematicas: [],
            musicas: [],
            fiesta_elegida: '',

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
        axios.get('/listarmusica')
            .then(response => {
                this.musicas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listartematica')
            .then(response => {
                this.tematicas = response.data;
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
            formData.append('fiesta_elegida', this.fiesta_elegida);
            formData.append('precio', this.precio);
            formData.append('consumiciones', this.consumiciones);
            formData.append('tipo', this.tipo_entrada);
            console.log(formData)
            axios.post('/crearentradas', formData, {
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