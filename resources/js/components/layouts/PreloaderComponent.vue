<template>
  <div class="preloader" v-show="loading">
    <img src="/img/loading-buffering.gif" alt="preloader">
  </div>
</template>

<script>
export default {
    computed:{
        loading(){
            return this.$store.state.preloader.loading;
        }
    }
}
</script>

<style scoped>
.preloader{
    background: #000;
    position: absolute;
    z-index: 1;
    opacity: .3;
    width: 100%;
    height: 100%;
    text-align: center;
    top: 0;
    left: 0;
    margin: 0;
    padding:10% 0;
}
.preloader img{
    max-width: 60px;
}
</style>