

<template>
    <section class="bg-gray-300">
        <Layout v-if="$page.props.auth.user.tipo == 'empresa'">
            <div>
                <h1 class="text-4xl text-center mt-12 text-blue-600">ADMINISTRACION</h1>
            </div>
            <div class="flex justify-center mt-4 text-gray-600">
                <NavLink href="/crearempresa" class="hover:text-gray-300 m-4">Añadir Empresa</NavLink>
                <NavLink href="/crearfiesta" class="hover:text-gray-300 m-4">Crear Fiesta</NavLink>
                <NavLink href="/crearent" class="hover:text-gray-300 m-4">Crear Entrada</NavLink>
                <NavLink href="/editafiesta" class="hover:text-gray-300 m-4">Editar Fiesta</NavLink>

            </div>


            <div class=" flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48  my-12 ">
                <h1 class="text-3xl">EMPRESAS</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Nombre Empresa</td>
                            <td class="th">Ciudad</td>
                            <td class="th">Lugar</td>
                            <td class="th">Cif</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1"
                        v-for="(empresa, index) in paginatedEmpresas" :key="empresa.id">
                        <tr>
                            <td class="td"><span class="mobile">Nombre</span> {{ empresa.nombre }}</td>
                            <td class="td"><span class="mobile">Ciudad</span> {{ empresa.ubicacion }}</td>
                            <td class="td"><span class="mobile">Lugar</span> {{ empresa.lugar }}</td>
                            <td class="td"><span class="mobile">Cif</span>{{ empresa.cif }}</td>

                        </tr>
                    </tbody>

                </table>
                <div class="flex justify-center mt-4">
                    <nav>
                        <ul class="flex justify-center list-none p-0">
                            <li class="pageitem" :class="{ disabled: currentPageEmpresa === 1 }">
                                <button class="pagelink" @click="previousPageEmpresa">Anterior</button>
                            </li>
                            <li class="pageitem" v-for="pageNumber in totalPagesEmpresa" :key="pageNumber"
                                :class="{ active: pageNumber === currentPageEmpresa }">
                                <button class="pagelink" @click="goToPageEmpresa(pageNumber)">{{ pageNumber }}</button>
                            </li>
                            <li class="pageitem" :class="{ disabled: currentPageEmpresa === totalPagesEmpresa }">
                                <button class="pagelink" @click="nextPageEmpresa">Siguiente</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class=" flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1 class="text-3xl">FIESTAS</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Nombre Empresa</td>
                            <td class="th">Musica</td>
                            <td class="th">Tematica</td>
                            <td class="th">Fecha</td>
                            <td class="th">Reservas</td>
                            <td class="th">Eliminar</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1"
                        v-for="(f, index) in orderByDate(paginatedFiestas)" :key="f.id">
                        <tr>
                            <td class="td"><span class="mobile">Nombre</span> {{ f.empresa.nombre }}</td>
                            <td class="td"><span class="mobile">Musica</span> {{ f.musica.nombre }}</td>
                            <td class="td"><span class="mobile">Tematica</span> {{ f.tematica.nombre }}</td>
                            <td class="td"><span class="mobile">Fecha</span>{{ f.fecha }}</td>
                            <td class="td"><span class="mobile">Reservas</span>
                                <nav-link :href="'listadoreserva/' + f.id">
                                    <img src="../../img/icon/listado.png" class="w-6 m-auto" alt="">

                                </nav-link>

                            </td>
                            <td class="td"><span class="mobile">Eliminar</span>
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
                <h1 class="text-3xl">ENTRADAS</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Tipo</td>
                            <td class="th">Precio</td>
                            <td class="th">Consumicion</td>
                            <td class="th">Entradas Restantes</td>
                            <td class="th">Entradas Iniciales</td>
                            <td class="th">Fecha Fiesta</td>
                            <td class="th">Empresa</td>
                            <td class="th">Eliminar</td>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1 "
                        v-for="(entrada, index) in paginatedEntradas" :key="entrada.id">
                        <tr>
                            <td class="td"><span class="mobile">Tipo</span> {{ entrada.tipo }}</td>
                            <td class="td"><span class="mobile">Precio</span> {{ entrada.precio }}</td>
                            <td class="td"><span class="mobile">Copas</span> {{ entrada.consumiciones }}</td>
                            <td class="td"><span class="mobile">Copas</span> {{ entrada.aforo }}</td>
                            <td class="td"><span class="mobile">Copas</span> {{ entrada.aforoinicial }}</td>
                            <td class="td"><span class="mobile">Fecha</span> {{ entrada.fecha }}</td>
                            <td class="td"><span class="mobile">Empresa</span> {{ entrada.empresa }}</td>

                            <td class="td">
                                <button @click="eliminarentrada(entrada.id)">
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
            entradas: [],
            empresas: [],
            fiesta_elegida: '',
            entrada_elegida: '',

            currentPage: 1,
            currentPageEntrada: 1,
            currentPageEmpresa: 1,
            itemsPerPage: 5,

        };
    },

    methods: {
        // Funcion para ordenar las fiestas por fechas
        orderByDate: function (fiestas) {
            return fiestas.sort(function (a, b) {
                return new Date(a.fecha) - new Date(b.fecha);
            });
        },
        // Paginacion
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        //boton siguiente de la paginacion tabla fiestas
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
        //boton siguiente de la paginacion tabla entradas
        nextPageEntrada() {
            if (this.currentPageEntrada < this.totalPagesEntrada) {
                this.currentPageEntrada++;
            }
        },
        goToPageEntrada(pageNumber) {
            this.currentPageEntrada = pageNumber;
        },
        previousPageEmpresa() {
            if (this.currentPageEmpresa > 1) {
                this.currentPageEmpresa--;
            }
        },
        //boton siguiente de la paginacion tabla empresas
        nextPageEmpresa() {
            if (this.currentPageEmpresa < this.totalPagesEmpresa) {
                this.currentPageEmpresa++;
            }
        },
        goToPageEmpresa(pageNumber) {
            this.currentPageEmpresa = pageNumber;
        },

        // Funcion para eliminar entradas
        eliminarentrada(id_entrada) {
            axios.post('/eliminarentrada', {
                'id_entrada': id_entrada
            }).then(response => {
                for (var i = 0; i < this.entradas.length; i++) {
                    if (this.entradas[i].id == id_entrada) {
                        this.entradas.splice(i, 1);
                    }
                }
            }).catch(error => {
            });
        },
        // Funcion para eliminar fiestas
        eliminarfiesta(id_fiesta) {
            axios.post('/eliminarfiesta', {
                'id_fiesta': id_fiesta
            }).then(response => {
                for (var i = 0; i < this.fiestas.length; i++) {
                    if (this.fiestas[i].id == id_fiesta) {
                        this.fiestas.splice(i, 1);
                    }
                }
            }).catch(error => {
            });
        },
    },
    computed: {
        // Paginacion
        paginatedFiestas() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.fiestas.slice(startIndex, endIndex);
        },
        paginatedEntradas() {
            const startIndex = (this.currentPageEntrada - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.entradas.slice(startIndex, endIndex);
        },
        paginatedEmpresas() {
            const startIndex = (this.currentPageEmpresa - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.empresas.slice(startIndex, endIndex);
        },
        //total de pagina 
        totalPages() {
            return Math.ceil(this.fiestas.length / this.itemsPerPage);
        },
        totalPagesEntrada() {
            return Math.ceil(this.entradas.length / this.itemsPerPage);
        },
        totalPagesEmpresa() {
            return Math.ceil(this.empresas.length / this.itemsPerPage);
        },
    },
    setup() {
        // Funcion para mostrar datos
        const fiestas = ref([])
        const entradas = ref([])
        const empresas = ref([])
        watchEffect(() => {
            axios.get('/listarfiestasad')
                .then(response => {
                    fiestas.value = response.data;
                })
                .catch(error => {
                    // console.log('Error al obtener los datos:', error);
                });
            axios.get('/listarentradasad')
                .then(response => {
                    entradas.value = response.data;
                })
                .catch(error => {
                    // console.log('Error al obtener los datos:', error);
                });
            axios.get('/listarempresas')
                .then(response => {
                    empresas.value = response.data;
                })
                .catch(error => {
                    // console.log('Error al obtener los datos:', error);
                });
        });
        return {
            fiestas,
            entradas,
            empresas
        }
    }
};



</script>
