<template>
    <div>
        <nav class="navbar border-bottom ">
            <router-link class="text-dark font-weight-bold" :to="{name:'home'}" >
                UdemyMaster
            </router-link>
            <div class="d-flex align-items-baseline justify-content-end">
                <router-link class="text-dark font-weight-bold" :to="{name:'home'}" >
                    Basket
                </router-link>
                <span class="badge bg-secondary text-light ml-1" v-if="basketCount">{{ basketCount }}</span>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "Index",
        computed:{
            ...mapGetters({
                basketCount : 'basket/basketCount',
            }),
        }
    }
</script>

<style scoped>

</style>