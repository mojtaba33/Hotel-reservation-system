<template>
    <div>
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div v-else class="row mb-5">
            <div class="col-md-8  border-right pb-4">
                <div class="pb-4">
                    <h1>{{ bookable.title }}</h1>
                    <p>{{ bookable.description }}</p>
                </div>
                <review-list></review-list>
            </div>
            <div class="col-md-4">
                <availability @show-price="showPrice($event)"></availability>
                <transition name="fade">
                    <price :price="price" :getting-price="gettingPrice" :bookable="bookable" v-if="price" ></price>
                </transition>
                <transition name="fade">
                    <div v-if="isAlreadyInBasket" class="mt-3">
                        <button class="btn btn-block btn-outline-secondary text-uppercase" @click="$store.dispatch('basket/removeFromBasket',slug)">remove from basket</button>
                        <div class="mt-4 text-muted warning">Seems like you've added this object to basket already. If you want to change dates, remove from the basket first.</div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    import Price from './Price';

    export default {
        name: "ShowBookable",
        components : {
            Availability,ReviewList,Price
        },
        data : () =>  ({
            bookable : null,
            loading : true,
            slug : null,
            price : null,
            gettingPrice : false,
        }),
        computed:{
            from () {return this.$store.state.availability.lastSearch.from},
            to () {return this.$store.state.availability.lastSearch.to},
            isAlreadyInBasket()
            {
                return this.$store.getters['basket/isAlreadyInBasket'](this.slug);
            }
        },
        created(){
            this.slug = this.$route.params.slug;
            axios.get(`/api/bookable/${this.slug}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false;
                })
        },
        methods:{
            showPrice(hasAvailability)
            {
                if (hasAvailability)
                {
                    this.gettingPrice = true;
                    axios.post(`/api/bookable/${this.slug}/price`,{
                        from: this.from,
                        to : this.to
                    }).then(res => {
                        this.price = res.data.data;
                    }).catch( () => {
                        this.price = null;
                    }).then(() => {this.gettingPrice = false});
                }
            }
        }
    }
</script>

<style scoped>

</style>
