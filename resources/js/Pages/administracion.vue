<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';


export default {
    components: { NavLink, Link, Layout },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            empresas: [],
            entradas: [],
            fiesta_elegida: '',
            entrada_elegida: '',
        };
    },
    mounted() {
        axios.get('/listarfiestas')
            .then(response => {
                this.fiestas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listarempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        axios.get('/listarentradas')
            .then(response => {
                this.entradas = response.data;
            })
            .catch(error => {
                console.log(error);
            });

    },
    methods: {
        enviar() {
            const formData = new FormData();
            formData.append('entrada_elegida', this.fiesta_elegida);

            axios.post('/eliminarentrada', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },

    }
};



</script>

<template>
    <section class="bg-gray-300">
        <Layout>
            <div>
                <h1 class="text-4xl text-center mt-12 text-blue-600">ADMINISTRACION</h1>
            </div>
            <div class="flex justify-center mt-4 ">
                <NavLink href="/crearempresa" class="text-white hover:text-gray-300 m-4">Añadir Empresa</NavLink>
                <NavLink href="/crearfiesta" class="text-white hover:text-gray-300 m-4">Crear Fiesta</NavLink>
                <NavLink href="/crearent" class="text-white hover:text-gray-300 m-4">Crear Entrada</NavLink>

            </div>
            
            <div class=" flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1>FIESTAS</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Id</td>
                            <td class="th">Nombre Empresa</td>
                            <td class="th">Fecha</td>
                            <td class="th">Eliminar</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group" v-for="f in fiestas.filter(f=> f.empresa.id_usuario == $page.props.auth.user.id)" :key="f.id">
                        <tr class="">
                            <td class="td"><span class="span">Email</span> {{ f.empresa.id }}</td>
                            <td class="td"><span class="span">Email</span> {{ f.empresa.nombre }}</td>
                            <td class="td"><span class="span">Fecha</span>{{ f.fecha }}</td>
                            <td class="td"><span class="span">Eliminar</span><img src="../../img/icon/borrar.png" class="w-6 m-auto" alt=""></td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class=" my-12 flex justify-center items-center flex-col  text-center text-black min-[600px]:mx-48">
                <h1>Entradas</h1>
                <table class="min-[600px]:min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <td class="th">Tipo</td>
                            <td class="th">Fecha Fiesta</td>
                            <td class="th">Empresa</td>
                            <td class="th">Eliminar</td>

                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group" v-for="f in fiestas.filter(f=> f.empresa.id_usuario == $page.props.auth.user.id)" :key="f.id">
                        <tr class="" v-for="entr in f.entrada" :key="entr.id">
                            <td class="td"><span class="span">Email</span> {{ entr.tipo }}</td>
                            <td class="td"><span class="span">Fecha</span>{{ f.fecha }}</td>
                            <td class="td"><span class="span">Empresa</span>{{ f.empresa.nombre }}</td>
                            <td class="td"><span class="span">Eliminar</span><img src="../../img/icon/borrar.png" class="w-6 m-auto" alt=""></td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </Layout>
    </section>
</template>

<style>


</style>
