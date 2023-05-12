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
    background-image: url(../../img/fondlo.jpg);
    @apply bg-no-repeat bg-center	bg-cover bg-fixed
}

.trImpar {
    @apply bg-gray-300 border border-gray-500 md:border-none block md:table-row;
}

.trPar {
    @apply bg-white border border-gray-500 md:border-none block md:table-row;
}

.td {
    @apply p-2 m-auto md:border md:border-gray-500 block md:table-cell;
}

.span {
    @apply inline-block w-1/4 md:hidden font-bold;
}

.th {
    @apply bg-gray-600 p-2 max-[750px]:hidden md:border md:border-gray-500 text-white md:table-cell;
}

</style>