<template>
    <el-dialog :title="'Dziennik logów dla '+ market.name+':'" :visible.sync="dialogFormVisible" size="large" @visible-change="hideDialog">
        <date-range-picker :init-days="7" @set-date-range="setDateRange"></date-range-picker>
        <el-button type="success" icon="search" style="margin: 5px 0 0 0;" @click="updateLogs">Szukaj</el-button>
        <checkbox-categories :data="categories" @filter-by-category="setCheckedCategories"></checkbox-categories>
        <market-logs-list v-for="log in data" :key="log" :data="log"></market-logs-list>
        <span slot="footer" class="dialog-footer">
            <el-col class="mb-1 btn-stacked">
                <el-button class="btn-mobile" type="primary" @click="hideDialog(false)">Zamknij</el-button>
            </el-col>
        </span>
    </el-dialog>
</template>

<script>
    import MarketLogsList from "./MarketLogsList.vue";
    import DateRangePicker from "../../DateRangePicker.vue";
    import CheckboxCategories from "./CheckboxCategories.vue";

    export default {
        components: {MarketLogsList, DateRangePicker, CheckboxCategories},
        props: ['show', 'data', 'market', 'categories'],
        data() {
            return {
                checkedCategories: [],
                dateRange: []
            }
        },
        watch: {
            categories() {
                this.checkedCategories = this.categories;
            }
        },
        computed: {
            dialogFormVisible() {
                return this.show;
            }
        },
        methods: {
            hideDialog(state) {
                if (state === false) {
                    this.$emit('hide-dialog', state);
                }
            },
            updateLogs() {
                this.$emit('update-logs', {market: this.market, categories: this.checkedCategories, dateRange: this.dateRange});
            },
            setDateRange(payload) {
                this.dateRange = payload;
            },
            setCheckedCategories(data) {
                this.checkedCategories = data;
            }
        }

    }
</script>