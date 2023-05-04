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
<script setup>
import Layout from '@/components/Layout.vue';
</script>
<template>
    <section class="fondolog">
        <Layout>
            <div>
                <h1 class="text-4xl text-center mt-12 text-white">ADMINISTRACION</h1>
            </div>
            <div class="flex justify-center mt-4 ">
                <NavLink href="/crearent" class="text-white hover:text-gray-300 m-4">Añadir Empresa</NavLink>
                <NavLink href="/crearent" class="text-white hover:text-gray-300 m-4">Crear Fiesta</NavLink>
                <NavLink href="/crearent" class="text-white hover:text-gray-300 m-4">Crear Entrada</NavLink>

            </div>
            <div class="w-full overflow-x-auto text-center">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Edad</th>
                            <th class="px-4 py-2">País</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">hola</td>
                            <td class="border px-4 py-2">como</td>
                            <td class="border px-4 py-2">estas</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </Layout>
    </section>
</template>

<style></style>
