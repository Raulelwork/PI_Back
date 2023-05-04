<template>
    <section >
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Login</h1>
                    <form action="">
                        <div class="mt-8">
                            <input type="text" id="correo" title="Correo" placeholder="Correo"
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200">
                        </div>
                        <div class="mt-8">
                            <input type="password" title="Contraseña" id="password" placeholder="Contraseña"
                                class=" w-48 h-8 rounded-md  text-gray-300 bg-gray-600 text-center placeholder:text-gray-400 hover:scale-105 duration-200">
                        </div>
                        <div class="mt-6">
                            <button
                                class="m-4 p-2 border-2 rounded-md bg-pink-900/80 text-white hover:bg-pink-800/80 hover:scale-110 duration-200">
                                Iniciar Sesion
                            </button>
                        </div>

                    </form>

                    <NavLink href="/recuperar" class="no-underline hover:no-underline">
                        <p
                            class="m-4 p-2 border-2 rounded-md bg-pink-900/80 text-white hover:scale-110 hover:bg-pink-800/80 duration-200">
                            Recuperar Contraseña</p>
                    </NavLink>


                    <NavLink href="/registro" class="no-underline hover:no-underline">
                        <p
                            class="decoration-0 m-4 p-2 border-2 rounded-md bg-pink-900/80 hover:bg-pink-800/80 text-white hover:scale-110 duration-200">
                            Registrarse -≻
                        </p>
                    </NavLink>
                </div>
            </section>
        </Layout>
    </section>
</template>

<style scoped>
input::placeholder {
    text-align: center;
}

</style>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../Shared/NavLink.vue";


export default {
    components: { NavLink, Link },
    data() {
        return {
            showMenu: false,
            usuario:'',
            password:'',
        };
    },
    

};
</script>