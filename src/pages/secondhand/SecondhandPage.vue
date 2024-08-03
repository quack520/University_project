<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="secondhand"><Secondhand_list></Secondhand_list></div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  import Secondhand_list from  '@/pages/secondhand/components/Secondhandlist.vue'
  export default {
    name:'resetpasswordPage',
    components:{
        HeaderHome,
        DockHome,
        Secondhand_list
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
    .secondhand
        background-color:#FEEABC
        display: flex 
        flex-wrap: wrap
        justify-content: center
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        overflow: auto

    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
