<template>
    <div class="col-md-4 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ bookable.title }}</h5>
                <p class="card-text">{{ bookable.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookableItem",
        props : ['bookable']
    }
</script>

<style scoped>

</style>