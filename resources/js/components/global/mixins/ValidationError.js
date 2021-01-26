export default {
    data : () => ({
        validationErrors : null,
    }),
    methods:{
        getValidationErrors(name)
        {
            return this.validationErrors !== null && this.validationErrors[name] !== null
                ? this.validationErrors[name]
                : null ;
        }
    },
}