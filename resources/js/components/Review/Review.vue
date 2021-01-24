<template>
    <div>
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div v-else>
            <div v-if="reviewExist">
                <h3  class="text-secondary font-weight-bolder">You've already left a review for this booking!</h3>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-4">
                        <h5>stayed at
                            <router-link :to="{name:'bookable-show',params:{slug : booking.bookable.slug}}">{{ booking.bookable.title }}</router-link>
                        </h5>
                        <p class="text-secondary">From {{ booking.from }} To {{ booking.to }} </p>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group ">
                            <label class="col-form-label">Select the star rating : </label>
                            <star-rating v-model="value" class="fa-2x"></star-rating>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="content">describe your experience : </label>
                            <textarea class="form-control" id="content" rows="10"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-primary">submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Review" ,
        data : () => ({
            value : 5 ,
            review : null ,
            booking : null ,
            loading : true ,
        }),
        created()
        {
            let id = this.$route.params.id;
            axios.get(`/api/review/${id}`).then(response => {
                this.review = response.data.data;
            }).catch(error => {
                if( error.response.status === 404 )
                {
                    axios.get(`/api/booking/${id}`).then(response => {
                        this.booking = response.data.data;
                    }).catch(error => {})
                }
            }).then(() => {
                this.loading = false;
            });
        },
        computed:{
            reviewExist()
            {
                return this.review !== null || this.booking === null ;
            }
        }
    }
</script>

<style scoped>

</style>