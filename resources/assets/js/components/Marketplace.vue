<template>
    <el-row>
        <el-col style="position: relative;">
            <card :data="data" style="position: absolute; top: 5%; left:1%; z-index: 10;"></card>
            <google-maps :cords="data.cords" :zoomlevel="14"></google-maps>
        </el-col>
        <hr/>
    </el-row>
</template>

<script>
    import GoogleMaps from './GoogleMaps.vue';
    import Card from './Card.vue';

    export default {
        components: { GoogleMaps, Card },
        props: ['data'],
    }

</script>



