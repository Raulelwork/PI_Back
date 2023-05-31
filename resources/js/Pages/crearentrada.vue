<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-900/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Entrada</h1>
                    <form action="">
                        <div class="mt-8">
                            <label for="Selecciona la fiesta:">Fiesta:</label>
                            <br>
                            <div class=" overflow-y-auto h-10 mx-4 break-words text-justify	">
                                <select required v-model="fiesta_elegida" name="lenguajes" id="lang"
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
                        <div class="mt-4">
                            <label for="precio">Precio</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="precio">
                        </div>
                        <div class="mt-4">
                            <label for="consumiciones">Consumiciones</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="consumiciones">
                        </div>
                        <div class="mt-4">
                            <label for="tipo_entrada">Tipo</label>
                            <br>
                            <select name="tipo_entrada" required v-model="tipo_entrada" id="tipo_entrada"
                                class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="Basica">Basica</option>
                                <option value="Normal">Normal</option>
                                <option value="Premium">Premium</option>
                                <option value="Reservado">Reservado</option>
                                <option value="Especial">Especial</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="precio">Entradas</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="number" v-model="aforo">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 border-black rounded-md bg-blue-300/70 hover:bg-blue-400/80 text-white hover:scale-110 duration-200"
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
import Swal from 'sweetalert2';


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
        // Funcion para mostrar los datos
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
        // Funcion para realizar la validacion
        validacion() {
            if (this.precio < 0 || this.precio == '') {
                return false
            }
            if (this.aforo < 0 || this.aforo == '') {
                return false
            }
            if (this.consumiciones < 0 || this.consumiciones == '') {
                return false
            }
            if (this.fiesta_elegida == '') {
                return false
            }
            if (this.tipo_entrada == '') {
                return false
            }
            return true
        },
        formatdate(dateTimeString) {
            return dateTimeString.slice(0, 10);
        },
        enviar() {
            // Funcion para enviar entrada ya validada
            if (this.validacion()) {
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
                    this.showAlert()
                    this.fiesta_elegida = ''
                    this.precio = ''
                    this.aforo = ''
                    this.consumiciones = ''
                    this.tipo_entrada = ''
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
                title: 'Entrada Creada',
                text: 'Tu entrada ha sido creada exitosamente.',
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
                title: 'Error de validacion',
                text: 'Los datos introducidos no son validos.',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
    }
};



</script>