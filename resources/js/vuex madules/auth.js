export const auth = {
    namespaced: true,
    state: {
        isLogin : localStorage.getItem("isLogin") == "true" ? true : false ,
        user : {},
    },
    mutations: {
        isLogin(state , payload)
        {
            state.isLogin = payload ;
        },
        setUser(state , payload)
        {
            state.user = payload ;
        }
    },
    actions: {
        async getUser (context)
        {
            if ( context.state.isLogin == true )
            {
                try {
                    const response = await axios.get(`/api/user`);
                    context.commit("setUser",response.data);
                    localStorage.setItem("isLogin","true");
                } catch (error) {
                    context.dispatch("logout");
                }
            }else{
                context.dispatch("logout");
            }
        },
        login(context)
        {
            context.commit("isLogin",true);
            context.dispatch("getUser");
        },
        logout(context)
        {
            context.commit("isLogin",false);
            localStorage.setItem("isLogin","false");
            context.commit("setUser",{});
        }
    }
};
