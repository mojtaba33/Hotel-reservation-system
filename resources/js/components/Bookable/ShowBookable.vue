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
                <availability></availability>
            </div>
        </div>
    </div>
</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';

    export default {
        name: "ShowBookable",
        components : {
            Availability,ReviewList
        },
        data : () =>  ({
            bookable : null,
            loading : true,
        }),
        created(){
            let slug = this.$route.params.slug;
            axios.get(`/api/bookable/${slug}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false;
                })
        }
    }
</script>

<style scoped>

</style>