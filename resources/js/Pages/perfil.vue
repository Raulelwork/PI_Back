<script setup>
    import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog bg-fixed bg-no-repeat bg-center bg-cover">
        <Layout>
            <h1 class="text-7xl text-center text-white mt-14 mb-12">Mae West</h1>
            <div class="flex flex-wrap justify-center items-center text-center text-white">
                <div class="max-w-xl bg-gray-800/80 rounded-md m-12">
                    <img src="../../img/locales/MaeWest.jpg" class="max-w-xs p-12" alt="foto perfil">
                </div>
                <div class="w-96 h-80 bg-gray-800/90 rounded-md ">
                    <h2 class="text-2xl mt-2 mb-3">Comentarios</h2>
                    <div class=" overflow-y-auto h-44 mx-4 break-words text-justify	">
                        <p> También puede cambiar la apariencia del texto, mover rápidamente frases y párrafos, así como
                            copiar y pegar texto en el documento y entre documentos. </p>
                        <p> También puede cambiar la apariencia del texto, mover rápidamente frases y párrafos, así como
                            copiar y pegar texto en el documento y entre documentos. </p>
                        <p> También puede cambiar la apariencia del texto, mover rápidamente frases y párrafos, así como
                            copiar y pegar texto en el documento y entre documentos. </p>
                        <p> También puede cambiar la apariencia del texto, mover rápidamente frases y párrafos, así como
                            copiar y pegar texto en el documento y entre documentos. </p>
                        <p> También puede cambiar la apariencia del texto, mover rápidamente frases y párrafos, así como
                            copiar y pegar texto en el documento y entre documentos. </p>
                    </div>
                    <!-- <form action="">
                        <div class="flex flex-col border-t-2 border-white/50">
                            <input type="text" class="bg-gray-50/0 text-center pt-4" placeholder="Escribir aqui... ">
                            <button class="my-3">Enviar</button>
                        </div>
                    </form> -->
                    <form action="">
                        <div class="flex flex-col border-t-2 border-white/50">
                            <input type="text" class="bg-gray-50/0 text-center pt-4" placeholder="Escribir aqui... ">
                            <button class="my-3">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <div class="grid place-items-center mt-28">
                    <h1 class="text-white bg-black/70 p-3 rounded-lg text-3xl mt-4 text-center">ENTRADAS</h1>
                    <div class="items-stretch grow flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                        <div class="bg-white/80 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div
                                class="flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14  mr-14">
                                <button>Reservar</button>
                            </div>
                        </div>
                        <div class="bg-white/90 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 ">
                            <h2 class="text-black text-4xl m-3 text-center">Mae West</h2>
                            <img src="../../img/locales/MaeWest.jpg" class="mb-4 w-72" alt="">
                            <div class="grid grid-cols-2 text-left text-black ml-10">
                                <p>Musica:</p>
                                <p>Tematica:</p>
                                <p>Precio:</p>
                                <p>Fecha: 16/04/23</p>

                            </div>
                            <div class="reservar">
                                <button>Reservar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </Layout>
    </section>
</template>

<style>
.reservar {
    @apply flex justify-center m-2 border-2 rounded-xl border-cyan-900 hover:bg-cyan-700 duration-300 hover:text-xl text-white bg-cyan-600 text-lg ml-14 mr-14;
}
</style>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";


export default {
    components: { NavLink, Link },
    data() {
        return {
            showMenu: false,
        };
    },
};
</script>