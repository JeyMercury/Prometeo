<template>
    <div>
        <canvas id="grafica_linea-js"></canvas>
    </div>
</template>


<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
    data: String,
    options: {
      type: String,
      default: null
    },
    labels: String,
    title: String
  },
  methods: {
        renderChart() {
            new Chart(document.getElementById('grafica_linea-js').getContext('2d'), {
                type: 'line',
                data: {
                    labels: JSON.parse(this.labels),
                    datasets: [{
                        label: this.title,
                        data: JSON.parse(this.data),
                        lineTension: 0,
                        backgroundColor: [
                            '#2ecc71',
                            '#e74c3c',
                            '#8e44ad',
                            '#d35400',
                            '#16a085'
                        ]
                    }]
                },
                options: this.get_options(),
            });
        },
        get_options(){
            var default_option = {
                title: {
                    display: true,
                    fontSize: 22,
                    text: this.title
                },
                legend:{
                    position: "bottom"
                }
            };
            if(this.options == null){
                return default_option;
            }else{
                return JSON.parse(this.options)
            }
        }
    },
    mounted () {
        this.renderChart()
    }
}

</script>
