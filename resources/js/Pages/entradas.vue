<!-- <script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";
import "swiper/css/navigation";

// import required modules
import { Autoplay, Pagination, Navigation } from "swiper";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
};
</script> -->

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
                    <swiper-slide class="mySwiper">
                        <a href="">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">Mae West</h2>
                                <img src="../../img/locales/MaeWest.jpg" class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </a>

                    </swiper-slide>

                    <swiper-slide class="mySwiper">
                        <a href="">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">G10</h2>
                                <img src="../../img/locales/g10.jpg" class="mb-4 w-72" alt="">
                            </div>

                        </a>

                    </swiper-slide>


                    <swiper-slide class="mySwiper">
                        <a href="">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">Basaba</h2>
                                <img src="../../img/locales/basabaa.jpg" class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </a>

                    </swiper-slide>


                    <swiper-slide class="mySwiper">
                        <a href="">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">Parabarap</h2>
                                <img src="../../img/locales/parabara.jpg" class="mb-4 w-72 h-72" alt="">
                            </div>
                        </a>

                    </swiper-slide>

                </swiper>

            </div>
            <div class="grid place-items-center  border-t-4 border-t-black" id="entradas">
                <h1 class="text-white bg-black/90 p-3 rounded-sm text-3xl mt-4 text-center">ENTRADAS RECIENTES
                </h1>
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7 ">
                        <!-- <h2 class="text-black text-4xl m-3 text-center">Mae West</h2> -->
                        <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-full" alt="">
                        <div class="grid grid-cols-2 text-left text-black ml-10">
                            <p>Musica:</p>
                            <p>Variada</p>

                            <p>Tematica:</p>
                            <p>Navidad</p>

                        </div>
                        <div class="flex justify-between">
                            <p class="m-3 ml-8  text-lg inline-block">10€</p>
                            <p class="m-3   text-lg inline-block">16/04/23</p>
                            <div
                                class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7 ">
                        <!-- <h2 class="text-black text-4xl m-3 text-center">Mae West</h2> -->
                        <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-full" alt="">
                        <div class="grid grid-cols-2 text-left text-black ml-10">
                            <p>Musica:</p>
                            <p>Variada</p>

                            <p>Tematica:</p>
                            <p>Navidad</p>

                        </div>
                        <div class="flex justify-between">
                            <p class="m-3 ml-8  text-lg inline-block">10€</p>
                            <p class="m-3   text-lg inline-block">16/04/23</p>
                            <div
                                class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7 ">
                        <!-- <h2 class="text-black text-4xl m-3 text-center">Mae West</h2> -->
                        <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-full" alt="">
                        <div class="grid grid-cols-2 text-left text-black ml-10">
                            <p>Musica:</p>
                            <p>Variada</p>

                            <p>Tematica:</p>
                            <p>Navidad</p>

                        </div>
                        <div class="flex justify-between">
                            <p class="m-3 ml-8  text-lg inline-block">10€</p>
                            <p class="m-3   text-lg inline-block">16/04/23</p>
                            <div
                                class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7 ">
                        <!-- <h2 class="text-black text-4xl m-3 text-center">Mae West</h2> -->
                        <img src="../../img/locales/basaba.jpg" class="mb-4 w-full" alt="">
                        <div class="grid grid-cols-2 text-left text-black ml-10">
                            <p>Musica:</p>
                            <p>Variada</p>

                            <p>Tematica:</p>
                            <p>Navidad</p>

                        </div>
                        <div class="flex justify-between">
                            <p class="m-3 ml-8  text-lg inline-block">10€</p>
                            <p class="m-3   text-lg inline-block">16/04/23</p>
                            <div
                                class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7 ">
                        <!-- <h2 class="text-black text-4xl m-3 text-center">Mae West</h2> -->
                        <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-full" alt="">
                        <div class="grid grid-cols-2 text-left text-black ml-10">
                            <p>Musica:</p>
                            <p>Variada</p>

                            <p>Tematica:</p>
                            <p>Navidad</p>

                        </div>
                        <div class="flex justify-between">
                            <p class="m-3 ml-8  text-lg inline-block">10€</p>
                            <p class="m-3   text-lg inline-block">16/04/23</p>
                            <div
                                class="float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg justify-end ">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </section>
    </Layout>
</template>

<style>
/* body {
    background-image: url(../../img/fondo.jpg);
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    justify-content: space-between;
} */

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

.tarjeta{
    @apply bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7;
}

.tar-img{
    @apply mb-4 w-full;
}
.tar-cont{
    @apply grid grid-cols-2 text-left text-black ml-10;
}

.tar-pie{
    @apply flex justify-between;
}
.tar-precio{
    @apply m-3 ml-8  text-lg inline-block
}
.tar-fecha{
    @apply m-3 text-lg inline-block;
}
.tar-button{
    @apply float-right px-3 m-2 border-2 rounded-xl border-blue-600 hover:bg-blue-700/80 duration-300 hover:scale-105 text-white bg-blue-500/80 text-lg
}
</style>
