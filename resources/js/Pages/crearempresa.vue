<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Empresa</h1>
                    <form @submit.prevent="submit">
                        <div>
                            <label for="nombre">Nombre</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="nombre">
                        </div>
                        <div>
                            <label for="cif">Cif</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="cif">
                        </div>
                        <div>
                            <label for="ubicacion">Ubicacion</label>
                            <br>
                            <select name="ubicacion" v-model="ubicacion" id="ubicacion"
                                class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="Almeria">Almeria</option>
                                <option value="Granada">Granada</option>
                                <option value="Malaga">Malaga</option>
                                <option value="Sevilla">Sevilla</option>
                                <option value="Cadiz">Cadiz</option>
                                <option value="Huelva">Huelva</option>
                                <option value="Cordoba">Cordoba</option>
                                <option value="Jaen">Jaen</option>

                            </select>
                        </div>
                        <div>
                            <label for="lugar">Lugar</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="lugar">
                        </div>
                        <div>
                            <label for="foto">Foto:</label>
                            <br>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="foto" ref="fotoInput" @change="cargarFoto" accept="image/*">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviar">Enviar</button>



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
import Layout from '@/components/Layout.vue';
import Swal from 'sweetalert2';


export default {
    components: { Layout, NavLink, Link },
    data() {
        return {
            showMenu: false,
            nombree: '',
            cif: '',
            ubicacion: '',
            lugar: '',
            foto: null,
        };
    },
    methods: {
        cargarFoto() {
            this.foto = this.$refs.fotoInput.files[0];

        },
        enviar() {
            const formData = new FormData();
            formData.append('foto', this.foto);
            formData.append('nombre', this.nombre);
            formData.append('cif', this.cif);
            formData.append('ubicacion', this.ubicacion);
            formData.append('lugar', this.lugar);
            axios.post('/crearempresa', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                // console.log(response);
                this.showAlert()
            }).catch(error => {
                // console.log(error);
                this.showAlertError()
            });
        },
        showAlert() {
            Swal.fire({
                title: 'Empresa creada!',
                text: 'Su empresa ha sido registrada con exito.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertError() {
            Swal.fire({
                title: 'Ha surgido un error',
                text: 'Error inesperado. Intenta realizar esta operacion en unos minutos..',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
    },

};
</script>