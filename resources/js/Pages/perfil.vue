<template>
    <section class="entradas">
        <Layout>
            <section class="fondolog
            ">

                <h1 class="animated-name text-7xl text-center text-white pt-14 mb-12">{{ empresa.nombre }}</h1>
                <div class="flex flex-wrap justify-center items-center text-center text-white">
                    <div class="max-w-xl bg-gray-900/90 rounded-md m-12">
                        <img v-bind:src="'https://pipartytime.com/storage/empresas/' + empresa.foto"
                            class=" md:max-w-sm max-h-sm object-cover md:p-12" alt="foto perfil">

                    </div>
                    <div class="w-96 h-96 bg-gray-900/90 rounded-md max-[860px]:mb-8 ">
                        <h2 class="text-2xl mt-2 mb-3">Comentarios</h2>
                        <hr>
                        <div class=" overflow-y-auto h-60 mx-4 break-words text-justify	">
                            <div v-for="comentario in orderByDateComent(empresa.comentarios)" :key="comentario.id">
                                <p :class="color[Math.floor(Math.random() * 6)] + ' text-lg'">{{ comentario.nombreusuario }}
                                </p>
                                <p class="text-white">{{ comentario.contenido }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col border-t-2 border-white/50" v-if="$page.props.auth.user">
                            <input type="text" class="bg-gray-50/0 text-center pt-4" placeholder="Escribir aqui... "
                                v-model="contcomentario">
                            <button @click="comentar" class="mt-2 transition duration-300 hover:scale-110">Comentar</button>
                        </div>
                        <div class="pt-4 mt-6 border-t-2 border-white/50" v-else>
                            Se requiere
                            <nav-link class="linkEntrada" href="/login">Inicia Sesion</nav-link> para comentar
                            <p></p>
                        </div>
                    </div>
                </div>


            </section>

            <section>
                <div class="divUno ">
                    <h1 class="text-white text-4xl mt-4 text-center">ENTRADAS</h1>
                    <p v-if="fiestas.length == 0" class="text-white text-center p-4 mx-4">No hay fiestas disponibles para
                        este local.
                        Vuelva en otro momento</p>
                    <div class="divDos ">
                        <div class="divFiesta shadow-animated" v-for="fiesta in  orderByDate(fiestas)" :key="fiesta.id">
                            <img v-bind:src="'https://pipartytime.com/storage/fiestas/' + fiesta.foto" class="imgFiesta"
                                alt="">
                            <h1 class="h1Fiesta text-pink-600 mb-8">{{ fiesta.empresa.nombre }} -> {{
                                formatdate(fiesta.fecha) }}
                            </h1>
                            <div class="contentFiesta ">
                                <p>Musica:</p>
                                <p>{{ fiesta.musica.nombre }}</p>
                                <p>Tematica:</p>
                                <p>{{ fiesta.tematica.nombre }}</p>
                            </div>
                            <div class="m-2">
                                <h1 class="h1Fiesta ">ENTRADAS</h1>
                                <p class="entradaFiesta" v-if="!$page.props.auth.user">Se requiere
                                    <nav-link class="linkEntrada" href="/login">Inicia Sesion</nav-link> para reservar
                                </p>
                                <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                                    delay: 4500,
                                    disableOnInteraction: false,
                                }" :pagination="false" :navigation="false" :modules="modules"
                                    v-else-if="fiesta.entrada.length > 0">

                                    <swiper-slide v-for="e in fiesta.entrada" class="mySwiper swiperEntrada" :key="e.id">
                                        <p :class="color[Math.floor(Math.random() * 6)] + ' text-lg'">{{ e.tipo }}</p>
                                        <p class="m-2"> {{ e.consumiciones }} Copas </p>
                                        <p class="m-2"> {{ e.precio }}€ </p>
                                        <div class="reservaEntrada ">
                                            <button @click="enviar(e.id)">Reservar</button>
                                        </div>
                                    </swiper-slide>
                                </swiper>
                                <p class="noDisponible" v-else>No hay entradas
                                    disponibles</P>
                            </div>

                        </div>
                    </div>
                </div>

            </section>



        </Layout>
    </section>
