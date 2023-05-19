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
                            <div class=" overflow-y-auto h-10 mx-4 break-words text-justify	">
                                <select v-model="fiesta_elegida" name="lenguajes" id="lang"
                                    class="p-1 text-gray-300 rounded-md bg-gray-700 h-10">
                                    <option value="" selected disabled>Seleccionar una opción</option>
                                    <optgroup v-for="e in empresas" :key="e.id" class="text-pink-300" :label="e.nombre">
                                        <option
                                            v-for="f in fiestas.filter(f => f.id_empresa == e.id && new Date(f.fecha) >= new Date())"
                                            class="text-white m-40" :key="f.id" v-bind:value="f.id"> {{ formatdate(f.fecha)
                                            }} -> {{ f.musica.nombre }}</option>
                                    </optgroup>
                                </select>
                            </div>

                        </div>
                        <div>
                            <label for="precio">Precio</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="precio">
                        </div>
                        <div>
                            <label for="consumiciones">Consumiciones</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="consumiciones">
                        </div>
                        <div class="mt-8">
                            <label for="tipo_entrada">Tipo</label>
                            <br>
                            <select name="tipo_entrada" v-model="tipo_entrada" id="tipo_entrada"
                                class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="Basica">Basica</option>
                                <option value="Normal">Normal</option>
                                <option value="Premium">Premium</option>
                                <option value="Reservado">Reservado</option>
                                <option value="Especial">Especial</option>
                            </select>
                        </div>
                        <div>
                            <label for="precio">Nº Aforo</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="aforo">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviar">Crear Entrada</button>

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
            fiesta_elegida: '',
            precio: '',
            consumiciones: '',
            tipo_entrada: '',
            aforo: '',
        };
    },
    mounted() {
        axios.get('/listarfiestas')
            .then(response => {
                this.fiestas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listarempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                // console.log(error);
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
            formData.append('aforo', this.aforo);
            formData.append('consumiciones', this.consumiciones);
            formData.append('tipo', this.tipo_entrada);
            axios.post('/crearentradas', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                // console.log(response);
            }).catch(error => {
                // console.log(error);
            });
        },
    }
};



</script>