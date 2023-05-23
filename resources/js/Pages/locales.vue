

<template>
    <section class="entradas">

        <Layout>
                <div class="flex flex-col bg-black/70 rounded-br-xl float-left p-4 ">
                    <h1 class="text-white text-xl" >Ciudades</h1>
                    <div class="flex flex-col m-2 text-blue-400 items-center">
                        <label for="sevilla">Sevilla</label>
                        <input type="checkbox" v-model="ciudades['sevilla']" id="sevilla" @change="filtrar" name="ciudad"
                            class="mr-2 mt-1 ml-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-pink-400 items-center">
                        <label for="malaga">Málaga</label>
                        <input type="checkbox" v-model="ciudades['malaga']" id="malaga" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-blue-400 items-center">
                        <label for="cadiz">Cádiz</label>
                        <input type="checkbox" v-model="ciudades['cadiz']" id="cadiz" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-pink-400 items-center">
                        <label for="granada">Granada</label>
                        <input type="checkbox" v-model="ciudades['granada']" id="granada" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-blue-400 items-center">
                        <label for="cordoba">Córdoba</label>
                        <input type="checkbox" v-model="ciudades['cordoba']" id="cordoba" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-pink-400 items-center">
                        <label for="almeria">Almería</label>
                        <input type="checkbox" v-model="ciudades['almeria']" id="almeria" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-blue-400 items-center">
                        <label for="huelva">Huelva</label>
                        <input type="checkbox" v-model="ciudades['huelva']" id="huelva" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>

                    <div class="flex flex-col m-2 text-pink-400 items-center">
                        <label for="jaen">Jaén</label>
                        <input type="checkbox" v-model="ciudades['jaen']" id="jaen" @change="filtrar" name="ciudad"
                            class="mx-2 mt-1 rounded-full p-2">
                    </div>
                </div>
                <div class=" min-[450px]:grid place-items-center  border-t-4 border-t-black">
                    <h1
                        class="text-white p-3 rounded-sm text-5xl mt-4 max-[1120px]:mx-0 max-[1120px]:text-4xl  text-center mx-96">
                        LOCALES
                    </h1>

                    <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                        <div v-for="empresa in empresasFiltradas" :key="empresa.id">
                            <nav-link :href="'perfil/' + empresa.id" class="no-underline">
                                <div
                                    class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500  hover:scale-110">
                                    <h2 class="text-white text-4xl m-3 text-center">{{ empresa.nombre }}</h2>
                                    <img v-bind:src="'https://pipartytime.com/storage/empresas/' + empresa.foto"
                                        class="mb-4 object-cover h-72 w-72 " alt="">
                                </div>
                            </nav-link>
                        </div>
                    </div>
                </div>
        </Layout>
    </section>
</template>

<script>
// Import Swiper Vue.js components
// Import Swiper styles
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";
// import required modules
import Layout from '@/components/Layout.vue';


export default {
    components: {
        Layout,
        NavLink,
        Link,
    },
    data() {
        return {
            showMenu: false,
            empresas: [],
            empresasFiltradas: [],
            filtros: [],
            ciudades: {
                almeria: false,
                granada: false,
                cadiz: false,
                cordoba: false,
                malaga: false,
                sevilla: false,
                huelva: false,
                jaen: false
            }

        };
    },
    mounted() {

        axios.get('/listarallempresas')
            .then(response => {
                this.empresas = response.data;
                this.empresasFiltradas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    },
    methods: {
        filtrar() {
            this.empresasFiltradas = [];
            this.filtros = [];
            for (let ciudad in this.ciudades) {
                if (this.ciudades[ciudad]) {
                    this.filtros.push(ciudad)
                }
            }
            if (this.filtros.length == 0) {
                this.empresasFiltradas = this.empresas;
            } else {
                for (let empresa in this.empresas) {
                    // console.log(this.empresas[empresa])
                    if (this.filtros.includes(this.empresas[empresa].ubicacion.toLowerCase())) {
                        this.empresasFiltradas.push(this.empresas[empresa])
                    }
                }
                // console.log(this.filtros)
            }
        }
    }

};

</script>

