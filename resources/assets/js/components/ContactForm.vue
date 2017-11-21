<template>
     <el-dialog
             :visible.sync="dialogVisible"
             :close-on-click-modal="false"
             :modal-append-to-body="true"
             size="full"
             @close="resetForm">
                <div>
                    <el-col>
                        <h3 class="center">Formularz kontaktowy</h3>
                    </el-col>
                    <el-form :model="form" ref="contactForm" :rules="rules" label-position="left" label-width="100px" class="mt-2">
                    <el-col :xs="24" :sm="{span:14, offset:5}" :md="{span:12, offset:6}" :lg="{span:10, offset:7}">
                        <el-form-item label="Imie:" prop="name">
                            <el-input v-model="form.name" placeholder="..."></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="{span:14, offset:5}" :md="{span:12, offset:6}" :lg="{span:10, offset:7}">
                        <el-form-item label="Nazwisko:" prop="secondName">
                            <el-input v-model="form.secondName" placeholder="..."></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="{span:14, offset:5}" :md="{span:12, offset:6}" :lg="{span:10, offset:7}">
                        <el-form-item label="E-mail:" prop="email">
                            <el-input v-model="form.email" placeholder="..."></el-input>
                        </el-form-item>
                     </el-col>
                    <el-col :xs="24" :sm="{span:14, offset:5}" :md="{span:12, offset:6}" :lg="{span:10, offset:7}">
                        <el-form-item label="Wiadmość" prop="msgBody">
                            <el-input type="textarea" :autosize="{ minRows: 2, maxRows: 6}" v-model="form.msgBody" placeholder="..."></el-input>
                        </el-form-item>
                    </el-col>
                </el-form>
                </div>
                <span slot="footer" class="dialog-footer">
                <el-col :xs="24" :sm="{span:14, offset:5}" :md="{span:12, offset:6}" :lg="{span:10, offset:7}" class="mb-1 btn-stacked">
                    <div id="recaptcha"  data-size="invisible"></div>
                    <el-button class="btn-mobile" @click="closeForm">Anuluj</el-button>
                    <el-button class="btn-mobile" :loading="btnLoading" type="primary" @click="submitForm('contactForm')">Wyślij</el-button>
                </el-col>
            </span>
    </el-dialog>
</template>

<script>

    export default {
        data() {
            return {
                btnLoading: false,
                dialogVisible: false,
                form: {
                    name: '',
                    secondName: '',
                    email: '',
                    msgBody: ''
                },
                rules: {
                    name: [
                        {required: true, type: 'string', message: 'Wprowadź swoje imię.', trigger: 'blur'}
                    ],
                    secondName: [
                        {required: true, type: 'string', message: 'Wprowadź swoje nazwisko.', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, type: 'email', message: 'Wprowadź swój adres email.', trigger: 'blur'}
                    ],
                    msgBody: [
                        {required: true, type: 'string', message: 'Wprowadź tekst wiadomości', trigger: 'blur'}
                    ],
                }
            }
        },
        created() {
            this.$root.$on('show-contact-form', () => {
                this.dialogVisible = true;
            })
        },
        methods: {
            loadCaptcha() {
                if (window.grecaptcha) {
                    return grecaptcha.render('recaptcha', {
                        'sitekey' : "6LfWijYUAAAAAC6Yq5584-CjsA9mbGbgInwij714",
                        'callback' : this.onSubmit
                    });
                }
                console.log('Captcha not found.');
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        grecaptcha.execute();
                    } else {
                        this.$notify.error({
                            message: 'Formularz nie może być przesłany, popraw wskazane błędy.',
                            duration: 4000
                        });
                        return false;
                    }
                });
            },
            resetForm() {
                this.$refs['contactForm'].resetFields();

            },
            closeForm() {
                this.dialogVisible = false;
                this.resetForm();
                grecaptcha.reset();
            },
            onSubmit(token) {
               this.btnLoading = true;
               axios.post('/contact/', {
                   'form': this.form,
                   'g-recaptcha-response': token
               }).then(response => {
                   this.$notify.success({
                       message: 'Dziękuje za wiadomość...',
                       duration: 4000
                   });
                   this.btnLoading = false;
                   this.closeForm();
               }).catch(error => {
                   this.$notify.error({
                       message: 'Wystąpił błąd...',
                       duration: 4000
                   });
                   console.log(error);
               })
            }
        }
    }
</script>