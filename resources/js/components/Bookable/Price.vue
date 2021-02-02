<template>
    <div class="mt-4">
        <div v-if="gettingPrice" class="text-center">
            <div class="spinner-grow spinner-grow-sm text-dark" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <div v-else class="d-flex flex-column justify-content-start">
            <h5 class="text-uppercase text-dark">price breakdown</h5>
            <div v-for="(days,amount) in price.breakdown" :key="amount" class="d-flex justify-content-between border-bottom mb-2">
                <span>{{ days }} {{ days == 1 ? 'Day' : 'Days' }}</span>
                <span>${{ amount }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>total</span>
                <span>${{ price.total }}</span>
            </div>
            <button class="btn btn-outline-dark btn-block" @click="addToBasket" :disabled="disabled || isAlreadyInBasket">Book now
                <span v-if="disabled" class="spinner-border spinner-border-sm text-dark" role="status" aria-hidden="true"></span>
            </button>

        </div>

        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        name: "Price",
        props:['price','gettingPrice','bookable'],
        data:()=>({
            disabled : false,
        }),
        computed : {
            ...mapState({
                lastSearch : state => state.availability.lastSearch,
            }),
            isAlreadyInBasket()
            {
                return this.$store.getters['basket/isAlreadyInBasket'](this.bookable.slug);
            }
        },
        methods:{
            addToBasket()
            {
                this.disabled = true;

                const slug = this.$route.params.slug;
                this.$store.dispatch('basket/addToBasket',{
                    price : this.price,
                    bookable : this.bookable,
                    from : this.lastSearch.from,
                    to : this.lastSearch.to
                });

                this.disabled = false;
            }
        }
    }
</script>

<style scoped>

</style>
