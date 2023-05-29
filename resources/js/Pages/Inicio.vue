<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";


export default {
    components: { NavLink, Link },
    data() {
        return {
            showMenu: false,
        };
    },
};

</script>
<script setup>
    import Layout from '@/components/Layout.vue';
</script>
<template>
    <div id="fondo ">
        <Layout>
            <div class="text-center text-white ">
                <h1 class="text-4xl mt-16 mb-36">Bienvenido a Party Time</h1>
                <img id="animate-spin-slow" class="animate-spin mx-auto block w-96 max-[750px]:w-60" src="../../img/logopng.png" alt="logo">
                <div class=" mt-40 text-2xl text-white bg-pink-900/40 mx-96 max-[900px]:mx-0 rounded-md" id="texto">
                    <p>Reserva ya tu entrada y no te quedes fuera!</p>
                </div>

                <div>
                    <NavLink href="/fiestas"
                        class="no-underline hover:no-underline">
                        <button
                            class="mt-10 mb-20 border-2 rounded-md bg-pink-600/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200 p-1"
                            id="enlace">
                            IR A FIESTAS
                        </button>
                    </NavLink>
                </div>

            </div>
        </Layout>
    </div>
</template>

<style>
body {
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
}

@media (min-width: 1290px) {
    body {
    background-image: url(../../img/neon.jpg);
}
}
    
@media (max-width: 1288px) {
    body {
    background-image: url(../../img/movil.jpg);
}
    
}


#animate-spin-slow {
    animation: spin 10s linear infinite;
}


</style>