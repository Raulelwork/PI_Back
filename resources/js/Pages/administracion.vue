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
<template>
    <section class="fondolog">
        <Layout>
            <div>
                <h1 class="text-4xl text-center mt-12 text-white">ADMINISTRACION</h1>
                <NavLink href="/crearent" :active="$page.component === 'CrearEntrada'">Crear Entrada</NavLink>
            </div>
            <div class=" max-w-lg flex mx-auto m-12">
                <table class="text-sm text-gray-500 dark:text-gray-400 bg-white/70 rounded-md">
                    <thead class="text-xs text-gray-700 uppercase  dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Dia Entrada
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Música
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Temática
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4">
                                Silver
                            </td>
                            <td class="px-6 py-4">
                                Laptop
                            </td>
                            <td class="px-6 py-4">
                                $2999
                            </td>
                            <td class="px-6 py-4 hover:bg-gray-600/20 ">
                                <button><img src="../../img/eliminar.png" class="w-8" alt=""></button>
                            </td>
                        </tr>
                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Microsoft Surface Pro
                            </th>
                            <td class="px-6 py-4">
                                White
                            </td>
                            <td class="px-6 py-4">
                                Laptop PC
                            </td>
                            <td class="px-6 py-4">
                                $1999
                            </td>
                            <td class="px-6 py-4 hover:bg-gray-600/20 ">
                                <button><img src="../../img/eliminar.png" class="w-8" alt=""></button>
                            </td>
                        </tr>
                        <tr class=" dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Magic Mouse 2
                            </th>
                            <td class="px-6 py-4">
                                Black
                            </td>
                            <td class="px-6 py-4">
                                Accessories
                            </td>
                            <td class="px-6 py-4">
                                $99
                            </td>
                            <td class="px-6 py-4 hover:bg-gray-600/20 ">
                                <button><img src="../../img/eliminar.png" class="w-8" alt=""></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </Layout>
    </section>
</template>

<style></style>
