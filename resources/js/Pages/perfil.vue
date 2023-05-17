<template>
    <section class="fondolog">
        <Layout>
            <h1 class="text-7xl text-center text-white mt-14 mb-12">{{ empresa.nombre }}</h1>
            <div class="flex flex-wrap justify-center items-center text-center text-white">
                <div class="max-w-xl bg-gray-800/80 rounded-md m-12">
                    <img v-bind:src="'http://[::1]:5173/storage/empresas/' + empresa.foto"
                        class="max-w-sm max-h-sm object-cover p-12" alt="foto perfil">

                </div>
                <div class="w-96 h-80 bg-gray-800/90 rounded-md ">
                    <h2 class="text-2xl mt-2 mb-3">Comentarios</h2>
                    <div class=" overflow-y-auto h-44 mx-4 break-words text-justify	">
                        <div v-for="comentario in orderByDateComent(empresa.comentarios)" :key="comentario.id">
                        <p :class="color[Math.floor(Math.random() * 6)] + ' text-lg'">{{ comentario.nombreusuario }}</p>
                        <p class="text-white">{{ comentario.contenido }}</p>
                    </div>
                    </div>

                    <div class="flex flex-col border-t-2 border-white/50">
                        <input type="text" class="bg-gray-50/0 text-center pt-4" placeholder="Escribir aqui... "
                            v-model="contcomentario">
                        <button @click="comentar" class="mt-2 transition duration-300 hover:scale-110">Comentar</button>
                    </div>
                </div>
            </div>
            <h1 class="text-white text-3xl text-center">ENTRADAS</h1>
            <div class=" min-[450px]:grid place-items-center  border-t-4 border-t-black" id="entradas">
                <div class=" flex flex-wrap justify-center min-[1600px]:grid min-[1600px]:grid-cols-4">
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7  max-[450px]:scale-75"
                        v-for="fiesta in  orderByDate(fiestas)" :key="fiesta.id">
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
                            <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                                delay: 4500,
                                disableOnInteraction: false,
                            }" :pagination="false" :navigation="false" :modules="modules"
                                v-else-if="fiesta.entrada.length > 0">

                                <swiper-slide v-for="e in fiesta.entrada"
                                    class="mySwiper max-[400px]:flex max-[400px]:flex-col" :key="e.id">
                                    <p :class="color[Math.floor(Math.random() * 6)] + ' text-lg'">{{ e.tipo }}</p>
                                    <p class="m-2"> {{ e.consumiciones }} Copas </p>
                                    <p class="m-2"> {{ e.precio }}€ </p>
                                    <div
                                        class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                        <button @click="enviar(e.id)">Reservar</button>
                                    </div>
                                </swiper-slide>
                            </swiper>
                            <p class="flex justify-center items-center text-gray-600 mt-3" v-else>No hay entradas
                                disponibles</P>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    </section>
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

export default {
    components: {
        Swiper,
        SwiperSlide,
        Layout,
        NavLink,
        Link
    },
    data() {
        return {
            showMenu: false,
            color: ['text-blue-600', 'text-pink-600', 'text-red-600', 'text-green-600', 'text-orange-600','text-yellow-600', 'text-violet-600'],
            contcomentario: '',
        };
    },

    props: {
        empresa: Object,
        fiestas: [],
    },
    methods: {
        enviar(id_ent) {
            const id = id_ent
            axios.post('/hacerreserva',{
                'id_entrada':id
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },
        comentar() {
            console.log(this.empresa.id)
            axios.post('/insertacomentario', {
                'contenido': this.contcomentario,
                'id_empresa': this.empresa.id
            }).then(response => {
                console.log(response);
                this.contcomentario = '';
            }).catch(error => {
                console.log(error);
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
        },
        orderByDateComent: function (fiestas) {
            return fiestas.sort(function (a, b) {
                return new Date(b.fecha) - new Date(a.fecha);
            });
        }
    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
};
</script>

<style>
.mySwiper {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>