<template>
    <div class="card my-3">
        <div class="card-body">
            <div>
                <h3 class="card-title float-start">Listagem de categorias</h3>
                <router-link :to="{name: 'categories.create'}" class="btn btn-sm btn-primary float-end">
                    Nova categoria
                </router-link>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th width="200">AÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="category in categories.data"
                        :key="category.id"
                        class=""
                    >
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>

                        <td>
                            <button class="btn btn-outline-primary btn-sm my-1">
                                Editar
                            </button>
                            <button class="btn btn-outline-danger btn-sm my-1">
                                Excluir
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch("loadCategories");
    },
    computed: {
        categories() {
            return this.$store.state.categories.categoriesState;
        },
    },
};
</script>

<style scoped>
div {
    color: #000;
}
</style>
