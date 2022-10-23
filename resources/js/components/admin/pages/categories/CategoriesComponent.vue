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
            <td> {{category.id}} </td>
            <td> {{category.name}} </td>
            <td> *** </td>
        </tr>
    </tbody>

    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            categories: []
        }
    },
    created(){
       this.loadCategories()
    },

    methods: {
        loadCategories(){
            axios.get('/api/v1/categories')
                .then(response => {
                    this.categories = response;
                })
                .catch(error =>{
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>

div{
    color: #000;
}

</style>