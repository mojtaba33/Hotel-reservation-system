<template>
    <div>
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div v-else class="row">
            <div class="col-md-8  border-right pb-4">
                <h1>{{ bookable.title }}</h1>
                <p>{{ bookable.description }}</p>
            </div>
            <div class="col-md-4">
                <availability></availability>
            </div>
        </div>
    </div>
</template>

<script>
    import availability from './Availability';
    export default {
        name: "ShowBookable",
        components : {
            availability
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