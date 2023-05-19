
<template>
    <section class="fondoreserva">
        <Layout>
            <div class=" min-[450px]:grid place-items-center border-t-black">
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div v-for="fiesta in  orderByDate(fiestas)" :key="fiesta.id"
                        class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7  max-[450px]:scale-75">
                        <img v-bind:src="'http://[::1]:5173/storage/fiestas/' + fiesta.foto"
                            class="mb-4 w-full h-80 object-cover" alt="">
                        <h1 class="text-lg text-center">{{ fiesta.empresa.nombre }} -> {{ formatdate(fiesta.fecha)
                        }}</h1>
                        <div class=" grid grid-cols-2 text-left text-black justify-items-center items-center">
                            <p>Tipo Entrada:</p>
                            <p>{{ fiesta.entradaactual.tipo }}</p>
                            <p>Consumiciones:</p>
                            <p>{{ fiesta.entradaactual.consumiciones }}</p>
                            <p>Precio:</p>
                            <p>{{ fiesta.entradaactual.precio }}€</p>
                            <p>Musica:</p>
                            <p>{{ fiesta.musica.nombre }}</p>
                            <p>Tematica:</p>
                            <p>{{ fiesta.tematica.nombre }}</p>
                        </div>

                        <div class=" m-2 text-center">
                            <button @click="eliminar(fiesta.entradaactual.id)" class="  rounded-md transition duration-300 hover:scale-125">
                                <img src="../../img/icon/no.png" class="w-12  m-4" alt="Cancelar">
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </Layout>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "../components/NavLink.vue";
import Layout from '@/components/Layout.vue';
import { ref } from 'vue';


export default {
    components: { NavLink, Link, Layout, ref },
    data() {
        return {
            showMenu: false,
            fiestas: [],
        };
    },
    mounted() {

        axios.get('/reservasdeusuario')
            .then(response => {
                this.fiestas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    },
    methods: {
        eliminar(id_ent) {
            const id = id_ent;
            axios.post('/eliminarreserva',{
                'id_entrada':id
            }).then(response => {
                // console.log(response);
                for(var i = 0; i < this.fiestas.length; i++){
                    for( var e = 0; e < this.fiestas[i].entrada.length; e++){
                        if(this.fiestas[i].entrada[e].id == id){
                            this.fiestas.splice(i, 1);
                        }
                    }
                }
                // window.location.replace("/reservas")
            }).catch(error => {
                // console.log(error);
            });
        },
        formatdate(dateTimeString) {
            return this.formatearFecha(dateTimeString.slice(0, 10));
        },
        formatearFecha(fecha) {
            const dateObj = new Date(fecha);
            const dia = dateObj.getDate().toString().padStart(2, '0');
            const mes = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            const anio = dateObj.getFullYear().toString();
            return `${dia}-${mes}-${anio}`;
        },
        orderByDate: function (fiestas) {
            return fiestas.sort(function (a, b) {
                return new Date(a.fecha) - new Date(b.fecha);
            });
        }
    }
}
</script>

<style>
.image-button {
  position: relative;
  overflow: hidden;
  border: none;
  background: none;
  padding: 0;
  cursor: pointer;
}

.image-button img {
  position: absolute;
  top: 0;
  left: 0;
}

.img-reserva {
  z-index: 1;
}

.img-x {
  z-index: 2;
}
</style>