<template>
    <el-row>
    <el-form :model="form" :rules="rules" ref="offerForm">
        <el-col :xs="24" :sm="24" :md="24" :lg="24">
            <el-form-item label="Nazwa produktu:" prop="product">
                <el-input v-model="form.product" placeholder="..." auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="Opakowanie / Waga:" prop="package">
                <el-input v-model="form.package" placeholder="np: skrzynka 15kg" auto-complete="off"></el-input>
            </el-form-item>
        </el-col>
        <el-col :xs="24" :sm="24" :md="24" :lg="12">
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
        <el-col :xs="24" :sm="24" :md="24" :lg="12">
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
        <el-col :xs="24" :sm="24" :md="24" :lg="12">
            <el-form-item label="Cena minimalna:" prop="price_min">
                <el-input-number :step="0.1" :debounce="900" :min="0" style="line-height: 0px" v-model="form.price_min" size="small"></el-input-number>
            </el-form-item>
        </el-col>
        <el-col :xs="24" :sm="24" :md="24" :lg="12">
            <el-form-item label="Cena maksymalna:" prop="price_max">
                <el-input-number :step="0.1" :debounce="900" :min="0" style="line-height: 0px" v-model="form.price_max" size="small"></el-input-number>
            </el-form-item>
        </el-col>
    </el-form>
    </el-row>
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
                        { required: true, message: 'Wskaż pochodzenie produktu.', trigger: 'change' }
                    ],
                    price_max: [
                        { required: true, type: 'number', message: 'Wprowadź maksymalną cene.', trigger: 'change' }
                    ],
                    price_min: [
                        { required: true, type: 'number', message: 'Wprowadź minimalną cene.', trigger: 'change' }
                    ]
                },
                options: {
                    type: ['Owoce', 'Warzywa', 'Grzyby'],
                    origin: ['Kraj', 'Import']
                }
            }
        },
        created() {
            this.assignPropsData(this.data);
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
            }
        }
    }
</script>