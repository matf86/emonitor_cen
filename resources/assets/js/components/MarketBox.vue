<template>
    <el-col :xs="24" :sm="24" :md="12" :lg="6" class="mt-3 mb-2">
        <div class="market-box">
            <div class="market-box-title">
                <h2 class="title" v-text="data.name"></h2>
            </div>
            <div class="market-box-body mt-2">
                <p>Ostatnie notowanie: <el-tag type="gray">{{data.latest_offer}}</el-tag></p>
                <a :href="'/markets/'+ data.slug"><el-button class="mt-2 mb-2" type="success">Sprawdź...</el-button></a>
            </div>
        </div>
    </el-col>
</template>

<script>
   export default {
       props: ['data']
   }
</script>

