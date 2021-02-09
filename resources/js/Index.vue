<template>
    <div>
        <nav class="navbar border-bottom ">
            <router-link class="text-dark font-weight-bold" :to="{name:'home'}" >
                UdemyMaster
            </router-link>
            <ul class="list-group-horizontal d-flex align-items-baseline justify-content-end">
                <li class="list-group-item">
                    <router-link class="text-dark font-weight-bold" :to="{name:'basket'}" >
                    Basket
                    </router-link>
                    <span class="badge bg-secondary text-light ml-1" v-if="basketCount">{{ basketCount }}</span>
                </li>

                <li v-if="isLoggedIn" class="list-group-item">
                    <router-link class="text-dark font-weight-bold" :to="{name:'profile'}" >Profile</router-link>
                </li>

                <li v-if="isLoggedIn" class="list-group-item">
                    <a class="text-dark font-weight-bold" href="#" @click.prevent="logout" >Logout</a>
                </li>

                <li v-if="!isLoggedIn" class="list-group-item">
                    <router-link class="text-dark font-weight-bold" :to="{name:'login'}" >Login</router-link>
                </li>

                <li v-if="!isLoggedIn" class="list-group-item">
                    <router-link class="text-dark font-weight-bold" :to="{name:'register'}" >Register</router-link>
                </li>
            </ul>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import {mapState} from 'vuex';
    export default {
        name: "Index",
        computed:{
            ...mapGetters({
                basketCount : 'basket/basketCount',
            }),
            ...mapState({
                isLoggedIn : state => state.auth.isLoggedIn
            })
        },
        methods: {
            async logout()
            {
                try {
                    await axios.post(`/logout`);
                    this.$store.dispatch("auth/logout");
                } catch (error) {
                    this.$store.dispatch("auth/logout");
                }
            }
        },
    }
</script>

<style scoped>

</style>
