<template>
    <div class="row">
        <div class="col-md-8 border-right">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName">
                        <div class="invalid-feedback">
                        Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip">
                    </div>
                </div>
                <button class="btn btn-dark btn-lg btn-block mt-4" type="submit">Book now</button>
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
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';
export default {
    name: "Basket",
    computed:{
        ...mapState({
            basketItems : state => state.basket.basket
        })
    }
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
