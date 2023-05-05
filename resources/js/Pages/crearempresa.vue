<template>
    <section class="fondolog">
        <Layout>
            <section class="flex justify-center mt-14">
                <div class=" max-w-md justify-center text-white text-center mt-8 bg-gray-800/90 rounded-md p-12">
                    <h1 class="text-3xl text-white">Crear Entrada</h1>
                    <form @submit.prevent="submit">
                        <div>
                            <label for="nombre">Nombre</label>
                            <input class="text-black" type="text" v-model="nombre">
                        </div>
                        <div>
                            <label for="cif">Cif</label>
                            <input class="text-black" type="text" v-model="cif">
                        </div>
                        <div>
                            <label for="foto">Foto:</label>
                            <input type="file" id="foto" ref="fotoInput" @change="cargarFoto" accept="image/*">
                        </div>
                        <button @click.prevent="enviar">Enviar</button>



                    </form>
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
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';


export default {
    components: { Layout, NavLink, Link },
    data() {
        return {
            showMenu: false,
            nombree: '',
            cif: '',
            foto: null,
        };
    },
    methods: {
        cargarFoto() {
        this.foto = this.$refs.fotoInput.files[0];

        },
        enviar() {
            const formData = new FormData();
            formData.append('foto', this.foto);
            formData.append('nombre', this.nombre);
            formData.append('cif', this.cif);
            console.log(formData)
            axios.post('/crearempresa', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        },
    },

};
</script>