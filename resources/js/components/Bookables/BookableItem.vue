<template>
    <div class="col-md-4 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ item.name }}</h5>
                <p class="card-text">{{ item.lastName }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookableItem",
        props : ['item']
    }
</script>

<style scoped>

</style>