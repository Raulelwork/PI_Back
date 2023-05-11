
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
            fiestas: [],
            empresas: [],
        };
    }, methods: {
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
                        <nav-link :href="'perfil/'+empresa.id">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">{{ empresa.nombre }}</h2>
                                <img v-bind:src="'http://[::1]:5173/storage/empresas/' + empresa.foto" class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </nav-link>
                    </swiper-slide>
                </swiper>

            </div>
            <div class=" min-[450px]:grid place-items-center  border-t-4 border-t-black" id="entradas">
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7  max-[450px]:scale-75"
                        v-for="fiesta in fiestas" :key="fiesta.id">
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
                            <p class="flex justify-center items-center mt-3" v-if="!$page.props.auth.user">Se requiere  <nav-link class="hover:text-blue-500 no-underline hover:scale-105 text-pink-600 mx-3" href="/login">Inicia Sesion</nav-link> para reservar</p>
                            <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                                delay: 4500,
                                disableOnInteraction: false,
                            }" :pagination="false" :navigation="false" :modules="modules"
                                v-else-if="fiesta.entrada.length > 0">

                                <swiper-slide v-for="e in fiesta.entrada"
                                    class="mySwiper max-[400px]:flex max-[400px]:flex-col" :key="e.id">
                                    <p class="m-2 text-pink-600 text-lg">{{ e.tipo }}</p>
                                    <p class="m-2"> {{ e.consumiciones }} Copas </p>
                                    <p class="m-2"> {{ e.precio }}€ </p>
                                    <div
                                        class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                        <button>Reservar</button>
                                    </div>
                                </swiper-slide>
                            </swiper>
                            <p class="flex justify-center items-center text-gray-600 mt-3" v-else>No hay entradas
                                disponibles</P>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

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

/* .tarjeta {
    @apply bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg m-7;
}

.tar-img {
    @apply mb-4 w-full;
}

.tar-cont {
    @apply grid grid-cols-2 text-left text-black ml-10;
}

.tar-pie {
    @apply flex justify-between;
}

.tar-precio {
    @apply m-3 ml-8 text-lg inline-block
}

.tar-fecha {
    @apply m-3 text-lg inline-block;
}

.tar-button {
    @apply float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover: bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg
} */
</style>
