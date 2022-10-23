<template>
    <div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th width="100">AÇÕES</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="category in categories.data" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>

                    <td>
                        <button class="btn btn-primary">Editar</button>
                        <button>Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    created() {
        this.$store.dispatch('loadCategories')
    },
    computed:{
        categories(){
            return this.$store.state.categories.categoriesState
        }
    }

};
</script>

<style scoped>
div {
    color: #000;
}
</style>
