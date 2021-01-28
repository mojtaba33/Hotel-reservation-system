export const availability = {
    namespaced: true,
    state: {
        lastSearch:{
            from : localStorage.getItem('from') ?? null ,
            to: localStorage.getItem('to') ?? null ,
        }
    },
    mutations: {
        setFrom (state,payload) {
            state.lastSearch.from = payload ;
        },
        setTo (state,payload) {
            state.lastSearch.to = payload ;
        }
    },
    actions: {
        saveFrom (context , payload)
        {
            context.commit('setFrom',payload);
            localStorage.setItem('from',payload);
        },
        saveTo (context , payload)
        {
            context.commit('setTo',payload);
            localStorage.setItem('to',payload);
        },
    }
};