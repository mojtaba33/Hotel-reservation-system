<template>
    <div>
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div v-else>
            <div v-if="review == null">
                <div class="form-group">
                    <label>rating : </label>
                    <star-rating v-model="value" class="fa-2x"></star-rating>
                </div>
                <div class="form-group">
                    <label for="content">describe your experience : </label>
                    <textarea class="form-control" id="content" rows="10"></textarea>
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-primary">submit</button>
                </div>
            </div>
            <div v-else class="text-secondary font-weight-bolder">
                you have already post a review
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
            loading : true ,
        }),
        created()
        {
            let id = this.$route.params.id;
            axios.get(`/api/review/${id}`).then(response => {
                this.review = response.data.data;
            }).catch(error => {

            }).then(() => {
                this.loading = false;
            })
        }
    }
</script>

<style scoped>

</style>