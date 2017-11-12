<template>
    <el-alert
            class="log"
            :title="data.created_at + ' - ' + data.category"
            :type="data.category"
            :description="data.message"
            :closable="false"
            show-icon>
    </el-alert>
</template>

<script>

    export default {
        props: ['data'],
        data() {
            return {

            }
        },
    }
</script>

<style>
    .log {
        margin-top: 5px;
    }
</style>