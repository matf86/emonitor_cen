<template>
    <el-row v-show="pageSize < total">
        <el-pagination
                @current-change="handleCurrentChange"
                :current-page.sync="currentPage"
                :page-size="pageSize"
                layout="total, prev, pager, next"
                :total=total>
        </el-pagination>
    </el-row>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                pageSize: 25,
                currentPage: 1,
                tableData: this.data
            }
        },
        created() {
            this.$root.$on('paginate', this.sortEntries);
            this.passSlicedData();
        },
        watch: {
            data() {
                this.tableData = this.data;
                this.passSlicedData();
            }
        },
        computed: {
            total() {
                return this.tableData.length;
            },
            entriesList() {
                let from = this.pageSize * (this.currentPage - 1);
                let to = from + this.pageSize;
                return this.tableData.slice(from, to);
            }
        },
        methods: {
            passSlicedData() {
                this.$emit('set-sliced-table-data', this.entriesList);
            },
            handleCurrentChange(currentPage) {
                this.currentPage = currentPage;
                this.passSlicedData();
            },
            sortEntries(column) {
                this.tableData.sort((a, b) => {
                    if (a[column.prop] > b[column.prop]) {
                        return 1
                    } else if (a[column.prop] < b[column.prop]) {
                        return -1
                    } else {
                        return 0
                    }
                });
                if (column.order === 'descending') {
                    this.tableData.reverse()
                }
            },
        }
    }
</script>


