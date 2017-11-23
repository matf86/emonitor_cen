<template>
    <el-alert
            class="mt-1"
            :title="data.created_at"
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

