<template>
    <el-row style="position: relative;">
        <info-card :data="data" style="position: absolute; top: 5%; left:1%; z-index: 10;"></info-card>
        <google-maps :cords="data.cords" :zoomlevel="14"></google-maps>
    </el-row>
</template>

<script>
    import GoogleMaps from './GoogleMaps.vue';
    import InfoCard from './InfoCard.vue';

    export default {
        components: { GoogleMaps, InfoCard },
        props: ['data'],
    }

</script>