</template>


<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css/pagination";
import "swiper/css/navigation";
import { Autoplay, Pagination, Navigation } from "swiper";
// Import Swiper styles
import "swiper/css";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/components/NavLink.vue";
// import required modules
import Layout from '@/components/Layout.vue';
import Swal from 'sweetalert2';

export default {
    components: {
        Swiper,
        SwiperSlide,
        Layout,
        NavLink,
        Link
    },
    data() {
        return {
            showMenu: false,
            color: ['text-blue-600', 'text-pink-600', 'text-red-600', 'text-green-600', 'text-orange-600', 'text-yellow-600', 'text-violet-600'],
            contcomentario: '',
            reservas: [],

        };
    },

    props: {
        empresa: Object,
        fiestas: [],
    },
    methods: {
        // Funcion para realizar reserva
        enviar(id_ent) {
            if (this.reservas.includes(id_ent)) {
                this.showAlertContiene()
            } else {
                const id = id_ent
                axios.post('/hacerreserva', {
                    'id_entrada': id
                }).then(response => {
                    // console.log(response);
                    this.showAlert()
                    this.reservas.push(id_ent)
                }).catch(error => {
                    // console.log(error);
                });
            }
        },
        // Funciones con los alert que se muestran al realizar alguna accion

        showAlert() {
            Swal.fire({
                title: 'Reserva Realizada!',
                text: 'Puedes visualizar la reserva en MIS RESERVAS.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertError() {
            Swal.fire({
                title: 'Error de Validación!',
                text: 'El comentario solo puede contener numeros y letras.',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertContiene() {
            Swal.fire({
                title: 'Entrada ya reservada!',
                text: 'No se ha realizado la reserva debido a que ya se encontraba reservada.',
                icon: 'error',
                confirmButtonColor: '#1a202c'
            });
        },
        showAlertComentario() {
            Swal.fire({
                title: 'Comentario Realizada!',
                text: 'Tu comentario se ha realizado correctamente.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
            });
        },
        // Funcion para realizar un comentario
        comentar() {
            // console.log(this.empresa.id)
            if (this.contcomentario != '' && (/^[A-Za-z0-9.,!\s]+$/.test(this.contcomentario))) {
                axios.post('/insertacomentario', {
                    'contenido': this.contcomentario,
                    'id_empresa': this.empresa.id
                }).then(response => {
                    // console.log(response);
                    this.contcomentario = '';
                    this.showAlertComentario();
                    this.empresa.comentarios.push(response.data)

                }).catch(error => {
                    // console.log(error);
                });
            } else {
                this.showAlertError()
            }

        },
        // Funciones de la fecha y ordenado de los elementos de la pagina
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
        },
        orderByDateComent: function (fiestas) {
            return fiestas.sort(function (a, b) {
                return new Date(b.fecha) - new Date(a.fecha);
            });
        }
    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
    mounted(){
        axios.get('/reservasusuario')
            .then(response => {
                this.reservas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    }
};
</script>

<style>
.mySwiper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.shadow-animated {
    animation: shadow-pulse 10s infinite;
}

@keyframes shadow-pulse {
    0% {
        box-shadow: 0 10px 13px 0px rgba(219, 39, 93, 0.637);
    }

    50% {
        box-shadow: 0 10px 13px 0px rgb(0, 68, 170);
    }

    100% {
        box-shadow: 0 10px 13px 0px rgba(219, 39, 93, 0.637);
    }
}



/* .animated-name {
  transition: color 0.5s ease;
} */

.animated-name {
    animation: colorAnimation 10s infinite;
}

@keyframes colorAnimation {
    0% {
        color: rgba(255, 0, 128, 0.514);
    }

    50% {
        color: rgba(0, 89, 255, 0.699);
    }

    100% {
        color: rgba(255, 0, 128, 0.514);
    }
}
</style>

