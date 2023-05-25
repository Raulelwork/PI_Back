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


            <h1 class="text-3xl text-black text-center">Gestionar Comentarios</h1>
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
                        <td class="td"><span class="mobile">Contenido</span> <p>{{ comentario.contenido }}</p></td>
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
            nombreMusica: '',
            nombreTematica: '',
            comentarios: [],
            currentPageComentario: 1,
            itemsPerPage: 10,
            id_comentario:'',
        };
    },

    methods: {
        eliminarcomentario(id_comentario){
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

        enviarmusica() {
            const formData = new FormData();
            formData.append('nombre', this.nombreMusica);

            axios.post('/crearmusica', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
            }).catch(error => {
            });
        },
        formatearFecha(fecha) {
            const dateObj = new Date(fecha);
            const dia = dateObj.getDate().toString().padStart(2, '0');
            const mes = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            const anio = dateObj.getFullYear().toString();
            return `${dia}-${mes}-${anio}`;
        },
        enviartematica() {
            const formData = new FormData();
            formData.append('nombre', this.nombreTematica);

            axios.post('/creartematica', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
            }).catch(error => {
            });
        },
    },
    mounted() {
        axios.get('/listarcomentarios')
            .then(response => {
                this.comentarios = response.data;
            })
            .catch(error => {
                // console.log(error);
            });

    },
    computed: {

        paginatedComentarios() {
            const startIndex = (this.currentPageComentario - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.comentarios.slice(startIndex, endIndex);
        },
        totalPagesComentario() {
            return Math.ceil(this.comentarios.length / this.itemsPerPage);
        },
    }
};



</script>