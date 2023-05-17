

<template>
    <Layout>
        <section>
            <div class="border-t-4 border-t-pink-600">

                <!-- <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
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
                </swiper> -->

            </div>
            <div class=" min-[450px]:grid place-items-center  border-t-4 border-t-black" id="entradas">
                <h1
                    class="text-white p-3 rounded-sm text-5xl mt-4 max-[1120px]:mx-0 max-[1120px]:text-4xl  text-center mx-96">
                    LOCALES
                </h1>
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div v-for="empresa in empresas" :key="empresa.id" >
                        <nav-link :href="'perfil/' + empresa.id" class="no-underline">
                            <div
                                class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500  hover:scale-110">
                                <h2 class="text-white text-4xl m-3 text-center">{{ empresa.nombre }}</h2>
                                <img v-bind:src="'http://[::1]:5173/storage/empresas/' + empresa.foto"
                                    class="mb-4 object-cover h-72 w-72 " alt="">
                            </div>
                        </nav-link>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script>
// Import Swiper Vue.js components
// Import Swiper styles
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";
// import required modules
import Layout from '@/components/Layout.vue';


export default {
    components: {
        Layout,
        NavLink,
        Link,
    },
    data() {
        return {
            showMenu: false,
            empresas: [],
        };
    },
    mounted() {

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
#entradas {
    background-image: url(../../img/back5.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
}
</style>
