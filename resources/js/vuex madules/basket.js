export const basket = {
    namespaced: true,
    state: {
        basket : localStorage.getItem('basket') ? JSON.parse(localStorage.getItem('basket')) : [] ,
    },
    getters:{
        isAlreadyInBasket: (state) => (slug) => {
            return !! _.find(state.basket, (o) => o.bookable.slug === slug );
        },
        basketCount(state)
        {
            return state.basket.length;
        }
    },
    mutations: {
        addToBasket(state , payload)
        {
            state.basket.push(payload);
        },
        removeFromBasket(state , payload)
        {
            state.basket = _.filter(state.basket , (o) => o.bookable.slug !== payload  ) ;
        },
        clearBasket(state , payload)
        {
            state.basket = payload ;
        }
    },
    actions: {
        addToBasket({commit,state} , payload)
        {
            commit('addToBasket',payload);
            localStorage.setItem('basket',JSON.stringify(state.basket));
        },
        removeFromBasket({commit,state} , payload)
        {
            commit('removeFromBasket',payload);
            localStorage.setItem('basket',JSON.stringify(state.basket));
        },
        clearBasket({commit,state})
        {
            commit('clearBasket',[]);
            localStorage.setItem('basket',JSON.stringify(state.basket));
        }
    }
};
