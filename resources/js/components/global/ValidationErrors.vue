<template>
    <div>
        <div v-for="(error,i) in errors" :key="key(i)" class="text-danger font-weight-light " >
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        props : ['errors'],
        name: "ValidationErrors",
        methods:{
            key(i)
            {
                return `error-${Math.random()}-${i}`;
            }
        }
    }
</script>