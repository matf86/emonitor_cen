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
            <div class="card" v-else>
                <div class="card_header">
                    <h3>{{data.name}}</h3>
                </div>
                <div class="card_body" style="position: relative; padding: 5px;">
                    <div style="margin-bottom: 35px;">
                        <p>Adres: ul. {{data.street}}, {{data.zip_code}} {{data.city}}</p>
                        <a :href="data.www">{{data.www}}</a>
                    </div>
                    <div>
                        <el-button style="position: absolute; bottom: 10%; right: 5%;"  type="danger" size="mini" @click="toggleShowInfo">Zamknij</el-button>
                    </div>
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
        methods: {
            toggleShowInfo() {
                this.showbtn = !this.showbtn;
            }
        }
    }

</script>

<style>

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.4s;
        opacity: 0.8;
        background: white;
        height: 100%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);
        opacity: 0.9;
    }

    .card_header {
        position: relative;
        text-align: center;
        background-color: rgb(32, 160, 255);
    }


    .card_header h3 {
        margin-top: 0;
        font-family: $secondary-font;
        padding: 10px;
        color: rgba(255, 255, 255, 1);
    }

    .card_body {
        padding: 2px 16px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s
    }
    .fade-enter, .fade-leave-to  {
        opacity: 0
    }

</style>
