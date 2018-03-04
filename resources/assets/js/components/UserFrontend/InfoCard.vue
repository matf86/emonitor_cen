<template>
    <div>
        <transition name="fade" mode="out-in">
            <el-button
                    v-if="showbtn"
                    :plain="true" icon="information"
                    type="info"
                    size="large"
                    @click="toggleShowInfo">Info
            </el-button>
            <div class="info-card" v-else>
                <div class="info-card-header">
                    <h3>{{data.name}}</h3>
                </div>
                <div class="info-card-body">
                    <p>Adres: <el-tag>ul. {{data.street}}, {{data.zip_code}} {{data.city}}</el-tag></p>
                    <p>Strona www: <a :href="data.www" target="newtab"><el-tag>{{data.www}}</el-tag></a></p>
                </div>
                <div class="info-card-footer">
                    <el-button class="info-card-btn" type="danger" size="mini" @click="toggleShowInfo">Zamknij</el-button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>

    export default {
        props:['data'],
        data() {
            return {
                showbtn: false
            }
        },
        created() {
            (window.innerWidth < 768)? this.showbtn = true : this.showbtn = false;
        },
        methods: {
            toggleShowInfo() {
                this.showbtn = !this.showbtn;
            }
        }
    }

</script>
