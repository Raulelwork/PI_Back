<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 m-4 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Musica</h1>
                    <form action="">
                        
                        <div class="m-2">
                            <label for="Nombre">Nombre</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="nombreMusica">
                        </div>
                        
                        
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviarmusica">Crear Musica</button>
                    </form>
                </div>

                <div class=" max-w-md justify-center text-white text-center mt-8 m-4 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Tematica</h1>
                    <form action="">
                        
                        <div class="m-2">
                            <label for="Nombre">Nombre</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="nombreTematica">
                        </div>
                        
                        
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviartematica">Crear Tematica</button>
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
            nombreMusica:'',
            nombreTematica:'',
        };
    },
      
    methods: {
        enviarmusica() {
            const formData = new FormData();
            formData.append('nombre', this.nombreMusica);

            axios.post('/crearmusica', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
            }).catch(error => {
            });
        },

        enviartematica() {
            const formData = new FormData();
            formData.append('nombre', this.nombreTematica);

            axios.post('/creartematica', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
            }).catch(error => {
            });
        },
    }
};



</script>