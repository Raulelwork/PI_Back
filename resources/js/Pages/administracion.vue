

<template>
    <section class="bg-gray-300">
        <Layout v-if="$page.props.auth.user.tipo == 'empresa'">
            <div>
                <h1 class="text-4xl text-center mt-12 text-blue-600">ADMINISTRACION</h1>
            </div>
            <div class="flex justify-center mt-4 ">
                <NavLink href="/crearempresa" class="text-white hover:text-gray-300 m-4">Añadir Empresa</NavLink>
                <NavLink href="/crearfiesta" class="text-white hover:text-gray-300 m-4">Crear Fiesta</NavLink>
                <NavLink href="/crearent" class="text-white hover:text-gray-300 m-4">Crear Entrada</NavLink>

            </div>

            <div class=" flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1>FIESTAS</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Nombre Empresa</td>
                            <td class="th">Fecha</td>
                            <td class="th">Eliminar</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group"
                        v-for="(f, index) in paginatedFiestas" :key="f.id">
                        <tr class="">
                            <td class="td"><span class="span">Nombre</span> {{ f.empresa.nombre }}</td>
                            <td class="td"><span class="span">Fecha</span>{{ f.fecha }}</td>
                            <td class="td">
                                <button @click="eliminarfiesta(f.id)">
                                    <img src="../../img/icon/borrar.png" class="w-6 m-auto" alt="">
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <div class="flex justify-center mt-4">
                    <nav>
                        <ul class="flex justify-center list-none p-0">
                            <li class="pageitem" :class="{ disabled: currentPage === 1 }">
                                <button class="pagelink" @click="previousPage">Anterior</button>
                            </li>
                            <li class="pageitem" v-for="pageNumber in totalPages" :key="pageNumber"
                                :class="{ active: pageNumber === currentPage }">
                                <button class="pagelink" @click="goToPage(pageNumber)">{{ pageNumber }}</button>
                            </li>
                            <li class="pageitem" :class="{ disabled: currentPage === totalPages }">
                                <button class="pagelink" @click="nextPage">Siguiente</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class=" my-12 flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1>Entradas</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Tipo</td>
                            <td class="th">Fecha Fiesta</td>
                            <td class="th">Empresa</td>
                            <td class="th">Eliminar</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group"
                        v-for="(f, index) in paginatedEntradas"
                        :key="f.id">
                        <tr class="" v-for="entr in f.entrada" :key="entr.id">
                            <td class="td"><span class="span">Email</span> {{ entr.tipo }}</td>
                            <td class="td"><span class="span">Fecha</span>{{ f.fecha }}</td>
                            <td class="td"><span class="span">Empresa</span>{{ f.empresa.nombre }}</td>
                            <td class="td">
                                <button @click="eliminarentrada(entr.id)">
                                    <img src="../../img/icon/borrar.png" class="w-6 m-auto" alt="">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    <nav>
                        <ul class="flex justify-center list-none p-0">
                            <li class="pageitem" :class="{ disabled: currentPageEntrada === 1 }">
                                <button class="pagelink" @click="previousPageEntrada">Anterior</button>
                            </li>
                            <li class="pageitem" v-for="pageNumber in totalPagesEntrada" :key="pageNumber"
                                :class="{ active: pageNumber === currentPageEntrada }">
                                <button class="pagelink" @click="goToPageEntrada(pageNumber)">{{ pageNumber }}</button>
                            </li>
                            <li class="pageitem" :class="{ disabled: currentPageEntrada === totalPagesEntrada }">
                                <button class="pagelink" @click="nextPageEntrada">Siguiente</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </Layout>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';
import { ref, watchEffect } from 'vue';
import { reactive } from '@vue/reactivity'


export default {
    components: { NavLink, Link, Layout, ref },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            empresas: [],
            entradas: [],
            fiesta_elegida: '',
            entrada_elegida: '',

            currentPage: 1,
            currentPageEntrada: 1,
            itemsPerPage: 5,

        };
    },
    mounted() {
        // axios.get('/listarfiestas')
        //     .then(response => {
        //         this.fiestas = response.data;
        //     })
        //     .catch(error => {
        //         console.log(error);
        //     });
        axios.get('/listarempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listarentradas')
            .then(response => {
                this.entradas = response.data;
            })
            .catch(error => {
                console.log(error);
            });

    },
    methods: {

        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        //boton siguiente de la paginacion tabla reservas
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToPage(pageNumber) {
            this.currentPage = pageNumber;
        },
        
        
        previousPageEntrada() {
            if (this.currentPageEntrada > 1) {
                this.currentPageEntrada--;
            }
        },
        //boton siguiente de la paginacion tabla reservas
        nextPageEntrada() {
            if (this.currentPageEntrada < this.totalPagesEntrada) {
                this.currentPageEntrada++;
            }
        },
        goToPageEntrada(pageNumber) {
            this.currentPageEntrada = pageNumber;
        },




        eliminarentrada(id_entrada) {
            axios.post('/eliminarentrada', {
                'id_entrada': id_entrada
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },
        eliminarfiesta(id_fiesta) {
            axios.post('/eliminarfiesta', {
                'id_fiesta': id_fiesta
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },

    },
    computed: {
        
        paginatedFiestas() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.fiestas.slice(startIndex, endIndex);
        },
        paginatedEntradas() {
            const startIndex = (this.currentPageEntrada - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.fiestas.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPages() {
            return Math.ceil(this.fiestas.length / this.itemsPerPage);
        },
        totalPagesEntrada() {
            return Math.ceil(this.fiestas.length / this.itemsPerPage);
        },
    },
    setup() {
        const fiestas = ref([])
        watchEffect(() => {
            axios.get('/listarfiestas')
                .then(response => {
                    fiestas.value = response.data;
                    console.log(fiestas);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
            axios.get('/listarfiestas')
                .then(response => {
                    entradas.value = response.data;
                    console.log(entradas);
                })
                .catch(error => {
                    console.log('Error al obtener los datos:', error);
                });
        });
        return {
            fiestas
        }
    }
};



</script>
