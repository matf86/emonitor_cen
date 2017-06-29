<template>
    <el-row>
        <h1>{{data.name}}</h1>
        <div>
            <p>Miasto: {{ data.city }}</p>
        </div>
        <hr/>
    </el-row>
</template>

<script>

    export default {
        props: ['data']
    }

</script>