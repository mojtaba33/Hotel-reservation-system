<template>
    <div >
        <h6 class="text-uppercase text-secondary font-weight-bolder">reviews</h6>
        <div v-if="!loading">
            <div class="border-top pt-2" v-for="(review,i) in reviews" :key="'rev-'+i" >
                <div class="row">
                    <div class="col pb-1 font-weight-bolder">
                        davood
                    </div>
                    <div class="col d-flex justify-content-end">
                        <star-rating :rating="review.rating"></star-rating>
                    </div>
                </div>
                <div class="row">
                    <div class="col pb-1 font-weight-lighter text-secondary" style="font-size: 10px">
                        {{ review.created_at | fromNow }}
                    </div>
                </div>
                <p class="text-body">
                    {{ review.content }}
                </p>
            </div>
            <div class="text-secondary pt-2" v-if="reviews === null">
                there are no reviews!
            </div>
        </div>
        <div v-else>
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReviewList",
        data:() => ({
            reviews : null ,
            loading : true ,
        }),
        created(){
            let slug = this.$route.params.slug;
            axios.get(`/api/bookable/${slug}/review`).then(response => {
                this.reviews = response.data.data;
            }).then(() => this.loading = false)
        }
    }
</script>

<style scoped>

</style>