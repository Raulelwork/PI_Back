<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="bg-gray-300">
        <Layout>
            <section class="flex max-[768px]:flex-col justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 m-4 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Musica</h1>
                    <form action="">

                        <div class="m-2">
                            <label for="Nombre">Nombre</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="nombreMusica">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviarmusica">Crear Musica</button>
                    </form>
                </div>

                <div class=" max-w-md justify-center text-white text-center mt-8 m-4 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Tematica</h1>
                    <form action="">

                        <div class="m-2">
                            <label for="Nombre">Nombre</label>
                            <br>
                            <input
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200"
                                type="text" v-model="nombreTematica">
                        </div>
                        <button
                            class="decoration-0 m-4 px-3 py-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200"
                            @click.prevent="enviartematica">Crear Tematica</button>
                    </form>
                </div>
            </section>


            <h1 class="text-3xl text-black text-center my-8">Gestionar Comentarios</h1>
            <table class="min-[600px]:min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <td class="th">Nombre</td>
                        <td class="th">Fecha</td>
                        <td class="th">Contenido</td>
                        <td class="th">Eliminar</td>


                    </tr>
                </thead>
                <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1 "
                    v-for="(comentario, index) in paginatedComentarios" :key="comentario.id">
                    <tr>
                        <td class="td"><span class="mobile">Nombre</span> {{ comentario.nombre }}</td>
                        <td class="td"><span class="mobile">Fecha</span> {{ formatearFecha(comentario.fecha) }}</td>
                        <td class="td"><span class="mobile">Contenido</span>
                            <p>{{ comentario.contenido }}</p>
                        </td>
                        <td class="td"><span class="mobile">Eliminar</span>
                            <button @click="eliminarcomentario(comentario.id)">
                                <img src="../../img/icon/borrar.png" class="w-6 m-auto" alt="">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center mt-4">
                <nav>
                    <ul class="flex justify-center list-none p-0">
                        <li class="pageitem" :class="{ disabled: currentPageComentario === 1 }">
                            <button class="pagelink" @click="previousPageComentario">Anterior</button>
                        </li>
                        <li class="pageitem" v-for="pageNumber in totalPagesComentario" :key="pageNumber"
                            :class="{ active: pageNumber === currentPageComentario }">
                            <button class="pagelink" @click="goToPageComentario(pageNumber)">{{ pageNumber }}</button>
                        </li>
                        <li class="pageitem" :class="{ disabled: currentPageComentario === totalPagesComentario }">
                            <button class="pagelink" @click="nextPageComentario">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>

            <h1 class="text-3xl text-black text-center my-8">Gestionar Empresas</h1>
            <table class="min-[600px]:min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr
                        class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <td class="th">Nombre</td>
                        <td class="th">Propietario</td>
                        <td class="th">Cif</td>
                        <td class="th">Ubicacion</td>
                        <td class="th">Eliminar</td>


                    </tr>
                </thead>
                <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1 "
                    v-for="(empresa, index) in paginatedEmpresas" :key="empresa.id">
                    <tr>
                        <td class="td"><span class="mobile">Nombre</span> {{ empresa.nombre }}</td>
                        <td class="td"><span class="mobile">Dueño</span> {{ empresa.propietario }}</td>
                        <td class="td"><span class="mobile">Cif</span> {{ empresa.cif }}</td>
                        <td class="td"><span class="mobile">Lugar</span> {{ empresa.ubicacion }}</td>

                        <td class="td"><span class="mobile">Eliminar</span>
                            <button @click="eliminarempresa(empresa.id)">
                                <img src="../../img/icon/borrar.png" class="w-6 m-auto" alt="">
                            </button>
                        </td>
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
            nombreMusica: '',
            nombreTematica: '',
            comentarios: [],
            empresas: [],
            currentPageComentario: 1,
            currentPageEmpresa: 1,
            itemsPerPageEmpresa: 5,
            itemsPerPage: 10,
            id_comentario: '',
            id_empresa: '',
        };
    },

    methods: {
        // Funcion para eliminar comentarios
        eliminarcomentario(id_comentario) {
            axios.post('/eliminarcomentario', {
                'id': id_comentario
            }).then(response => {
                for (var i = 0; i < this.comentarios.length; i++) {
                    if (this.comentarios[i].id == id_comentario) {
                        this.comentarios.splice(i, 1);
                    }
                }
            }).catch(error => {
            });
        },


        // Funcion para eliminar empresas
        eliminarempresa(id_empresa) {
            axios.post('/eliminarempresa', {
                'id': id_empresa
            }).then(response => {
                for (var i = 0; i < this.empresas.length; i++) {
                    if (this.empresas[i].id == id_empresa) {
                        this.empresas.splice(i, 1);
                    }
                }
            }).catch(error => {
            });
        },

        // Paginacion de las tablas
        previousPageComentario() {
            if (this.currentPageComentario > 1) {
                this.currentPageComentario--;
            }
        },
        //boton siguiente de la paginacion tabla Comentarios
        nextPageComentario() {
            if (this.currentPageComentario < this.totalPagesComentario) {
                this.currentPageComentario++;
            }
        },
        goToPageComentario(pageNumber) {
            this.currentPageComentario = pageNumber;
        },
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

        // Formulario para crear musica
        enviarmusica() {
            const formData = new FormData();
            formData.append('nombre', this.nombreMusica);
            if (this.nombreMusica == '' || (!/^[A-Za-z\s]+$/.test(this.nombreMusica))) {
                this.showAlertError()
            } else {
                axios.post('/crearmusica', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.showAlertMusica()
                    this.nombreMusica = ''
                }).catch(error => {
                });
            }
        },

        // Formulario para crear tematica
        enviartematica() {
            const formData = new FormData();
            if (this.nombreTematica == '' || (!/^[A-Za-z\s]+$/.test(this.nombreTematica))) {
                this.showAlertError()

            } else {
                formData.append('nombre', this.nombreTematica);

                axios.post('/creartematica', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.showAlertTematica()
                    this.nombreTematica = ''
                }).catch(error => {
                });
            }
        },


        // Los showalert son los mensajes de confirmacion al realizar alguna accion.
        showAlertError() {
            Swal.fire({
                title: 'Error de validacion',
                text: 'El nombre solo puede contener letras.',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertMusica() {
            Swal.fire({
                title: 'Musica Creada!',
                text: 'Tu musica se ha creado correctamente.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertTematica() {
            Swal.fire({
                title: 'Tematica Creada!',
                text: 'Tu tematica se ha creado correctamente.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },

        // Funcino para dar formato a la fecha
        formatearFecha(fecha) {
            const dateObj = new Date(fecha);
            const dia = dateObj.getDate().toString().padStart(2, '0');
            const mes = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            const anio = dateObj.getFullYear().toString();
            return `${dia}-${mes}-${anio}`;
        },

    },
    // Peticiones para mostrar los datos
    mounted() {
        axios.get('/listarcomentarios')
            .then(response => {
                this.comentarios = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listarallempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });

    },


    computed: {
        // Funciones para paginacion
        paginatedComentarios() {
            const startIndex = (this.currentPageComentario - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.comentarios.slice(startIndex, endIndex);
        },
        totalPagesComentario() {
            return Math.ceil(this.comentarios.length / this.itemsPerPage);
        },
        paginatedEmpresas() {
            const startIndex = (this.currentPageEmpresa - 1) * this.itemsPerPageEmpresa;
            const endIndex = startIndex + this.itemsPerPageEmpresa;
            return this.empresas.slice(startIndex, endIndex);
        },
        totalPagesEmpresa() {
            return Math.ceil(this.empresas.length / this.itemsPerPageEmpresa);
        },
    }
};



</script>