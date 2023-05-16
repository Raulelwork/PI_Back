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

::-webkit-scrollbar {
    display: none;
}

#cuerpo {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.fondolog{
    @apply bg-no-repeat bg-center	bg-cover bg-fixed;
    background-image: url(../../img/fondlo.jpg);
}

.fondoreserva{
    @apply bg-no-repeat bg-center	bg-cover bg-fixed;
    background-image: url(../../img/back5.jpg);
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

.span {
    @apply inline-block w-1/4 md:hidden text-pink-600 font-bold mr-4;
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

</style>