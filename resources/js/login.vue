<template>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4 p-5 shadow-sm border rounded-5 border-primary">
            <h2 class="text-center mb-4 text-primary">Fazer login</h2>
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control border border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" v-model="email" v-on:keyup.enter="login">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control border border-primary" id="exampleInputPassword1"
                        v-model="password" v-on:keyup.enter="login">
                </div>
                <div class="d-grid">
                    <a class="btn btn-primary" @click="login">Entrar</a>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "LoginPage",
    data() {
        return {
            email: "",
            password: "",
            errors: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        async login() {
            this.resetErrorFields();
            let loader = this.$loading.show({
                canCancel: false,
                color: '#8373e1',
                opacity: 0.8,
            });
            await axios.post('/login', {
                email: this.email,
                password: this.password
            }).then((result) => {
                console.log(result);
                if (result.status === 200) {
                    this.$toast.open(result.data.msg);
                    window.location.href = '/';
                    loader.hide();
                }
            }).catch((error) => {
                this.$toast.error(error.response.data.msg);
                this.getErrors(error.response.data);
                loader.hide();
            });
        },
        getErrors(error) {
            if (error.errors !== null && error.errors !== undefined) {
                Object.entries(error.errors).forEach(([key, value]) => {
                    this.$toast.error(value[0]);
                    this.errors[key] = 'is-invalid state-invalid';
                });
            }
        },
        resetErrorFields() {
            this.errors = {
                email: '',
                password: '',
            }
        },
        checkToast() {
            let search = window.location.search;

            if (search) {
                let params = new URLSearchParams(search);
                let message = params.get("message");
                let type = params.get("type");
                this.$toast.open({
                    message,
                    type,
                    timeout: 5000,
                });
            }
        },
    },
    mounted() {
        this.checkToast();
        setTimeout(() => {
            history.replaceState({ id: 'Sellers Spy' }, 'Sellers Spy', '/login');
        }, 100);

    }
}
</script>

<style scoped>

</style>
