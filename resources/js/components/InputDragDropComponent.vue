<template>
    <div id="dragdrop_id" class="grid-x">
        <label v-bind:for="input_name" v-html="label_text"></label>
        <div class="upload-btn-wrapper small-12">
            <input v-bind:id="input_name" type="file" @change="onFileChange" v-bind:name="input_name" v-bind:class="{ hidden: upload }" ref="fileInput">
            <div v-if="!upload">
                <label v-bind:for="input_name" class="label_drag_drop" v-html="input_text"></label>
            </div>
            <div v-else>
                <div v-if="imagen" class="item_dragdrop imagen_dragdrop">
                    <img :src="imagen" />
                </div>
                <div v-if="fichero" class="item_dragdrop fichero_dragdrop">
                    <i class="icon ion-md-document"></i>
                    <span v-html="fichero" />
                </div>
                <a href="#" @click="removeImage" class="remove_dragdrop"><i class="icon ion-md-trash"></i></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                imagen: '',
                fichero: '',
                upload: false
            }
        },
        props: {
            input_name: String,
            input_text: String,
            label_text: String,
            remove_text: String
        },
        methods: {
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                },
            createImage(file) {
                    this.upload = true;
                    var fileName =  file.name;
                    var ext = fileName.split('.').pop();
                    var extensionImagenes = ["jpg", "jpeg", "bmp", "gif", "png"]
                    var esImagen = false;
                    extensionImagenes.forEach(function(element) {
                        if(element==ext){
                            esImagen=true;
                        }
                    });
                    if(esImagen){
                        var imagen = new Image();
                        var reader = new FileReader();
                        var file_1 = file
                        reader.onload = (e) => {
                            this.imagen = e.target.result;
                        };
                        reader.readAsDataURL(file_1);
                    }else{
                        this.fichero=file.name;
                    }
                // }
            },
            removeImage: function (e) {
                e.preventDefault();
                this.imagen = '';
                this.fichero = '';
                this.upload = '';
                const input = this.$refs.fileInput
                input.type = 'text'
                input.type = 'file'
            }
        }
    }
</script>
<style>
.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.label_drag_drop {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: bold;
    text-align: center
}

.upload-btn-wrapper input[type=file] {
    font-size: 70px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}
.hidden{
    display: none;
}

.item_dragdrop {
    display: inline-block;
    padding-right: 1rem;
}

.imagen_dragdrop{
    max-width: 200px;
}

.remove_dragdrop{
    color: red;
    font-size: 20px;
}
</style>
