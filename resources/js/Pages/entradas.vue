

<template>
    <section class="entradas">

        <Layout>
            <section>
                <div class="border-t-4 border-t-pink-600" id="discotecas">
                    <h1
                        class="text-white p-3 rounded-sm text-5xl mt-4 max-[1120px]:mx-0 max-[1120px]:text-4xl  text-center mx-96">
                        LOCALES MAS DEMANDADOS
                    </h1>
                    <swiper :spaceBetween="30" :centeredSlides="true" :autoplay="{
                        delay: 2500,
                        disableOnInteraction: false,
                    }" :pagination="{
    clickable: true,
}" :navigation="false" :modules="modules" class="mySwiper">
                        <swiper-slide class="mySwiper" v-for="empresa in empresas" :key="empresa.id">
                            <nav-link :href="'perfil/' + empresa.id">
                                <div
                                    class="bg-black/60 max-w-sm rounded-sm overflow-hidden shadow-lg  m-7 p-4 transition duration-500 hover:scale-110">
                                    <h2 class="text-white text-4xl m-3 text-center">{{ empresa.nombre }}</h2>
                                    <img v-bind:src="'https://pipartytime.com/storage/empresas/' + empresa.foto"
                                        class="mb-4 object-cover h-72 w-72 " alt="">
                                </div>
                            </nav-link>
                        </swiper-slide>
                    </swiper>

                </div>
                <section>
                    <div
                        class="flex flex-col bg-black/70 rounded-br-xl min-[650px]:float-left p-4 overflow-y-auto h-96 w-44 ">
                        <h1 class="text-white text-center text-2xl">Filtros</h1>
                        <hr class="mb-4">

                        <h1 class="text-white text-center text-xl">Ciudades</h1>
                        <div class="m-2 text-blue-400 items-center">
                            <input type="checkbox" v-model="ciudades['sevilla']" id="sevilla" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="sevilla">Sevilla</label>
                        </div>

                        <div class=" m-2 text-pink-400 items-center">
                            <input type="checkbox" v-model="ciudades['malaga']" id="malaga" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="malaga">Málaga</label>
                        </div>

                        <div class="m-2 text-blue-400 items-center">
                            <input type="checkbox" v-model="ciudades['cadiz']" id="cadiz" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="cadiz">Cádiz</label>
                        </div>

                        <div class=" m-2 text-pink-400 items-center">
                            <input type="checkbox" v-model="ciudades['granada']" id="granada" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="granada">Granada</label>
                        </div>

                        <div class="m-2 text-blue-400 items-center">
                            <input type="checkbox" v-model="ciudades['cordoba']" id="cordoba" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="cordoba">Córdoba</label>
                        </div>

                        <div class=" m-2 text-pink-400 items-center">
                            <input type="checkbox" v-model="ciudades['almeria']" id="almeria" @change="filtrar"
                                name="ciudad" class="mx-2 mt-1 rounded-full p-1">
                            <label for="almeria">Almería</label>
                        </div>

                        <div class="m-2 text-blue-400 items-center">
                            <input type="checkbox" v-model="ciudades['huelva']" id="huelva" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="huelva">Huelva</label>
                        </div>

                        <div class=" m-2 text-pink-400 items-center">
                            <input type="checkbox" v-model="ciudades['jaen']" id="jaen" @change="filtrar" name="ciudad"
                                class="mx-2 mt-1 rounded-full p-1">
                            <label for="jaen">Jaén</label>
                        </div>

                        <h1 class="text-white text-center text-xl">Musica</h1>

                        <div v-for="m in musica" :key="m.id" class="m-2 text-blue-400 items-center">
                            <input type="checkbox" v-model="m.filtrado" @change="filtrar" name="ciudad"
                                class="mr-2 mt-1 ml-1 rounded-full p-1">
                            <label for="musica">{{ m.nombre }}</label>
                        </div>

                        <h1 class="text-white text-center text-xl">Tematica</h1>

                        <div v-for="t in tematica" :key="t.id" class=" m-2 text-pink-400 items-center">
                            <input type="checkbox" v-model="t.filtrado" @change="filtrar" name="ciudad"
                                class="mr-2 mt-1 ml-1 rounded-full p-1">
                            <label for="tematica">{{ t.nombre }}</label>
                        </div>


                    </div>
                    <div class="divUno ">
                        <div class="divDos ">
                            <div class="divFiesta" v-for="fiesta in  orderByDate(fiestasFiltradas)" :key="fiesta.id">
                                <img v-bind:src="'https://pipartytime.com/storage/fiestas/' + fiesta.foto" class="imgFiesta"
                                    alt="">
                                <nav-link class="h1Fiesta text-pink-600 hover:text-blue-950"
                                    :href="'perfil/' + fiesta.empresa.id">{{ fiesta.empresa.nombre }} -> {{
                                        formatdate(fiesta.fecha) }}</nav-link>
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

                                        <swiper-slide v-for="e in fiesta.entrada" class="mySwiper swiperEntrada"
                                            :key="e.id">
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
        Link,
    },
    data() {
        return {
            showMenu: false,
            fiestas: [],
            fiestasFiltradas: [],
            empresas: [],
            id_entrada: '',
            musica: [],
            tematica: [],
            filtrosciudad: [],
            filtrosmusica: [],
            filtrostematica: [],
            ciudades: {
                almeria: false,
                granada: false,
                cadiz: false,
                cordoba: false,
                malaga: false,
                sevilla: false,
                huelva: false,
                jaen: false
            },
            color: ['text-blue-600', 'text-pink-600', 'text-red-600', 'text-green-600', 'text-purple-600', 'text-violet-600'],
        };
    }, methods: {
        enviar(id_ent) {
            const id = id_ent
            axios.post('/hacerreserva', {
                'id_entrada': id
            }).then(response => {
                // console.log(response);
                this.showAlert()
            }).catch(error => {
                // console.log(error);
            });
        },
        showAlert() {
            Swal.fire({
                title: 'Reserva Realizada!',
                text: 'Puedes visualizar la reserva en MIS RESERVAS.',
                icon: 'success',
                confirmButtonColor: '#1a202c'
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
        },

        filtrar() {
            this.fiestasFiltradas = [];
            this.filtrosciudad = [];
            this.filtrosmusica = [];
            this.filtrostematica = [];
            for (let ciudad in this.ciudades) {
                if (this.ciudades[ciudad]) {
                    this.filtrosciudad.push(ciudad)
                }
            }
            for (let mus in this.musica) {
                // console.log(this.musica[mus].filtrado)
                if (this.musica[mus].filtrado) {
                    this.filtrosmusica.push(this.musica[mus].nombre)
                }
            }

            for (let tem in this.tematica) {
                if (this.tematica[tem].filtrado) {
                    this.filtrostematica.push(this.tematica[tem].nombre)
                }
            }

            if (this.filtrosciudad.length == 0 && this.filtrosmusica.length == 0 && this.filtrostematica.length == 0) {
                this.fiestasFiltradas = this.fiestas;
            } else {
                for (let fiesta in this.fiestas) {
                    // console.log(this.fiestas[fiesta].empresa.ubicacion.toLowerCase())
                    if (this.filtrosciudad.includes(this.fiestas[fiesta].empresa.ubicacion.toLowerCase()) && this.filtrosmusica.length == 0 && this.filtrostematica.length == 0) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrosciudad.includes(this.fiestas[fiesta].empresa.ubicacion.toLowerCase()) && this.filtrosmusica.includes(this.fiestas[fiesta].musica.nombre) && this.filtrostematica.length == 0) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrostematica.includes(this.fiestas[fiesta].tematica.nombre) && this.filtrosmusica.length == 0 && this.filtrosciudad.length == 0) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrosmusica.includes(this.fiestas[fiesta].musica.nombre) && this.filtrostematica.length == 0 && this.filtrosciudad.length == 0) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrostematica.includes(this.fiestas[fiesta].tematica.nombre) && this.filtrosmusica.length == 0 && this.filtrosciudad.includes(this.fiestas[fiesta].empresa.ubicacion.toLowerCase())) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrostematica.includes(this.fiestas[fiesta].tematica.nombre) && this.filtrosciudad.length == 0 && this.filtrosmusica.includes(this.fiestas[fiesta].musica.nombre)) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                    else if (this.filtrostematica.includes(this.fiestas[fiesta].tematica.nombre) && this.filtrosciudad.includes(this.fiestas[fiesta].empresa.ubicacion.toLowerCase()) && this.filtrosmusica.includes(this.fiestas[fiesta].musica.nombre)) {
                        this.fiestasFiltradas.push(this.fiestas[fiesta])
                    }
                }
                // console.log(this.filtros)
            }
        }

    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
    mounted() {
        axios.get('/listarfiestas')
            .then(response => {
                this.fiestas = response.data;
                this.fiestasFiltradas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });

        axios.get('/listarallempresas')
            .then(response => {
                this.empresas = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listarmusica')
            .then(response => {
                this.musica = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
        axios.get('/listartematica')
            .then(response => {
                this.tematica = response.data;
            })
            .catch(error => {
                // console.log(error);
            });
    },


};

</script>

<style>
#discotecas {
    background-image: url(../../img/fondodisc2.jpg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}


.mySwiper {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
