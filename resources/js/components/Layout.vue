<template>
    <header>
        <navegador />
    </header>
    <section id="cuerpo">
        <div>
            <slot />
        </div>
        <div>
            <pie />
        </div>
    </section>
</template>
<script>


import navegador from "./header.vue";
import pie from "./footer.vue";
import { Head } from "@inertiajs/vue3";

export default {
    components: { navegador, Head, pie },

    // props: { username: String }

    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}

</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');

* {
    font-family: 'Righteous';
}

/* Personalizar el scrollbar */
/* Webkit (Safari, Chrome, Opera) */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-thumb {
  background-color: #818181;
  border-radius: 5px;
}

::-webkit-scrollbar-track {
  background-color: #000;
  border-radius: 5px;
}

/* Firefox */
/* Utiliza la pseudo-clase "-moz" */
* {
  scrollbar-width: thin;
  scrollbar-color: #818181 #000;
}

/* Estilos adicionales para Firefox */
* {
  scrollbar-width: thin;
  scrollbar-color: #818181 #000;
}

/* Estilos adicionales para Microsoft Edge */
* {
  scrollbar-width: thin;
  scrollbar-color: #818181 #000;
}

/* Estilos adicionales para Internet Explorer */
* {
  scrollbar-width: thin;
  scrollbar-color: #818181 #000;
}




/* ::-webkit-scrollbar {
    display: none;
} */

#cuerpo {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.hoverpage{
    @apply transition duration-100 hover:text-gray-500 
}


.fondolog{
    @apply bg-no-repeat bg-center	bg-cover bg-fixed;
    background-image: url(../../img/fondlo.jpg);

}

.fondoreserva{
    @apply bg-no-repeat bg-center	bg-cover bg-fixed;
    background-image: url(../../img/back5.jpg);
}
.entradas{
    @apply bg-no-repeat bg-center	bg-cover bg-fixed;
    background-image: url(../../img/back5.jpg);
}

/* Estilos de las fiestas  */
.divUno{
    @apply min-[450px]:grid place-items-center;
}
.divDos{
    @apply flex flex-wrap justify-center min-[1600px]:grid min-[1600px]:grid-cols-4;
}
.divFiesta{
    @apply bg-white/90 max-w-sm rounded-t-xl overflow-hidden m-7 sm:scale-95 lg:scale-100;
}
.imgFiesta{
    @apply mb-4 w-full h-80 object-cover;
}
.h1Fiesta{
    @apply text-lg flex justify-center;
}
.contentFiesta{
    @apply grid grid-cols-2 text-left text-black justify-items-center items-center;
}
/* Estilos entradas de las fiestas */
.entradaFiesta{
    @apply flex justify-center items-center mt-3 ;
}

.linkEntrada{
    @apply hover:text-blue-500 no-underline hover:scale-105 text-pink-600 mx-3 ;
}

.swiperEntrada{
    @apply flex max-[400px]:flex-col bg-gray-300 border-2 border-black rounded-xl justify-center items-center;
}

.reservaEntrada{
    @apply float-right px-3 m-2 border-2 rounded-xl border-pink-600/80 hover:bg-pink-600/80 bg-white duration-300 hover:text-white hover:scale-105 text-pink-600/80  text-lg justify-end;
}

.noDisponible{
    @apply flex justify-center items-center text-gray-600 mt-3;
}




.trImpar {
    @apply bg-gray-300 border border-gray-500 md:border-none block md:table-row;
}

.trPar {
    @apply bg-white border border-gray-500 md:border-none block md:table-row;
}

.td {
    @apply m-4  md:border md:border-gray-500 block md:table-cell text-left min-[765px]:text-center;
}

.mobile {
    @apply inline-block w-1/4 md:hidden text-pink-600 font-bold mr-6;
}

.th {
    @apply bg-gray-600 p-2 text-white max-[750px]:hidden md:border md:border-gray-500 text-left block md:table-cell;
}

.pagelink {
    @apply block m-1 cursor-pointer;
}

.pageitem {
    @apply block m-1 cursor-pointer;
}


.mySwiper {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>