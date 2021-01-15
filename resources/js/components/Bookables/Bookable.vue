<template>
    <div class="container mt-5">
        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border " role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
        <div v-else class="d-flex align-items-stretch flex-wrap ">
            <BookableItem v-for="(bookable,index) in bookables" :key="'item' + index" :bookable="bookable"></BookableItem>
        </div>
    </div>
</template>

<script>
    import BookableItem from "./BookableItem";
    export default {
        name: "Bookable",
        components : {
            BookableItem
        },
        data : () => ({
            bookables : null,
            loading : true ,
        }),
        created(){
            axios.get('/api/bookable').then( response => {
                this.bookables = response.data.data ;
                this.loading = false ;
            });
        }
    }
</script>

<style scoped>

</style>