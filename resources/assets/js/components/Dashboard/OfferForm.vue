<template>
    <el-form :model="form" :rules="rules" ref="offerForm" label-position="top">
         <el-col :xs="22" :sm="22" :md="20" :lg="20">
            <el-form-item label="Nazwa produktu:" prop="product">
                <el-input v-model="form.product" placeholder="..." auto-complete="on"></el-input>
            </el-form-item>
         </el-col>
        <el-col :xs="22" :sm="22" :md="20" :lg="20">
            <el-form-item label="Opakowanie / Waga:" prop="package">
                <el-input v-model="form.package" placeholder="np: skrzynka 15kg" auto-complete="on"></el-input>
            </el-form-item>
        </el-col>
        <el-col :xs="22" :sm="11" :md="11" :lg="11">
            <el-form-item label="Pochodzenie:" prop="origin">
                <el-select v-model="form.origin" clearable placeholder="...">
                    <el-option
                            v-for="origin in options.origin"
                            :key="origin"
                            :label="origin"
                            :value="origin">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-col>
        <el-col :xs="22" :sm="11" :md="11" :lg="11">
            <el-form-item label="Typ:" prop="type">
                <el-select v-model="form.type" clearable placeholder="...">
                    <el-option
                            v-for="type in options.type"
                            :key="type"
                            :label="type"
                            :value="type">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-col>
        <el-col :xs="22" :sm="11" :md="11" :lg="11">
            <el-form-item label="Cena minimalna:" prop="price_min">
                <el-input-number :step="0.1" :debounce="450" :min="0" style="line-height: 0px" v-model="form.price_min" size="small"></el-input-number>
            </el-form-item>
        </el-col>
        <el-col :xs="22" :sm="11" :md="11" :lg="11">
            <el-form-item label="Cena maksymalna:" prop="price_max">
                <el-input-number :step="0.1" :debounce="450" :min="0" style="line-height: 0px" v-model="form.price_max" size="small"></el-input-number>
            </el-form-item>
        </el-col>
    </el-form>
</template>

<script>
    export default {
        props: ['data', 'emptyForm', 'valid'],
        data() {
            return {
                form: this.emptyForm,
                rules: {
                    product: [
                        { required: true, type: 'string', message: 'Wprowadź nazwe produktu.', trigger: 'blur' },
                        { min: 2, max: 50, message: 'Nazwa powinna miec od 2 do 50 znaków.', trigger: 'blur' }
                    ],
                    package: [
                        { required: true, type: 'string', message: 'Wskaż opakowanie / wage produktu.', trigger: 'blur' },
                        {min: 2, max: 50, message: 'Nazwa powinna miec od 2 do 50 znaków.', trigger: 'blur' }
                    ],
                    origin: [
                        { required: true, message: 'Wskaż pochodzenie produktu.', trigger: 'change' },
                    ],
                    type: [
                        { required: true, message: 'Wskaż typ produktu.', trigger: 'change' }
                    ],
                    price_max: [
                        { required: true, type: 'number', message: 'Wprowadź maksymalną cene.', trigger: 'change' }
                    ],
                    price_min: [
                        { required: true, type: 'number', message: 'Wprowadź minimalną cene.', trigger: 'change' }
                    ]
                },
                options: {
                    type: null,
                    origin: null
                }
            }
        },
        created() {
            this.assignPropsData(this.data);
            this.getTypes();
            this.getOrigins();
        },
        watch: {
            data() {
                this.assignPropsData(this.data);
            }
        },
        methods: {
            assignPropsData(prop) {
                let data = prop;
                for(let prop in data) {
                    this.form[prop] = data[prop];
                }
            },
            getTypes() {
                axios.get('/dashboard/offers/types').then(response => {
                    this.options.type = response.data.data;
                }).catch(response => {
                    console.log(response.error);
                });
            },
            getOrigins() {
                axios.get('/dashboard/offers/origins').then(response => {
                    this.options.origin = response.data.data;
                }).catch(response => {
                    console.log(response.error);
                });
            }
        }
    }
</script>