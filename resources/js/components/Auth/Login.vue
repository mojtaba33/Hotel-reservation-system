<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" v-model="form.email" type="email" class="form-control" name="email" required autocomplete="email" autofocus :class="{ 'input-error' : getValidationErrors('email') }">
                                <validation-errors :errors="getValidationErrors('email')"></validation-errors>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" v-model="form.password" type="password" class="form-control" name="password" required autocomplete="current-password" :class="{ 'input-error' : getValidationErrors('password') }">
                                <validation-errors :errors="getValidationErrors('password')"></validation-errors>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input v-model="form.remember" class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember" >
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <router-link :to="{name:'home'}">you don't have an account?</router-link>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <router-link :to="{name:'home'}">forgot your password?</router-link>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click.prevent="login" type="submit" class="btn btn-primary">Login</button>
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
export default {
    mixins : [ValidationError],
    data : () => ({
        form : {
            email : null ,
            password : null ,
            remember : false ,
        }
    }),
    methods: {
        async login()
        {
            try{
                await axios.get('/sanctum/csrf-cookie');
                const response = await axios.post('/login',this.form);
                console.log(response);
            }catch(error){
                if(error.response)
                {
                    if(error.response.status == 422)
                    {
                        this.validationErrors = error.response.data.errors;
                    }
                }
            }
        }
    },
}
</script>
