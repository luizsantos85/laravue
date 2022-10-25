export default {
    state: {
        categoriesState: {
            data: [],
        },
    },
    mutations: {
        LOAD_CATEGORIES(state, categories) {
            state.categoriesState = categories;
        }
    },
    actions: {
        loadCategories(context) {
            context.commit("CHANGE_PRELOADER", true);
            axios
                .get("/api/v1/categories")
                .then((response) => {
                    // console.log(response);
                    context.commit('LOAD_CATEGORIES', response);
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {context.commit("CHANGE_PRELOADER", false);});
        },
    },
    getters: {},
};
