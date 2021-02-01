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
                    <price :price="price" :getting-price="gettingPrice" v-if="price" ></price>
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
                        this.gettingPrice = false;
                    }).catch( () => {
                        this.price = null;
                        this.gettingPrice = false;
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>