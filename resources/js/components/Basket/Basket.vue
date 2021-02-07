<template>
    <div>
        <fatal-error v-if="fatalError"></fatal-error>
        <success v-if="success">
            congratulations
        </success>
        <div v-if="!success && !fatalError">
            <div v-if="basketItems.length == 0" class="text-secondary">
            Your cart is empty
            </div>
            <div class="row" v-else>
                <div class="col-md-8 border-right">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input v-model="address.name" type="text" class="form-control" id="firstName" :class="{ 'input-error' : getValidationErrors('address.name') }">
                                <validation-errors :errors="getValidationErrors('address.name')"></validation-errors>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input v-model="address.last_name" type="text" class="form-control" id="lastName" :class="{ 'input-error' : getValidationErrors('address.last_name') }">
                                <validation-errors :errors="getValidationErrors('address.last_name')"></validation-errors>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input v-model="address.email" type="email" class="form-control" id="email" :class="{ 'input-error' : getValidationErrors('address.email') }">
                            <validation-errors :errors="getValidationErrors('address.email')"></validation-errors>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="city">City</label>
                                <input v-model="address.city" type="text" class="form-control" id="city" :class="{ 'input-error' : getValidationErrors('address.city') }">
                                <validation-errors :errors="getValidationErrors('address.city')"></validation-errors>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="address">Address</label>
                                <input v-model="address.address" type="text" class="form-control" id="address" :class="{ 'input-error' : getValidationErrors('address.address') }">
                                <validation-errors :errors="getValidationErrors('address.address')"></validation-errors>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <input v-model="address.country" type="text" class="form-control" id="country" :class="{ 'input-error' : getValidationErrors('address.country') }">
                                <validation-errors :errors="getValidationErrors('address.country')"></validation-errors>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <input v-model="address.state" type="text" class="form-control" id="state" :class="{ 'input-error' : getValidationErrors('address.state') }">
                                <validation-errors :errors="getValidationErrors('address.state')"></validation-errors>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input v-model="address.zip" type="text" class="form-control" id="zip" :class="{ 'input-error' : getValidationErrors('address.zip') }">
                                <validation-errors :errors="getValidationErrors('address.zip')"></validation-errors>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-lg btn-block mt-4" @click.prevent="booking" :disabled="disabled">Book now</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h6 class="text-secondary text-uppercase font-weight-bold">cart items</h6>
                    <div v-if="basketItems.length == 0" class="text-secondary">
                        Your cart is empty
                    </div>
                    <div v-else>
                        <transition-group name="fade">
                            <div v-for="(item,i) in basketItems" :key="`basket-${i}`" class="mb-2 border-top">
                                <div class="d-flex justify-content-between align-baseline pt-2">
                                    <router-link :to="{ name:'bookable-show',params : { slug : item.bookable.slug }}" class="text-dark font-weight-bolder">{{ item.bookable.title }}</router-link>
                                    <button @click="$store.dispatch('basket/removeFromBasket',item.bookable.slug )" class="remove"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                <div class="d-flex justify-content-between pt-1 text-secondary">
                                    <span>From : {{ item.from }}</span>
                                    <span>To : {{ item.to }}</span>
                                </div>
                                <div class="d-flex justify-content-between pt-1 text-dark">
                                    <span>Total</span>
                                    <span>${{ item.price.total }}</span>
                                </div>
                            </div>
                        </transition-group>
                        <div :class="{'border-top' : getValidationErrors('bookable.0') }">
                            <div v-for="(item,i) in basketItems" :key="`basket-e-${i}`" class="mb-2 ">
                                <validation-errors :errors="getValidationErrors(`bookable.${i}`)"></validation-errors>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
import ValidationError from './../global/mixins/ValidationError.js';
export default {
    name: "Basket",
    mixins : [ValidationError],
    data : () => ({
        address : {
            name : null ,
            last_name : null ,
            city : null ,
            address : null ,
            state : null ,
            country : null ,
            zip : null ,
            email : null ,
        },
        success : false ,
        disabled : false,
        fatalError : false ,
    }),
    computed:{
        ...mapState({
            basketItems : state => state.basket.basket
        }),
        bookable()
        {
            return _.map(this.basketItems , (item) => ({
                from : item.from,
                to : item.to,
                slug : item.bookable.slug,
                title : item.bookable.title,
            }));
        }
    },
    methods: {
        async booking()
        {
            this.success = false;
            this.fatalError = false;
            this.validationErrors = null;
            this.disabled = true;

            try {
                await axios.post(`/api/checkout`,{
                    address : this.address , bookable : this.bookable
                });
                this.success = true ;
                this.$store.dispatch('basket/clearBasket');
            }catch(error){
                if(error.response)
                {
                    if(error.response.status === 422)
                    {
                        this.validationErrors = error.response.data.errors;
                    }else{
                        this.fatalError = true ;
                    }
                }

            }

            this.disabled = false;
        }
    },
}
</script>
<style scoped>
.remove{
   border:none;
   outline: none;
   color: gray;
   background-color: inherit;
}
.remove:hover{
   color: #e3342f;
}
</style>
