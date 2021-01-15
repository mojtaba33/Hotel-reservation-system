<template>
    <div>
        <nav class="navbar border-bottom ">
            <router-link class="text-dark font-weight-bold" :to="{name:'home'}" >
                UdemyMaster
            </router-link>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>

</style>