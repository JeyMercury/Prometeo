<template>
    <div class="select-datepicker">
        <label :for="name_input_js">{{ name_label_js }}</label>
        <date-picker
            :lang="idioma"
            :format="formato"
            :first-day-of-week="1"
            :input-name="name_input_js"
            :id="name_input_js"
            v-model="value"
            input-class=""
            :placeholder="placeholder"
            >
        </date-picker>
    </div>
</template>

<script>
import DatePicker from "vue2-datepicker";

export default {
    props: [
        "name_input_js",
        "value",
        "idioma",
        "formato",
        "name_label_js",
        "placeholder"
    ],
    components: { DatePicker }
};
</script>

<style>
.datetime-picker {
    display: block !important;
}

.datetime-picker input {
    width: 100% !important;
    padding: 0px 10px !important;
    height: auto !important;
    outline: 0 none !important;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    font-size: 13px !important;
}
</style>
