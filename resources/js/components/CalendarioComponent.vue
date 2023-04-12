<template>
    <div>
        <div>
            <full-calendar id="calendario"
                    :config="config"
                    :events="events"
                    @event-selected="mostrarEvento"
                    @event-created="crearEvento"
                    @event-resize="editarEvento"
                    @event-drop="editarEvento"/>
            <template v-if="evento">
                <calendario-editar
                        v-if="typeof(evento.puede_crear) === 'undefined' || evento.puede_crear"
                        :evento-actual="evento"
                        :idioma="idioma"
                        :editable="config.editable"
                        :tiposEvento="tiposEventoCrear"
                        :tiposProducto="tiposProducto"
                        :errores="errores"
                        @insertar-evento="insertarEvento"
                        @editar-evento="editarEvento"
                        @eliminar-evento="eliminarEvento"
                        @cerrado="evento = null; errores = []"/>
                <calendario-ver
                        v-else
                        :evento="evento"
                        :tiposEvento="tiposEvento"
                        :tiposProducto="tiposProducto"
                        @cerrado="evento = null"/>
            </template>
        </div>
        <div class="ta-right">
            <button type="button" class="button btn-create-event-fc"
                    v-if="config.editable"
                    @click="crearEvento(null)">
                {{ $t("vue.calendario.crearEvento") }}
            </button>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import 'fullcalendar/dist/locale/es';
import CalendarioEditarComponent from './CalendarioEditarComponent';

export default {
    name: 'calendario',
    props: [
        'idioma'
    ],
    data () {
        return {
            config: {
                locale: this.idioma,
                editable: true,
                themeSystem: 'standard',
                defaultView: 'month',
                eventLimit: 4,
                selectHelper: true,
                header: {
                    'left': 'title',
                    'center': 'prev,next today',
                    'right': 'month,agendaWeek,agendaDay,listWeek'
                },
                navLinks: true,
                footer: true,
                nowIndicator: true,
                handleWindowResize: true,
            },
            events: [],
            evento: null,
            tiposEvento: [],
            tiposEventoCrear: [],
            tiposProducto: [],
            errores: []
        }
    },
    methods: {
        mostrarEvento(event) {
            let id = event.id;
            this.evento = this.events.find((event) => event.id === id);
        },
        crearEvento(event) {
            let start = event ? event.start.format('YYYY-MM-DD HH:mm') : moment().format('YYYY-MM-DD 08:00');
            let end = event ? event.end.format('YYYY-MM-DD HH:mm') : moment().format('YYYY-MM-DD 08:15');
            let nombre = event ? event.nombre : '';
            let evento = {
                id: null,
                dia: event ? event.start.format('YYYY-MM-DD') : moment().format('YYYY-MM-DD'),
                start: start,
                title: nombre,
                end: end,
                hora_inicio: start.substr(11, 16),
                hora_fin: end.substr(11, 16),
                allDay: event && event.start.format('HH:mm') === '00:00',
                color: 'purple'
            }
            this.evento = evento;
        },
        editarEvento(event, arrastrar=false) {
            this.mostrarEvento(event);
            let copia = Object.assign({}, this.evento);
            let id = event.id;
            let start = moment(event.start);
            let end;
            if (event.end) {
                end = moment(event.end);
            } else {
                end = start.clone().add(2, 'hours');
            }
            this.evento.start = start;
            this.evento.end = end;
            this.evento.allDay = event.allDay;
            this.evento.nombre = event.title;
            this.evento.dia = start.format('YYYY-MM-DD');
            this.evento.hora_inicio = start.format('HH:mm');
            this.evento.hora_fin = end.format('HH:mm');
            this.$http.put(`/eventos/update/${id}`, {
                evento: this.evento
            }, {
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            }).then(response => {
                this.evento = null;
                this.errores = [];
            }, errores => {
                if (arrastrar) {
                    this.mostrarEvento(event);
                    Object.assign(this.evento, copia);
                    this.evento = null;
                } else if (errores.status == 422) {
                    this.errores = errores.data.errors;
                }
            });
            if (arrastrar) {
                this.evento = null;
            }
        },
        insertarEvento() {
            let evento = this.evento
            evento.nombre = this.evento.title
            this.$http.post('/eventos/store', {
                evento: evento
            }, {
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            }).then(response => {
                evento.id = response.data.id;
                evento.title = response.data.nombre;
                this.events.push(evento);
                this.errores = [];
                this.evento = null;
            }, errores => {
                if (errores.status == 422) {
                    this.errores = errores.data.errors;
                }
            });
        },
        eliminarEvento() {
            if (this.config.editable) {
                let id = this.evento.id;
                let events = this.events.map((e) => e.id);
                let index = events.indexOf(id);
                this.events.splice(index, 1);
                this.evento = null;
                this.$http.put(`/eventos/destroy/${id}`, {}, {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                });
            }
        },
    },
    mounted() {
        this.$http.get('/eventos/api_eventos').then(response => {
            let eventos = response.data;
            eventos.forEach((e) => {
                e.start = moment(e.dia + ' ' + e.hora_inicio);
                e.end = moment(e.dia + ' ' + e.hora_fin);
            });
            this.events = eventos;
        });
    },
    components: {
        'calendario-editar': CalendarioEditarComponent
    }
}
</script>

<style>
    .fc-time, .fc-title {
        text-align: left;
    }

    tbody, thead {
        background: transparent;
        border: 0;
    }
</style>
