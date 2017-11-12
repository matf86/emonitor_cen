<template>
	<el-col :xs="22" :sm="10" :md="10" :lg="6" :offset="1" class="mt-3 mb-2">
		<div class="market-box">
			<div class="market-box-title">
				<h2 class="title" v-text="data.name"></h2>
			</div>
			<div class="market-box-body mt-2">
				<p>Ostatnie notowanie: <el-tag type="gray">{{data.latest_offer}}</el-tag></p>
				<p>Liczba pobranych ofert: <el-tag type="gray">{{data.count_offers}}</el-tag></p>
				<el-button class="mt-2 mb-2" type="success" @click="showDialog">Logi</el-button>
			</div>
		</div>
	</el-col>

</template>

<script> 

	export default {
        props: ['data'],
		methods: {
            showDialog() {
                this.$emit('show-dialog', this.data);
			}
		}
    }
</script>




