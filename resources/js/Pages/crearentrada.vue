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
                            <label for="fecha">Fecha</label>
                            <br>
                            <input type="date" id="fecha" title="fecha" placeholder="fecha"
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200">
                        </div>
                        <div class="mt-8">
                            <label for="Selecciona la fiesta:">Selecciona la fiesta:</label>
                            <br>
                            <select class="p-1 text-gray-300 rounded-md bg-gray-700" v-model="id_empresa">
                                <optgroup v-for="e in empresas" :key="e.id" label="primera-opcion">
                                </optgroup>


                            </select>
                        </div>

                        <div class="mt-6">
                            <button
                                class="m-4 p-2 border-2 rounded-md bg-pink-900/80 text-white hover:bg-pink-800/80 hover:scale-110 duration-200">
                                Crear Entrada
                            </button>
                        </div>
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
    },
};
</script>