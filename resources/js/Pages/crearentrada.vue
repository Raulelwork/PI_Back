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
                            <select  v-model="fiesta_elegida" name="lenguajes" id="lang" class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="" selected disabled>Seleccionar una opción</option>
                                <optgroup v-for="e in empresas" :key="e.id" class="text-pink-300" :label="e.nombre">
                                    <option
                                        v-for="f in fiestas.filter(f => f.id_empresa == e.id && new Date(f.fecha) >= new Date())"
                                        class="text-white m-40" :key="f.id" v-bind:value="f.id"> {{ formatdate(f.fecha) }} -> {{namemusica(f.id_musica)}}</option>
                                </optgroup>
                            </select>
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
                            <label for="musica">Tipo</label>
                            <br>
                            <select name="musica" v-model="tipo_entrada" id="musica" class="p-1 text-gray-300 rounded-md bg-gray-700">
                                <option value="basica">Basica</option>
                                <option value="normal">Normal</option>
                                <option value="premium">Premium</option>
                                <option value="reservado">Reservado</option>
                                <option value="especial">Especial</option>
                            </select>
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
            musica: [],
            m: '',
            fiesta_elegida:'',
            precio:'',
            consumiciones:'',
            tipo_entrada:'',
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
                this.musica = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        formatdate(dateTimeString) {
            return dateTimeString.slice(0, 10);
        },
        namemusica(id_musica){
            for(this.m=0;this.m < this.musica.length ; this.m++){
                if (this.musica[this.m].id == id_musica){
                    return this.musica[this.m].nombre
                }
            }
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