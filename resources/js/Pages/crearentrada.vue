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
                            <label for="tematica">Tematica</label>
                            <br>
                            <select name="tematica" class="p-1 text-gray-300 rounded-md bg-gray-700" id="tematica">
                                <option value="no">No</option>
                                <option value="carnaval">Carnaval</option>
                                <option value="80s">80s</option>
                                <option value="halloween">Halloween</option>
                                <option value="hawai">Hawai</option>
                                <option value="navidad">Navidad</option>
                            </select>
                        </div>
                        <div class="mt-8">
                            <label for="musica">Musica</label>
                            <br>
                            <select name="musica" id="musica" class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="">Variada</option>
                                <option value="pop">Pop</option>
                                <option value="regateon">Regateon</option>
                                <option value="rock">Rock</option>
                                <option value="salsa">Salsa</option>
                                <option value="tecno">Tecno</option>
                            </select>
                        </div>
                        <div>
                            <label for="foto">Foto:</label>
                            <br>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="foto" ref="fotoInput" @change="cargarFoto" accept="image/*">
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
        };
    },
};
</script>