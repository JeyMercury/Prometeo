<template>
    <div class="reveal-overlay" style="display: block">
        <div id="calendario-modal" class="reveal" data-reveal role="dialog" style="display: block;">
            <button @click="revertirCambios" class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <form class="calendario-form">
                <div class="grid-container">
                    <h2>{{ $t("vue.calendario.evento") }}</h2>
                    <div class="callout alert" v-if="errores.length != 0">
                        <template v-for="(input, i) in errores">
                            <p v-for="(error, j) in input" :key="i + '-' + j">
                                {{ error }}
                            </p>
                        </template>
                    </div>
                    <label>
                        {{ $t("vue.calendario.nombre") }}
                        <input type="text" v-model="evento.title">
                    </label>
                    <label>{{ $t("vue.calendario.dia") }}</label>
                    <date-picker v-model="eventoDia"
                            :lang="idioma"
                            format="DD-MM-YYYY"
                            :first-day-of-week=1
                            input-class="">
                    </date-picker>
                    <div style="padding-left: 20px; display: inline-block">
                        <input type="checkbox" id="allday-box" v-model="evento.allDay">
                        <label for="allday-box">{{ $t("vue.calendario.todoDia") }}</label>
                    </div>
                    <template v-if="!evento.allDay">
                        <label>{{ $t("vue.calendario.hora") }}</label>
                        <date-picker v-model="eventoHoras"
                                :lang="idioma"
                                type="time"
                                format="HH:mm"
                                range
                                :time-picker-options="{ start: '08:00', step: '00:15', end: '22:00' }"
                                :shortcuts="false"
                                input-class="">
                        </date-picker>
                    </template>
                    <label>
                        {{ $t("vue.calendario.informacion") }}
                        <textarea v-model="evento.informacion"></textarea>
                    </label>
                    <label>
                        {{ $t("vue.calendario.color") }}
                        <div class="fc-day-grid-event fc-h-event fc-event"
                                style="display: inline"
                                :style="{'background-color': evento.color }">
                            <span class="fc-title">{{ evento.title }}</span>
                        </div>
                        <slider-picker
                                :value="evento.color"
                                @input="actualizarColor"
                                style="padding-bottom: 10px"/>
                    </label>
                    <div class="clearfix">
                        <button class="button rigth" style="float: right"
                                v-if="!evento.id"
                                @click.prevent="insertarEvento"
                                @submit.prevent="insertarEvento">
                            {{ $t("vue.calendario.insertar") }}
                        </button>
                        <button class="button" style="float: right"
                                v-else
                                @click.prevent="editarEvento(evento)"
                                @submit.prevent="editarEvento(evento)">
                            {{ $t("vue.calendario.editar") }}
                        </button>
                        <button class="alert button" style="margin-left: 5px; float: left"
                                @click.prevent="eliminarEvento"
                                @submit.prevent="eliminarEvento">
                            {{ $t("vue.calendario.eliminar") }}
                        </button>
                        <button class="button secondary" style="float: left"
                                @click.prevent="revertirCambios"
                                @submit.prevent="revertirCambios">
                            {{ $t("vue.calendario.cancelar") }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import DatePicker from 'vue2-datepicker';
    import { Slider } from 'vue-color';

    export default {
        props: [
            'eventoActual',
            'idioma',
            'editable',
            'errores'
        ],
        created() {
            this.evento = this.eventoActual;
            this.eventoOriginal = Object.assign({}, this.eventoActual);
        },
        data() {
            return {
                evento: null,
                eventoAnterior: null
            }
        },
        methods: {
            insertarEvento(event) {
                this.$emit('insertar-evento', event);
            },
            editarEvento(event) {
                this.$emit('editar-evento', event);
            },
            eliminarEvento() {
                this.$emit('eliminar-evento');
            },
            revertirCambios() {
                Object.assign(this.evento, this.eventoOriginal);
                this.$emit('cerrado');
            },
            actualizarColor(event) {
                this.evento.color = event.hex;
            },
            fechaDespues(fecha) {
                let ahora = moment();
                return moment(fecha) < ahora;
            }
        },
        computed: {
            eventoDia: {
                get() {
                    return this.evento.dia;
                },
                set(dia) {
                    let diaStr = moment(dia).format('YYYY-MM-DD')
                    this.evento.dia = diaStr;
                    this.evento.start = diaStr + ' ' + this.evento.hora_inicio;
                    this.evento.end = diaStr + ' ' + this.evento.hora_fin;
                }
            },
            eventoHoras: {
                get() {
                    return [
                        this.evento.start,
                        this.evento.end
                    ];
                },
                set(horas) {
                    this.evento.start = horas[0];
                    this.evento.end = horas[1];
                    this.evento.hora_inicio = moment(horas[0]).format('HH:mm');
                    this.evento.hora_fin = moment(horas[1]).format('HH:mm');
                }
            }
        },
        components: {
            DatePicker,
            'slider-picker': Slider
        }

    }
</script>

<style>
    .calendario-form {
        padding: 20px;
    }
</style>
