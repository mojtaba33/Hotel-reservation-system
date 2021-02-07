<template>
    <div>
        <div v-if="success">
            <success>
                your review registered successfully
            </success>
        </div>
        <fatal-error v-if="fatalError"></fatal-error>
        <div v-if="!fatalError && !success">
            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border " role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
            <div v-else>
                <div v-if="reviewExist">
                    <h3  class="text-secondary font-weight-bolder">You've already left a review for this booking!</h3>
                </div>
                <div v-else>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>stayed at
                                <router-link :to="{name:'bookable-show',params:{slug : booking.bookable.slug}}">{{ booking.bookable.title }}</router-link>
                            </h5>
                            <p class="text-secondary">From {{ booking.from }} To {{ booking.to }} </p>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group ">
                                <label class="col-form-label">Select the star rating : </label>
                                <star-rating v-model="value" class="fa-2x"></star-rating>
                            </div>
                            <div class="form-group ">
                                <label class="col-form-label" for="content">describe your experience : </label>
                                <textarea v-model="content" class="form-control" :class="{ 'input-error' : getValidationErrors('content') }" id="content" rows="10"></textarea>
                                <validation-errors :errors="getValidationErrors('content')"></validation-errors>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-primary" @click.prevent="store" :disabled="disabled">submit
                                    <span v-if="disabled" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ValidationErrorMixin from '../global/mixins/ValidationError';
    export default {
        name: "Review" ,
        mixins : [ValidationErrorMixin],
        data : () => ({
            value : 5 ,
            content : null,
            id : null ,
            review : null ,
            booking : null ,
            success : false,
            fatalError : false,
            loading : true ,
            disabled : false ,
        }),
        async created()
        {
            this.id = this.$route.params.id;
            try {
                this.review = (await axios.get(`/api/review/${this.id}`)).data.data;
            }catch (e) {
                if( e.response.status === 404 )
                {
                    try{
                        this.booking = (await  axios.get(`/api/booking/${this.id}`)).data.data;
                    }catch (e) {
                        this.fatalError = true ;
                    }
                }else{
                    this.fatalError = true ;
                }
            }

            this.loading = false;
        },
        methods:{
            store()
            {
                this.success = false;
                this.fatalError = false;
                this.validationErrors = null;
                this.disabled = true;

                axios.post(`/api/review`,{
                    id : this.id,
                    content: this.content ,
                    rating : this.value
                }).then(res => {
                    if(res.status === 201)
                    {
                        this.success = true;
                    }
                }).catch(err => {
                    if(err.response.status === 422)
                    {
                        err.response.data.errors.content !== null && _.size(err.response.data.errors) !== 0
                            ? this.validationErrors = err.response.data.errors
                            : this.fatalError = true;
                    }
                }).then(()=>this.disabled = false);
            }
        },
        computed:{
            reviewExist()
            {
                return this.review !== null || this.booking === null ;
            }
        }
    }
</script>

<style scoped>

</style>
