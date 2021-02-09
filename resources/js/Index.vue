<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
            <router-link class="navbar-brand" :to="{name:'home'}" >
                UdemyMaster
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'basket'}" active-class="active">
                        Basket <span class="badge bg-secondary text-light" style="vertical-align:middle !important;" v-if="basketCount">{{ basketCount }}</span>
                        </router-link>

                    </li>

                    <li v-if="isLoggedIn" class="nav-item">
                        <router-link class="nav-link" :to="{name:'profile'}" active-class="active">Profile</router-link>
                    </li>

                    <li v-if="isLoggedIn" class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="logout" >Logout</a>
                    </li>

                    <li v-if="!isLoggedIn" class="nav-item">
                        <router-link class="nav-link" :to="{name:'login'}" active-class="active">Login</router-link>
                    </li>

                    <li v-if="!isLoggedIn" class="nav-item">
                        <router-link class="nav-link" :to="{name:'register'}" active-class="active">Register</router-link>
                    </li>
                </ul>
            </div>
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
