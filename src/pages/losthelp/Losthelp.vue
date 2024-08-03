<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="losthelp"><Losthelp_list></Losthelp_list></div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  import Losthelp_list from '@/pages/losthelp/component/Losthelplist.vue'
  export default {
    name:'losthelpPage',
    components:{
        HeaderHome,
        DockHome,
        Losthelp_list
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
    .losthelp
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
