
<template>
    <section class="fondoreserva">
        <Layout>
            <div>
                <div>
                    <div>

                    </div>
                </div>
            </div>

            <div v-for="reserva in reservas.filter(reserva => reserva.id_entrada == entrada.id)" :key="reserva.id">

            </div>


            <div class=" min-[450px]:grid place-items-center  border-t-4 border-t-black" id="entradas">
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7  max-[450px]:scale-75"
                        v-for="fiesta in  orderByDate(fiestas)" :key="fiesta.id">
                        <div v-for="entrada in fiesta.entrada" :key="entrada.id">


                        </div>
                        <img v-bind:src="'http://[::1]:5173/storage/fiestas/' + fiesta.foto"
                            class="mb-4 w-full h-80 object-cover" alt="">
                        <h1 class="text-lg text-center">{{ fiesta.empresa.nombre }} -> {{ formatdate(fiesta.fecha) }}</h1>
                        <div class=" grid grid-cols-2 text-left text-black justify-items-center items-center">
                            <p>Musica:</p>
                            <p>{{ fiesta.musica.nombre }}</p>
                            <p>Tematica:</p>
                            <p>{{ fiesta.tematica.nombre }}</p>
                        </div>
                        <div class="m-2">
                            <h1 class="text-base text-center">ENTRADAS</h1>
                            <p class="flex justify-center items-center mt-3" v-if="!$page.props.auth.user">Se requiere
                                <nav-link class="hover:text-blue-500 no-underline hover:scale-105 text-pink-600 mx-3"
                                    href="/login">Inicia Sesion</nav-link> para reservar
                            </p>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-black hover:bg-red-700 duration-100 hover:text-xl text-white bg-blue-500/80 text-lg ml-14  mr-14">
                                <button>
                                    <div class="relative">
                                        <p class="text-white hover:text-white">Reservado</p>
                                        <p
                                            class="absolute inset-0 text-white hover:bg-red-700 opacity-0 hover:opacity-100 transition duration-100">
                                            Cancelar
                                        </p>
                                    </div>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>



        </Layout>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';
import { ref } from 'vue';


export default {
    components: { NavLink, Link, Layout, ref },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            reservas: [],
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

        axios.get('/listarreservas')
            .then(response => {
                this.reservas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
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
        }
    }
}
</script>
