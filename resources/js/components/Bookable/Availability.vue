<template>
    <div>
        <h5 class="text-dark mb-3">Check Availability
            <span v-if="is_available === true" class="text-success" style="font-size: 14px;"> ( Available ) </span>
            <span v-else-if="is_available === false" class="text-danger" style="font-size: 14px;"> ( Not Available ) </span>
        </h5>
        <form>
            <div class="row">
                <div class="col-6 form-group">
                    <label for="from" class="form-check-label text-secondary text-uppercase">from</label>
                    <input type="text" v-model="from" id="from" class="form-control form-control-sm">
                    <div v-if="errors">
                        <div  v-for="(error,i) in errors.from" :key="'fe'+i" class="text-danger font-weight-light">
                            {{ error }}
                        </div>
                    </div>
                </div>
                <div class="col-6 form-group">
                    <label for="to" class="form-check-label text-secondary text-uppercase">to</label>
                    <input type="text" v-model="to" id="to" class="form-control form-control-sm">
                    <div v-if="errors">
                        <div v-if="errors" v-for="(error,i) in errors.to" :key="'te'+i" class="text-danger font-weight-light">
                            {{ error }}
                        </div>
                    </div>
                </div>
                <div class="col form-group">
                    <button class="btn btn-dark w-100 text-uppercase" @click.prevent="check" :disabled="disabled">check
                        <span v-if="disabled" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
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
            is_available : null,
            errors : null,
            disabled : false
        }),
        computed:{
            fromError()
            {
                if (this.errors)
                {
                    return this.errors.from
                }
            }
        },
        methods:{
            check()
            {
                let slug = this.$route.params.slug;
                this.disabled = true;
                this.errors = null ;
                this.is_available = null ;

                axios.get(`/api/bookable/${slug}/availability/`,{
                    params:{
                        'from' : this.from,
                        'to' : this.to
                    }
                }).then(response => {
                    this.is_available = response.data.data.is_available;
                }).catch(error => {
                    if ( error.response.status === 422 )
                    {
                        this.errors = error.response.data.errors ;
                    }
                }).then(() => this.disabled = false);
            }
        }
    }
</script>

<style scoped>

</style>