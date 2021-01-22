<template>
    <div class="d-flex">
        <i class="fas fa-star" v-for="i in fullStar" :key="'full'+i"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="i in emptyStar" :key="'empty'+i"></i>
    </div>
</template>

<script>
    export default {
        name: "StarRating",
        props : {rating : Number},
        computed : {
            fullStar(){
                return Math.round(this.rating);
            },
            halfStar(){
                let x = this.rating - Math.floor(this.rating);
                return x > 0 && x< 0.5 ;
            },
            emptyStar(){
                return 5 - Math.ceil(this.rating);
            }
        }
    }
</script>

<style scoped>
    i {
        color : orange ;
    }
</style>