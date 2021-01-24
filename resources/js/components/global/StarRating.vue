<template>
    <div class="d-flex">
        <i class="fas fa-star" @click="$emit('input', i)" v-for="i in fullStar" :key="'full'+i"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" @click="$emit('input', fullStar + i)" v-for="i in emptyStar" :key="'empty'+i"></i>
    </div>
</template>

<script>
    export default {
        name: "StarRating",
        props : {value : Number},
        computed : {
            fullStar(){
                return Math.round(this.value);
            },
            halfStar(){
                let x = this.value - Math.floor(this.value);
                return x > 0 && x< 0.5 ;
            },
            emptyStar(){
                return 5 - Math.ceil(this.value);
            }
        }
    }
</script>

<style scoped>
    i {
        color : orange ;
    }
</style>