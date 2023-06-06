

<template>
    <section class="entradas">

        <Layout>
            <h1 class="text-white p-3 rounded-sm text-5xl mt-4 max-[1120px]:mx-0 max-[1120px]:text-4xl  text-center mx-96">
                LOCALES
            </h1>
            <div class="hidden md:flex flex-col bg-black/70 rounded-br-xl float-left p-4 ">
                <h1 class="animated-name text-center text-xl">Ciudades</h1>
                <div class="m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['sevilla']" id="sevilla" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="sevilla">Sevilla</label>
                </div>

                <div class=" m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['malaga']" id="malaga" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="malaga">Málaga</label>
                </div>

                <div class="m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['cadiz']" id="cadiz" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="cadiz">Cádiz</label>
                </div>

                <div class=" m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['granada']" id="granada" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="granada">Granada</label>
                </div>

                <div class="m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['cordoba']" id="cordoba" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="cordoba">Córdoba</label>
                </div>

                <div class=" m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['almeria']" id="almeria" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="almeria">Almería</label>
                </div>

                <div class="m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['huelva']" id="huelva" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="huelva">Huelva</label>
                </div>

                <div class=" m-2 text-white items-center">
                    <input type="checkbox" v-model="ciudades['jaen']" id="jaen" @change="filtrar" name="ciudad"
                        class="mx-2 mt-1 rounded-full p-1">
                    <label for="jaen">Jaén</label>
                </div>
            </div>
            <div class="dropdown text-white">
                <button class="md:hidden dropbtn m-4">Filtros</button>
                <div class="dropdown-content">
                    <div class="flex flex-col bg-black/70 rounded-br-xl float-left p-4 ">
                        <h1 class="animated-name text-center text-xl">Ciudades</h1>
                        <div class="m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['sevilla']" id="sevilla" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="sevilla">Sevilla</label>
                        </div>

                        <div class=" m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['malaga']" id="malaga" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="malaga">Málaga</label>
                        </div>

                        <div class="m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['cadiz']" id="cadiz" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="cadiz">Cádiz</label>
                        </div>

                        <div class=" m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['granada']" id="granada" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="granada">Granada</label>
                        </div>

                        <div class="m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['cordoba']" id="cordoba" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="cordoba">Córdoba</label>
                        </div>

                        <div class=" m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['almeria']" id="almeria" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="almeria">Almería</label>
                        </div>

                        <div class="m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['huelva']" id="huelva" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="huelva">Huelva</label>
                        </div>

                        <div class=" m-2 text-white items-center">
                            <input type="checkbox" v-model="ciudades['jaen']" id="jaen" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="jaen">Jaén</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class=" min-[450px]:grid place-items-center">
                <p v-if="empresasFiltradas.length == 0" class="text-white text-center text-xl p-4 mx-4">No hay locales en
                    este lugar.
                    Intentelo de nuevo mas tarde...</p>
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div v-for="empresa in paginatedEmpresas" :key="empresa.id">
                        <nav-link :href="'perfil/' + empresa.id" class="no-underline">
                            <div
                                class="bg-gray-300/20 max-w-sm rounded-sm overflow-hidden shadow-xl shadow-pink-600/40 hover:shadow-blue-500/40 m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-3xl m-3 text-center">{{ empresa.nombre }}</h2>
                                <img v-bind:src="'https://pipartytime.com/storage/empresas/' + empresa.foto"
                                    class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </nav-link>
                    </div>
                </div>
            </div>
            <div class="flex justify-center m-4 text-white">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageFiesta === 1 }">
                            <button class="pagelink hoverpage" @click="previousPageEmpresa">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPagesEmpresa" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageEmpresa }">
                            <button class="pagelink hoverpage" @click="goToPageEmpresa(pageNumber)">{{ pageNumber
                            }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageEmpresa === totalPagesEmpresa }">
                            <button class="pagelink hoverpage" @click="nextPageEmpresa">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>

        </Layout>
    </section>
</template>

<script>
// Import Swiper Vue.js components
// Import Swiper styles
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";
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
            },
            currentPageEmpresa: 1,
            itemsPerPage: 8,

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

        // Paginacion
        previousPageEmpresa() {
            if (this.currentPageEmpresa > 1) {
                this.currentPageEmpresa--;
            }
        },
        //boton siguiente de la paginacion tabla Empresas
        nextPageEmpresa() {
            if (this.currentPageEmpresa < this.totalPagesEmpresa) {
                this.currentPageEmpresa++;
            }
        },
        goToPageEmpresa(pageNumber) {
            this.currentPageEmpresa = pageNumber;
        },
        // Filtros
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
    },

    computed: {
        // Paginacion
        paginatedEmpresas() {
            const startIndex = (this.currentPageEmpresa - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.empresasFiltradas.slice(startIndex, endIndex);
        },
        totalPagesEmpresa() {
            return Math.ceil(this.empresasFiltradas.length / this.itemsPerPage);
        },
    }
};

</script>


<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content div {
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.animated-name {
    animation: colorAnimation 10s infinite;
}

@keyframes colorAnimation {
    0% {
        color: rgb(255, 129, 192);
    }

    50% {
        color: rgb(134, 217, 255);
    }

    100% {
        color: rgb(255, 129, 192);
    }
}
</style>

