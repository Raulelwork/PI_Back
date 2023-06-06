
<template>
    <div id="menu">
        <div class="bg-white">
            <nav class="
                        container
                        px-6
                        py-4
                        mx-auto
                        md:flex md:justify-between md:items-center
            
                      ">
                <div class="flex items-center justify-between">
                    <NavLink href="/" :active="$page.component === 'Home'">
                        <img src="../../img/logopng.png" class="w-14" alt="">
                    </NavLink>

                    <!-- Mobile menu button -->
                    <div @click="showMenu = !showMenu" class="flex md:hidden">
                        <button type="button" class="
                              text-gray-900
                              hover:text-gray-400
                              focus:outline-none focus:text-gray-700
                            ">
                            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                                <path fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>


                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <ul :class="showMenu ? 'flex' : 'hidden'" class="
                          flex-col
                          mt-8
                          space-y-4
                          md:flex
                          md:space-y-0
                          md:flex-row
                          md:items-center
                          md:space-x-10
                          md:mt-0
              
                        ">

                    <li class=" text-cyan-600 text-lg hover:text-black ">
                        <NavLink href="/locales" :active="$page.component === 'locales'">Locales</NavLink>
                    </li>
                    <li class=" text-cyan-600 text-lg hover:text-black">
                        <NavLink href="/fiestas" :active="$page.component === 'entradas'" class="hover:border-gray-300">
                            Fiestas</NavLink>
                    </li>
                    <li class=" text-cyan-600 text-lg hover:text-black" v-if="$page.props.auth.user">
                        <NavLink href="/reservas" :active="$page.component === 'reservas'" class="hover:border-gray-300">Mis
                            reservas</NavLink>
                    </li>
                    <li class=" text-cyan-600 text-lg hover:text-black" v-if="$page.props.auth.user">
                        <div v-if="$page.props.auth.user.tipo == 'empresa'">
                            <NavLink href="/administracion" :active="$page.component === 'administracion'"
                                class="hover:border-gray-300">Administracion
                            </NavLink>
                        </div>

                    </li>
                    <li class=" text-cyan-600 text-lg hover:text-black" v-if="$page.props.auth.user">
                        <div v-if="$page.props.auth.user.id == 1">
                            <NavLink href="/control" :active="$page.component === 'control'"
                                class="hover:border-gray-300">Control
                            </NavLink>
                        </div>

                    </li>


                    <li class=" text-cyan-600 text-lg hover:text-black" v-if="!$page.props.auth.user">
                        <NavLink href="/login" :active="$page.component === 'login'" class="hover:border-gray-300">Login
                        </NavLink>
                    </li>
                    <li class=" text-cyan-600 text-lg hover:text-black">
                        <NavLink href="/register" :active="$page.component === 'registrarse'" v-if="!$page.props.auth.user"
                            class="hover:border-gray-300">
                            Registrarse</NavLink>
                    </li>

                    <li>
                        <div class="ml-3 relative float-right" v-if="$page.props.auth.user != null">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.nombre }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')"> Perfil </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Cerrar Sesion
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </li>
                </ul>

            </nav>
        </div>


    </div>
</template>
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
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);
</script>




<!-- <style>
    #menu{
        position: -webkit-sticky;
        position: sticky;
        top: 0;
    }

</style> -->