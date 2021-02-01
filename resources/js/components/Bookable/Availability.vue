<template>
    <div>
        <h5 class="text-dark mb-3">Check Availability
            <transition name="fade">
                <span v-if="is_available === true" class="text-success" style="font-size: 14px;"> ( Available ) </span>
                <span v-else-if="is_available === false" class="text-danger" style="font-size: 14px;"> ( Not Available ) </span>
            </transition>
        </h5>
        <form>
            <div class="row">
                <div class="col-6 form-group">
                    <label for="from" class="form-check-label text-secondary text-uppercase" style="font-size: 12px">from</label>
                    <input type="text" v-model="from" id="from" class="form-control form-control-sm" :class="{ 'input-error' : getValidationErrors('from') }">
                    <validation-errors :errors="getValidationErrors('from')"></validation-errors>
                </div>
                <div class="col-6 form-group">
                    <label for="to" class="form-check-label text-secondary text-uppercase" style="font-size: 12px">to</label>
                    <input type="text" v-model="to" id="to" class="form-control form-control-sm" :class="{ 'input-error' : getValidationErrors('to') }">
                    <validation-errors :errors="getValidationErrors('to')"></validation-errors>
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
    import ValidationErrorMixin from '../global/mixins/ValidationError';
    export default {
        name: "Availability",
        mixins : [ValidationErrorMixin],
        data:() => ({
            is_available : null,
            disabled : false
        }),
        computed:{
            from: {
                get () {
                    return this.$store.state.availability.lastSearch.from;
                },
                set (value) {
                    this.$store.dispatch('availability/saveFrom', value)
                }
            },
            to: {
                get () {
                    return this.$store.state.availability.lastSearch.to
                },
                set (value) {
                    this.$store.dispatch('availability/saveTo', value)
                }
            },
        },
        methods:{
            async check()
            {
                let slug = this.$route.params.slug;
                this.disabled = true;
                this.validationErrors = null ;
                this.is_available = null ;

                axios.get(`/api/bookable/${slug}/availability/`,{
                    params:{
                        'from' : this.from,
                        'to' : this.to
                    }
                }).then(response => {
                    this.is_available = response.data.data.is_available;
                    this.$emit('show-price' , this.is_available );
                }).catch(error => {
                    this.$emit('show-price' , false );
                    if ( error.response.status === 422 )
                    {
                        this.validationErrors = error.response.data.errors ;
                    }
                }).then(() => this.disabled = false);
            }
        }
    }
</script>

<style>

</style>