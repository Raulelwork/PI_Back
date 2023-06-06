
<template>
    <section class="bg-gray-300">
        <Layout v-if="$page.props.auth.user.id == id_seguridad">
            <div class="text-center">
                <h1 class="text-3xl text-pink-600 mt-8 mb-2">{{ nombre_empresa }}</h1>
                <h1 class="text-lg text-blue-600 mb-1">{{ formatdate(fecha_fiesta) }} </h1>
                <h2 class="text-lg text-blue-600 mb-1"> Musica {{musica}} </h2>
                <h2 class="text-lg text-blue-600 mb-1"> Tematica {{tematica}} </h2>
            </div>

            <div class=" my-12 flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1 class="text-3xl">Lista de reservas</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Tipo Entrada</td>
                            <td class="th">DNI</td>
                            <td class="th">Nombre</td>
                            <td class="th">Apellidos</td>
                            <td class="th">Telefono</td>
                            <td class="th">Correo</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group max-[765px]:border-2 border-black mb-1 "
                        v-for="(reserva, index) in paginatedReservas" :key="reserva.nombre">
                        <tr>
                            <td class="td"><span class="mobile">Tipo</span> {{ reserva.tipo_entrada }}</td>
                            <td class="td"><span class="mobile">DNI</span> {{ reserva.dni }}</td>
                            <td class="td"><span class="mobile">Nombre</span> {{ reserva.nombre }}</td>
                            <td class="td"><span class="mobile">Apellidos</span> {{ reserva.apellidos }}</td>
                            <td class="td"><span class="mobile">Telefono</span> {{ reserva.telefono }}</td>
                            <td class="td"><span class="mobile">Email</span> {{ reserva.email }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    <nav>
                        <ul class="flex justify-center list-none p-0">
                            <li class="pageitem" :class="{ disabled: currentPageReserva === 1 }">
                                <button class="pagelink" @click="previousPageReserva">Anterior</button>
                            </li>
                            <li class="pageitem" v-for="pageNumber in totalPagesReserva" :key="pageNumber"
                                :class="{ active: pageNumber === currentPageReserva }">
                                <button class="pagelink" @click="goToPageReserva(pageNumber)">{{ pageNumber }}</button>
                            </li>
                            <li class="pageitem" :class="{ disabled: currentPageReserva === totalPagesReserva }">
                                <button class="pagelink" @click="nextPageReserva">Siguiente</button>
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
import NavLink from "@/components/NavLink.vue";
import Layout from '@/components/Layout.vue';

export default {
    components: {
        Layout,
        NavLink,
        Link
    },
    data() {
        return {
            showMenu: false,
            currentPageReserva: 1,
            itemsPerPage: 10,
        };
    },

    props: {
        reservas: [],
        id_seguridad: '',
        nombre_empresa: '',
        musica: '',
        tematica: '',
        fecha_fiesta: ''
    },
    methods: {
        // Paginacion
        previousPageReserva() {
            if (this.currentPageReserva > 1) {
                this.currentPageReserva--;
            }
        },
        //boton siguiente de la paginacion tabla Reservas
        nextPageReserva() {
            if (this.currentPageReserva < this.totalPagesReserva) {
                this.currentPageReserva++;
            }
        },
        goToPageReserva(pageNumber) {
            this.currentPageReserva = pageNumber;
        },
        // Funciones para la fecha
        formatdate(dateTimeString) {
            return this.formatearFecha(dateTimeString.slice(0, 10));
        },
        formatearFecha(fecha) {
            const dateObj = new Date(fecha);
            const dia = dateObj.getDate().toString().padStart(2, '0');
            const mes = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            const anio = dateObj.getFullYear().toString();
            return `${dia}-${mes}-${anio}`;
        },
        orderByDate: function (fiestas) {
            return fiestas.sort(function (a, b) {
                return new Date(a.fecha) - new Date(b.fecha);
            });
        },

    }, 
    computed: {
        // Paginacion
        paginatedReservas() {
            const startIndex = (this.currentPageReserva - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.reservas.slice(startIndex, endIndex);
        },
        totalPagesReserva() {
            return Math.ceil(this.reservas.length / this.itemsPerPage);
        },
    }

};
</script>
