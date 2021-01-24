<template>
    <div>
        <div class="form-group">
            <label>rating : </label>
            <star-rating v-model="value" class="fa-2x"></star-rating>
        </div>
        <div class="form-group">
            <label for="content">describe your experience : </label>
            <textarea class="form-control" id="content" rows="10"></textarea>
        </div>
        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-primary">submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Review" ,
        data : () => ({
            value : 5 ,
        }),
    }
</script>

<style scoped>

</style>