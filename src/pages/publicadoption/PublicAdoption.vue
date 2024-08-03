<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="publicadoption"><PublicAdoption_list></PublicAdoption_list></div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  import PublicAdoption_list from '@/pages/publicadoption/PublicAdoptionlist.vue'
  export default {
    name:'PublicAdoptionPage',
    components:{
        HeaderHome,
        DockHome,
        PublicAdoption_list
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
    .publicadoption
        background-color:#FEEABC
        display: flex 
        justify-content: center
        flex-wrap: wrap
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: auto
        z-index: 1

        
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
