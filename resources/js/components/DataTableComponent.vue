<!-- Componente para crear datatables, es completamente reutilizable, ver props-->
<template>
    <div class="data-table">
        <!--BUSCADOR-->
        <div class="grid-x grid-padding-x buscador" v-if="buscador">
            <div class="cell small-4">
                <label for="buscador">{{this.buscador_label}}</label>
                <input type="text" v-model="filter" class="d-inline-block" id="buscador">
            </div>
            <div class="cell small-1">
                <button type="button" class="search-button" v-on:click="fetchData">
                    <i class="c-blanco icon ion-md-search"></i>
                </button>
            </div>
        </div>
        <div class="main-table">
            <!--INICIO DATATABLE-->
            <table class="table">
                <!-- CABECERA DE LA TABLA, EN ELLA SE GESTIONARAN LOS DIFERENTES ASPECTOS DE ORDENACIÓN-->
                <thead class="table-head">
                    <tr>
                        <!-- MEDIANTE LA FUNCIÓN sortByColumn PERMITIRA QUE AL HACER CLICK SOBRE LA COLUMNA NOS PERMITA ORDENAR POR COLUMNA -->
                        <th v-for="(column) in columns"
                            :key="column.key"
                            :class="[{ 'table-head-th-order':(column.order_column != null) }, 'table-head-th']"
                            @click="sortByColumn(column.order_column)"
                            >
                            {{ column.text | columnHead }}
                            <span v-if="column.order_column != null" class="boton_order">
                                <span v-if="column.order_column === sortedColumn">
                                    <i v-if="order === 'asc' " class="icon icon ion-ios-arrow-up"></i>
                                    <i v-else class="icon icon ion-ios-arrow-down"></i>
                                </span>
                                <span v-else>
                                    <i class="icon ion-md-code button_order"></i>
                                </span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <!-- CUERPO DE LA TABLA, EN ELLA SE GESTIONARAN LOS DATOS-->
                <tbody>
                    <!--SE RECORRERA CADA ELEMENTO GENERADO DE LA CONSULTA PARA MOSTRAR LOS DATOS-->
                    <tr v-for="(data, id) in tableData" :key="id" class="m-datatable__row">
                        <!-- MOSTRARA EL VALOR DE LA COLUMNA CORRESPONDIENTE -->
                        <td v-for="(value, key) in data" :key="key">
                            <img v-if="key =='imagen'" :src="value" class="imagen_redondeada imagen_listado">
                            <div v-else-if="key =='acciones'" class="acciones">
                                <span v-for="(accion, key) in value"  :key="key" class="iconos_acciones">
                                    <span v-if="accion.type == 'link'">
                                        <a :href="accion.ruta" :title="accion.title">
                                            <i :class="accion.icono"></i>
                                        </a>
                                    </span>
                                    <span v-else-if="accion.type == 'sweet-alert'">
                                        <sweet-alert-confirmar
                                            :elemento_id="accion.elemento_id"
                                            :url_api="accion.url_api"
                                            :subtitulo="accion.subtitulo"
                                            :boton_si="accion.boton_si"
                                            :boton_no="accion.boton_no"
                                            :reload="accion.reload"
                                            :title="accion.title"
                                            >
                                        </sweet-alert-confirmar>
                                    </span>
                                </span>
                            </div>
                            <span v-else>{{ value }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--MENÚ DE PAGINACIÓN (Solo se verá la paginación si hay datos a mostrar )-->
        <nav>
            <!-- LISTA DE PAGINACIÓN -->
            <ul class="pagination">
                <!-- VOLVER AL INICIO -->
                <li class="page-item" :class="{'disabled' : currentPage === 1}">
                    <button class="page-link" @click="changePage(currentPage = 1)" :class="{'disabled' : currentPage === 1}">{{"<<"}}</button>
                </li>
                <!-- VOLVER AL ITEM ANTERIOR -->
                <li class="page-item" :class="{'disabled' : currentPage === 1}">
                    <button class="page-link" @click="changePage(currentPage - 1)" :class="{'disabled' : currentPage === 1}">{{"<"}}</button>
                </li>
                <!-- ITEMS POR CADA NUMERO DE PÁGINA -->
                <li v-for="(page, page_link) in pagesNumber"
                    :key="page_link"
                    class="page-item"
                    :class="{'active': page == pagination.meta.current_page}"
                    >
                    <button @click="changePage(page)" class="page-link">
                        {{ page }}
                    </button>
                </li>
                <!-- IR AL SIGUIENTE ITEM-->
                <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
                    <button class="page-link" @click="changePage(currentPage + 1)" :class="{'disabled': currentPage === pagination.meta.last_page }">
                        {{ ">" }}
                    </button>
                </li>
                <!-- IR AL ULTIMO ITEM-->
                <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
                    <button
                        class="page-link"
                        @click="changePage(currentPage= pagination.meta.last_page)"
                        :class="{'disabled': currentPage === pagination.meta.last_page }"
                        >
                        {{ ">>" }}
                    </button>
                </li>
                <span style="margin-top: 8px;" class="paginacion_total">
                    <i>{{ $t("vue.total")}}: {{ pagination.meta.total}}</i>
                </span>
            </ul>
        </nav>
    </div>
</template>

<script type="text/ecmascript-6">
export default {
    //PARAMETROS QUE SE MANDAN DESDE LA VISTA
    props: {
        //URL A LA CUAL SE CONSULTARA PARA OBTENER LOS DATOS
        fetchUrl: { type: String, required: true },
        //COLUMNAS CORRESPONDIENTES A LOS DATOS
        columns: { type: Array, required: true },
        //INFORMACION BUSCADOR
        request: String,
        //TAMAÑO PAGINACIÓN
        buscador: Boolean, //es opcional, si queremos que haya buscador simplemente eviamos una variable buscador a true
        buscador_label: String
    },
    data() {
        //DATOS QUE SE UTILIZARAN EN LA APLICACIÓN
        return {
            tableData: [],
            url: "",
            pagination: {
                meta: { to: 1, from: 1 }
            },
            offset: 4,
            currentPage: 1,
            sortedColumn: this.columns[0].order_column,
            order: "asc",
            filter: ""
        };
    },
    watch: {
        fetchUrl: {
            handler: function (fetchUrl) {
                this.url = fetchUrl;
            },
            immediate: true
        }
    },
    created() {
        return this.fetchData();
    },
    computed: {
        /**
         * Get the pages number array for displaying in the pagination.
         * */
        pagesNumber() {
            if (!this.pagination.meta.to) {
                return [];
            }
            let from = this.pagination.meta.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset * 2;
            if (to >= this.pagination.meta.last_page) {
                to = this.pagination.meta.last_page;
            }
            let pagesArray = [];
            for (let page = from; page <= to; page++) {
                pagesArray.push(page);
            }
            return pagesArray;
        },
        /**
         * Get the total data displayed in the current page.
         * */
        totalData() {
            return this.pagination.meta.to - this.pagination.meta.from + 1;
        }
    },
    methods: {
        fetchData() {
            let dataFetchUrl = `${this.url}?page=${this.currentPage}&column=${this.sortedColumn
                }&order=${this.order}&filtro=${this.filter}&${this.request
                }`;
            this.$http
                .get(dataFetchUrl)
                .then(({ data }) => {
                    this.pagination = data;
                    this.tableData = data.data;
                })
                .catch(error => (this.tableData = []));
        },
        /**
         * CAMBIAR LA PAGINA.
         * @param pageNumber
         */
        changePage(pageNumber) {
            this.currentPage = pageNumber;
            this.fetchData();
        },
        /**
         * ORDENAR POR COLUMNA.
         * */
        sortByColumn(column) {
            if (column !== null) {
                if (column === this.sortedColumn) {
                    this.order = this.order === "asc" ? "desc" : "asc";
                } else {
                    this.sortedColumn = column;
                    this.order = "asc";
                }
                this.fetchData();
            }
        },

        /**
         * FILTRAR BUSCADOR AUTOMATICO.
         */
        search() {
            let dataFetchUrl = `${this.url}?page=${this.currentPage}&column=${this.sortedColumn
                }&order=${this.order}&filtro=${this.filter}&${this.request
                }`;
            this.$http
                .get(dataFetchUrl)
                .then(({ data }) => {
                    this.pagination = data;
                    this.tableData = data.data;
                })
                .catch(error => (this.tableData = []));
        }
    },
    filters: {
        columnHead(value) {
            return value
                .split("_")
                .join(" ")
                .toUpperCase();
        }
    },
    name: "DataTable"
};
</script>

<style scoped>
.button_order {
    transform: rotate(90deg);
    display: inline-block;
    cursor: pointer
}

.buscador {
    display: flex;
    align-items: center;
}

.iconos_acciones>span {
    padding: .2rem;
}

.table-head-th-order {
    cursor: pointer;
}

.search-button {
    cursor: pointer;
}
</style>
