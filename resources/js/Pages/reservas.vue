
<template>
    <section class="fondoreserva">
        <Layout>
            <h1 class="text-3xl text-center text-white mt-10 mb-4">MIS RESERVAS</h1>
            <div class="text-center text-gray-400">
                <p class="mb-1"> ¡Aviso!</p>
                <p class="w-minh">
                    Para comprobar una reserva es necesario tenerla
                     descargada en PDF a la hora de acceder al local
                </p>
            </div>
            <div class=" min-[450px]:grid place-items-center border-t-black">
                <div class=" flex flex-wrap justify-center min-[1400px]:grid min-[1400px]:grid-cols-4">
                    <div v-for="entrada in  orderByDate(entradas)" :key="entrada.id"
                        class="bg-white/90 max-w-sm rounded-t-xl overflow-hidden shadow-lg  m-7">
                        <img v-bind:src="'https://pipartytime.com/storage/fiestas/' + entrada.foto"
                            class="mb-4 w-full h-80 object-cover" alt="">
                        <h1 class="text-lg text-center text-pink-600">{{ entrada.nombreempresa }} -> {{
                            formatdate(entrada.fecha)
                        }}</h1>
                        <div class=" grid grid-cols-2 text-left text-black justify-items-center items-center">
                            <p>Tipo Entrada:</p>
                            <p>{{ entrada.tipo }}</p>
                            <p>Consumiciones:</p>
                            <p>{{ entrada.consumiciones }}</p>
                            <p>Precio:</p>
                            <p>{{ entrada.precio }}€</p>
                            <p>Musica:</p>
                            <p>{{ entrada.musica }}</p>
                            <p>Tematica:</p>
                            <p>{{ entrada.tematica }}</p>
                        </div>

                        <div class=" m-2 text-center">
                            <button @click="eliminar([entrada.id, entrada.idreserva])"
                                class="  rounded-md transition duration-300 hover:scale-125">
                                <img src="../../img/icon/no.png" class="w-12  m-4" alt="Cancelar">
                            </button>
                            <button @click="descargarPDF(entrada.idreserva)"
                                class="  rounded-md transition duration-300 hover:scale-125">
                                <img src="../../img/icon/descargar.png" class="w-12  m-4" alt="Cancelar">
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
import Swal from 'sweetalert2';


export default {
    components: { NavLink, Link, Layout, ref },
    data() {
        return {
            showMenu: false,
            entradas: [],
        };
    },
    mounted() {

        axios.get('/reservasdeusuario')
            .then(response => {
                this.entradas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    },
    methods: {
        // Funciones con los alert que se muestran al realizar alguna accion
        descargarPDF(id_reserva) {
            axios.get('/pdfreserva/'+id_reserva, { responseType: 'blob' })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'reservaPartyTime.pdf');
                    document.body.appendChild(link);
                    link.click();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        showAlert() {
            Swal.fire({
                title: 'Reserva Eliminada!',
                text: 'Tu reserva se ha eliminado con exito.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
        // Funcion para eliminar reserva
        eliminar(array) {
            const id = array[1];
            const id_entrada = array[0];
            axios.post('/eliminarreserva', {
                'id': id,
                'id_entrada': id_entrada
            }).then(response => {
                // console.log(response);
                for (var i = 0; i < this.entradas.length; i++) {
                    if (this.entradas[i].idreserva == id) {
                        this.entradas.splice(i, 1);
                    }
                }
                this.showAlert()
                // window.location.replace("/reservas")
            }).catch(error => {
                // console.log(error);
            });
        },
        // Funciones para la fechas
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
        orderByDate: function (entradas) {
            return entradas.sort(function (a, b) {
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