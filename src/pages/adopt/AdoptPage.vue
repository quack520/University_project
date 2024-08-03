<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="adopt"><Adopt_list></Adopt_list></div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  import Adopt_list from '@/pages/adopt/components/Adoptlist.vue'
  export default {
    name:'AdoptPage',
    components:{
        HeaderHome,
        DockHome,
        Adopt_list
    },
  }
</script>

<style lang="sass" scoped>
    .header
        height:10%
        width: 100%
        position: fixed
        top: 0
        left: 0
        z-index: 999
    .adopt
        background-color:#FEEABC
        display: flex 
        justify-content: center
        flex-wrap: wrap
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: scroll
        z-index: 1
        
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
