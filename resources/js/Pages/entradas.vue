

<template>
    <Layout>
        <section>
            <div class="border-t-4 border-t-pink-600" id="discotecas">
                <h1
                    class="text-white p-3 rounded-sm text-5xl mt-4 max-[1120px]:mx-0 max-[1120px]:text-4xl  text-center mx-96">
                    LOCALES MAS DEMANDADOS
                </h1>
                <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                    delay: 2500,
                    disableOnInteraction: false,
                }" :pagination="{
    clickable: true,
}" :navigation="false" :modules="modules" class="mySwiper">
                    <swiper-slide class="mySwiper" v-for="empresa in empresas" :key="empresa.id">
                        <nav-link :href="'perfil/' + empresa.id">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">{{ empresa.nombre }}</h2>
                                <img v-bind:src="'http://[::1]:5173/storage/empresas/' + empresa.foto"
                                    class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </nav-link>
                    </swiper-slide>
                </swiper>

            </div>
            <div class="divUno " id="entradas">
                <div class="divDos ">
                    <div class="divFiesta"
                        v-for="fiesta in  orderByDate(fiestas)" :key="fiesta.id">
                        <img v-bind:src="'http://[::1]:5173/storage/fiestas/' + fiesta.foto"
                            class="imgFiesta" alt="">
                        <h1 class="h1Fiesta">{{ fiesta.empresa.nombre }} -> {{ formatdate(fiesta.fecha) }}</h1>
                        <div class="contentFiesta ">
                            <p>Musica:</p>
                            <p>{{ fiesta.musica.nombre }}</p>
                            <p>Tematica:</p>
                            <p>{{ fiesta.tematica.nombre }}</p>
                        </div>
                        <div class="m-2">
                            <h1 class="h1Fiesta ">ENTRADAS</h1>
                            <p class="entradaFiesta" v-if="!$page.props.auth.user">Se requiere
                                <nav-link class="linkEntrada"
                                    href="/login">Inicia Sesion</nav-link> para reservar
                            </p>
                            <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                                delay: 4500,
                                disableOnInteraction: false,
                            }" :pagination="false" :navigation="false" :modules="modules"
                                v-else-if="fiesta.entrada.length > 0">

                                <swiper-slide v-for="e in fiesta.entrada"
                                    class="mySwiper swiperEntrada" :key="e.id">
                                    <p :class="color[Math.floor(Math.random() * 6)] + ' text-lg'">{{ e.tipo }}</p>
                                    <p class="m-2"> {{ e.consumiciones }} Copas </p>
                                    <p class="m-2"> {{ e.precio }}€ </p>
                                    <div
                                        class="reservaEntrada ">
                                            <button @click="enviar(e.id)">Reservar</button>
                                    </div>
                                </swiper-slide>
                            </swiper>
                            <p class="noDisponible" v-else>No hay entradas
                                disponibles</P>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css/pagination";
import "swiper/css/navigation";
import { Autoplay, Pagination, Navigation } from "swiper";
// Import Swiper styles
import "swiper/css";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";
// import required modules
import Layout from '@/components/Layout.vue';
import Swal from 'sweetalert2';


export default {
    components: {
        Swiper,
        SwiperSlide,
        Layout,
        NavLink,
        Link,
    },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            empresas: [],
            id_entrada: '',
            color: ['text-blue-600', 'text-pink-600', 'text-red-600', 'text-green-600', 'text-purple-600', 'text-violet-600'],
        };
    }, methods: {
        enviar(id_ent) {
            const id = id_ent
            axios.post('/hacerreserva',{
                'id_entrada':id
            }).then(response => {
                console.log(response);
                this.showAlert()
            }).catch(error => {
                console.log(error);
            });
        },
        showAlert() {
            Swal.fire({
                title: 'Reserva Realizada!',
                text: 'Puedes visualizar la reserva en MIS RESERVAS.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
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
    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
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

        axios.get('/listarallempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },


};

</script>

<style>
#discotecas {
    background-image: url(../../img/fondodisc2.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}

#entradas {
    background-image: url(../../img/back5.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
}

.mySwiper {
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
