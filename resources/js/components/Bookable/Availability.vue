<template>
    <div>
        <h5 class="text-dark mb-3">Availability : </h5>
        <form>
            <div class="row">
                <div class="col-6 form-group">
                    <label for="from" class="form-check-label text-secondary text-uppercase">from</label>
                    <input type="text" v-model="from" id="from" class="form-control form-control-sm">
                </div>
                <div class="col-6 form-group">
                    <label for="to" class="form-check-label text-secondary text-uppercase">to</label>
                    <input type="text" v-model="to" id="to" class="form-control form-control-sm">
                </div>
                <div class="col form-group">
                    <button class="btn btn-dark w-100 text-uppercase">check</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Availability",
        data:() => ({
           from : null ,
           to : null ,
        }),
    }
</script>

<style scoped>

</style>