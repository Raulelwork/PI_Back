<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Editar Fiesta</h1>
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
                                        class="text-white m-40" :key="f.id" v-bind:value="f"> {{ formatdate(f.fecha) }}
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
                        <div class="mt-4">
                            <label for="foto">Foto:</label>
                            <br>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="foto" ref="fotoInput" @change="cargarFoto" accept="image/*">
                        </div>

                        <button
                        class="decoration-0 m-4 px-3 py-2 border-2 border-black rounded-md bg-blue-300/70 hover:bg-blue-400/80 text-white hover:scale-110 duration-200"
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
import Swal from 'sweetalert2';


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
            id_musica: '',
            id_tematica: '',
            id_empresa: '',
            foto: null,

        };
    },
    mounted() {
        // Funciones para mostrar los datos
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
        formatdate(dateTimeString) {
            return dateTimeString.slice(0, 10);
        },
        // Funicion para editar la fiesta
        enviar() {
            const formData = new FormData();
            if (this.foto != null && this.fiesta_elegida != '' && this.id_tematica != '' && this.id_musica != '') {
                formData.append('fiesta_elegida', this.fiesta_elegida.id);
                formData.append('id_empresa', this.fiesta_elegida.id_empresa);
                formData.append('id_musica', this.id_musica);
                formData.append('id_tematica', this.id_tematica);
                formData.append('foto', this.foto);
                axios.post('/actualizafiesta', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    // console.log(response);
                    this.showAlert()
                    this.fiesta_elegida = ''
                    this.id_musica = ''
                    this.id_empresa = ''
                }).catch(error => {
                    // console.log(error);
                    this.showAlertError()
                });

            } else {
                this.showAlertValidacion()
            }



        },
        // Funciones con los alert que se muestran al realizar alguna accion

        showAlert() {
            Swal.fire({
                title: 'Fiesta Actualizada!',
                text: 'Tu fiesta se ha actualizado con exito.',
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
                title: 'Error de validación',
                text: 'No puede haber campos vacios o incompletos',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
    }
};



</script>
