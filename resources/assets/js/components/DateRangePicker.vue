<template>
    <el-date-picker
            v-model="dateRange"
            type="daterange"
            align="right"
            placeholder="Dane z dni.."
            :picker-options="pickerOptions"
            @input="setDateRange">
    </el-date-picker>
</template>

<script>

export default {
    data() {
        return {
            dateRange:[],
            pickerOptions: {
                shortcuts: [{
                    text: 'Tydzień',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: 'Miesiąc',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '3 miesiące',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '6 miesięcy',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 180);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: 'Rok',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 364);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
        }
    },
    created() {
        this.initDateRange();
    },
    methods: {
        initDateRange() {
                const end = new Date();
                const start = new Date();
                start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                this.dateRange = [start, end];

                this.setDateRange(this.dateRange);
            },
        setDateRange(payload) {
           this.$emit('set-date-range', this.convertDate(payload));
        },
        convertDate(dates) {
            let dateRange = [];

            if (dates === undefined ) {
               return dateRange = [null,null];
            }

            if (dates.length > 0) {
                return dateRange = dates.map(item => {
                    return moment.parseZone(item).local().format('YYYY-MM-DD');
                });
            }
        },
    }
}
</script>