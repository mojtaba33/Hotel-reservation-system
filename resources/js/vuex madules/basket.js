export const basket = {
    namespaced: true,
    state: {
        basket : localStorage.getItem('basket') ? JSON.parse(localStorage.getItem('basket')) : [] ,
    },
    getters:{
        isAlreadyInBasket: (state) => (slug) => {
            return !! _.find(state.basket, {bookable: slug});
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
        }
    },
    actions: {
        addToBasket({commit,state} , payload)
        {
            commit('addToBasket',payload);
            localStorage.setItem('basket',JSON.stringify(state.basket));
        }
    }
};