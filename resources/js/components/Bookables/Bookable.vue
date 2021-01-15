<template>
    <div class="container mt-5">
        <div class="d-flex align-items-stretch flex-wrap ">
            <BookableItem v-for="(item,index) in items" :key="'item' + index" :item="item"></BookableItem>
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
            items : null,
        }),
        created(){
            axios.get('/api/bookable').then(response => {
                console.log(response);
            });
        }
    }
</script>

<style scoped>

</style>