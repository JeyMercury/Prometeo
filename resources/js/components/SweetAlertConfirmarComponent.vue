<template>
    <button type="button" :title="title" class="sweet-alert-confirmar" @click="showAlert">
        <i class="icon ion-md-trash"></i>
    </button>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        elemento_id: String,
        url_api: String,
        url_redirigir: String,
        title: String,
        titulo: String,
        subtitulo: String,
        boton_si: String,
        boton_no: String,
        reload: Boolean
    },
    methods: {
        showAlert() {
            this.$swal({
                title: this.titulo,
                text: this.subtitulo,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: this.boton_no,
                confirmButtonText: this.boton_si,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.delete(this.url_api, {elemento_id: this.elemento_id}).then(({data}) => {
                        if (data.resultado) {
                            this.$swal({
                                text: data.text,
                                icon: "success",
                                timer: 2000,
                                buttons: false
                            })
                            if (this.reload) {
                                location.reload(true)
                            }
                        }
                        else {
                            this.$swal({
                                text: this.$t('vue.sweetalert.error'),
                                icon: "error",
                                buttons: {
                                    cancel: {
                                        text: this.boton_no,
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }
                    })
                }
            })

        }
    }
}
</script>

<style scoped>
.sweet-alert-confirmar {
    text-align: center;
    cursor: pointer;
}
</style>
