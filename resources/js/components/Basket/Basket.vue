<template>
    <div class="row">
        <div class="col-md-8">form</div>
        <div class="col-md-4">
            <h6 class="text-secondary text-uppercase font-weight-bold">basket items</h6>
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
