<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" v-model="form.name" type="text" class="form-control" name="name" required autocomplete="name" autofocus :class="{ 'input-error' : getValidationErrors('name') }">
                                <validation-errors :errors="getValidationErrors('name')"></validation-errors>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" v-model="form.email" type="email" class="form-control" name="email" required autocomplete="email" :class="{ 'input-error' : getValidationErrors('email') }">
                                <validation-errors :errors="getValidationErrors('email')"></validation-errors>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"  class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" v-model="form.password" type="password" class="form-control" name="password" required autocomplete="new-password" :class="{ 'input-error' : getValidationErrors('password') }">
                                <validation-errors :errors="getValidationErrors('password')"></validation-errors>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" v-model="form.password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" :class="{ 'input-error' : getValidationErrors('password_confirmation') }">
                                <validation-errors :errors="getValidationErrors('password_confirmation')"></validation-errors>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <router-link :to="{name:'login'}">you have an account?</router-link>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click.prevent="register" :disabled="disabled">
                                    Register
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ValidationError from '../global/mixins/ValidationError';
import {mapState} from 'vuex';
export default {
    mixins : [ValidationError],
    data : () => ({
        form : {
            name : null ,
            email : null ,
            password : null ,
            password_confirmation : null ,
        },
        disabled : false ,
    }),
    computed:{
        ...mapState({
            isLoggedIn : state => state.auth.isLoggedIn
        })
    },
    created() {
        if (this.isLoggedIn) {
            this.$router.push({name:"home"})
        }
    },
    methods: {
        async register()
        {
            this.disabled = true ;
            this.validationErrors = null ;

            try{
                const response = await axios.post('/register',this.form);

                this.$store.dispatch("auth/login");
                this.$router.push({name:"home"});
            }catch(error){
                if(error.response)
                {
                    if(error.response.status == 422)
                    {
                        this.validationErrors = error.response.data.errors;
                    }
                }
            }

            this.disabled = false ;
        }
    },
}
</script>
