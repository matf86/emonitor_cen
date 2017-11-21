<template>
    <div>
        <el-row>
            <date-range-picker :init-days="30" ref="picker" @set-date-range="setDateRange"></date-range-picker>
            <el-button type="success" icon="search" style="margin: 5px 0;" @click="updateGraphData">Szukaj</el-button>
        </el-row>
        <hr/>
        <div id="chart"></div>
    </div>
</template>

<script>
//    import chartInit from '../../utils/zingchart';

    export default {
        props: ['products', 'selected'],
        data() {
            return {
                dateRange:[],
            }

        },
        mounted() {
            this.$root.$on('hide-dialog', this.resetPicker);
            this.prepChart();
        },
        watch: {
            products() {
                this.prepChart();
            },
        },
        methods: {
            setDateRange(payload) {
                this.dateRange = payload;
            },
            resetPicker() {
                this.$refs['picker'].initDateRange();
            },
            prepChart() {
                let labels= [];
                let values = [];

                if(this.products.length > 0) {
                    this.products.forEach((item) => {
                        labels.push([item.date]);
                        values.push([item.price_min, item.price_max]);
                    });
                }

                let myConfig = {
                    gui: {
                        watermark: {
                            position: "tr"
                        }
                    },
                    type: "range",
                    preview: {
                        backgroundColor:"#efeff0",
                        borderWidth:0.5,
                        preserveZoom:false,
                        mask:{
                            backgroundColor:"#6e6e6e",
                            alpha:0.4
                        },
                        position : "100% 100%",
                        margin : "10 50 0 50",
                        handleLeft:{
                            alpha:0.8,
                            borderRadius:"2px",
                            borderWidth:1,
                            height:"30px",
                            width:"15px"
                        },
                        handleRight:{
                            alpha:0.8,
                            borderRadius:"2px",
                            borderWidth:1,
                            height:"30px",
                            width:"15px"
                        },
                    },
                    backgroundColor : "#ffffff",

                    plot : {
                        aspect : "spline",
                        marker : {
                            visible : true
                        },
                        lineWidth : 2,
                        alphaArea : 1,
                        hoverState:{
                            backgroundColor:'none'
                        }
                    },
                    tooltip:{visible:false},
                    scaleY : {
                        label:{
                            text:'PLN'
                        },
                        lineWidth : 1,
                        tick : {
                            lineWidth : "1"
                        }
                    },
                    guide:{
                        marker:{
                            type:'circle',
                            size:7
                        },
                        plotLabel:{
                            text:"Cena max: %node-max-value zł <br> Cena min: %node-min-value zł",
                            fontSize:15,
                            borderRadius:5,
                            fontColor:'#FFF',
                            backgroundColor:'#000'
                        }
                    },
                    scaleX :{
                        zooming:true,
                        lineWidth : 1,
                        tick : {
                            placement : "outer",
                            size : "10px",
                            lineWidth : "1"
                        },
                        guide : {
                            lineWidth : 1,
                            lineStyle : "solid",
                            alpha : 0.75
                        },
                        item : {
                            offsetX : "0px",
                            textAlign : "left"
                        },
                        labels : labels
                    },
                    series : [
                        {
                            values : values,
                            backgroundColor : "#FF0003 #00FCFF",
                            lineColor : "#a2f2ff",
                            alphaArea: 0.25
                        }
                    ]
                };

                zingchart.render({
                    id : 'chart',
                    data : myConfig,
                    height: '100%',
                    width: '100%'
                });

//                chartInit(labels, values);
            },
            updateGraphData() {
                this.$root.$emit('update-graph-data', {
                    dateRange: {
                                  'from': this.dateRange[0],
                                  'to': this.dateRange[1]
                                 },
                    productName: this.selected.product,
                    package: this.selected.package,
                    origin: this.selected.origin
                });
            }
        }
    }

</script>

<style>
    #chart {
        width: 100%;
        height: 70vh;
    }
</style>