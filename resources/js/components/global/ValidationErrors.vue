<template>
    <div>
        <div v-for="(error,i) in errors" :key="'te'+i" class="text-danger font-weight-light" >
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        props : ['errors'],
        name: "ValidationErrors"
    }
</script>

<style scoped>

</style>