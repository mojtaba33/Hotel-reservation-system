export const auth = {
    namespaced: true,
    state: {
        isLoggedIn : localStorage.getItem("isLoggedIn") == "true" ? true : false ,
        user : {},
    },
    mutations: {
        isLoggedIn(state , payload)
        {
            state.isLoggedIn = payload ;
        },
        setUser(state , payload)
        {
            state.user = payload ;
        }
    },
    actions: {
        async getUser (context)
        {
            if ( context.state.isLoggedIn == true )
            {
                try {
                    const response = await axios.get(`/api/user`);
                    context.commit("setUser",response.data);
                    localStorage.setItem("isLoggedIn","true");
                } catch (error) {
                    context.dispatch("logout");
                }
            }else{
                context.dispatch("logout");
            }
        },
        login(context)
        {
            context.commit("isLoggedIn",true);
            context.dispatch("getUser");
        },
        logout(context)
        {
            context.commit("isLoggedIn",false);
            localStorage.setItem("isLoggedIn","false");
            context.commit("setUser",{});
        }
    }
};
