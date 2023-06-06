<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-900/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Fiestas</h1>
                    <form>
                        <div class="mt-8">
                            <label for="fecha">Fecha</label>
                            <br>
                            <input type="date" v-model="fecha" id="fecha" title="fecha" placeholder="fecha"
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200">
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
                        <div class="mt-8">
                            <label for="musica">Empresas</label>
                            <br>
                            <select class="p-1 text-gray-300 rounded-md bg-gray-700" v-model="id_empresa">
                                <option v-for="e in empresas" :key="e.id" :value="e.id"> {{ e.nombre }} </option>
                            </select>
                        </div>
                        <div>
                            <label for="foto">Foto:</label>
                            <br>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="foto" ref="fotoInput" @change="cargarFoto" accept="image/*">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 border-black rounded-md bg-blue-300/70 hover:bg-blue-400/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviar">Crear Fiesta</button>

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
import axios from 'axios';
import Layout from '@/components/Layout.vue';
import Swal from 'sweetalert2';


export default {
    components: { NavLink, Link, Layout },
    data() {
        return {
            showMenu: false,
            empresas: [],
            tematicas: [],
            musicas: [],
            fecha: '',
            id_tematica: '',
            id_musica: '',
            id_empresa: '',
            foto: null,
        };
    },
    // Funciones para mostrar los datos
    mounted() {
        axios.get('/listarempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listarmusica')
            .then(response => {
                this.musicas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listartematica')
            .then(response => {
                this.tematicas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    },
    methods: {
        cargarFoto() {
            this.foto = this.$refs.fotoInput.files[0];

        },
        // Funcion para enviar y crear la fiesta ya validada
        enviar() {
            const fechaActual = new Date();
            fechaActual.setHours(1, 0, 0, 0); // Establecer la hora a las 1 a.m.

            const fechaActualISO = fechaActual.toISOString().split('T')[0];
            const formData = new FormData();

            if (this.foto != null && this.fecha != '' && this.id_tematica != '' && this.id_musica != '' && this.id_empresa != '') {
                if (this.fecha > fechaActualISO) {
                    formData.append('foto', this.foto);
                    formData.append('fecha', this.fecha);
                    formData.append('id_tematica', this.id_tematica);
                    formData.append('id_musica', this.id_musica);
                    formData.append('id_empresa', this.id_empresa);



                    axios.post('/crearfiestas', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(response => {
                        // console.log(response);
                        this.showAlert()
                        this.foto = null
                        this.fecha = ''
                        this.id_tematica = ''
                        this.id_musica = ''
                        this.id_empresa = ''
                    }).catch(error => {
                        // console.log(error);
                        this.showAlertError()
                    });
                } else {
                    this.showAlertFecha()

                }

            } else {
                this.showAlertValidacion()
            }
        },
        // Funciones con los alert que se muestran al realizar alguna accion

        showAlert() {
            Swal.fire({
                title: 'Fiesta Creada!',
                text: 'Tu fiesta se ha realizado con exito.',
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
        showAlertValidacion() {
            Swal.fire({
                title: 'Error de Validacion',
                text: 'No se permiten campos vacios o incompletos!',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertFecha() {
            Swal.fire({
                title: 'Error de Fecha',
                text: 'La fecha debe de ser posterior o igual a la actual.',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
    },
};


</script>