<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Dashbord</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'admin.categories'}" class="nav-link">Categorias </router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
    // computed:{
    //     totalCategories(){
    //         return this.$store.state.categories.categoriesState.data.length
    //     }
    // }
}
</script>

<style scoped>

</style>