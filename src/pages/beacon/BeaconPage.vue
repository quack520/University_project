<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="beacon">

    </div>
    <div class="dock">
        <router-link to="/publish">
            <div class="icon">
                <span class="material-symbols-outlined">location_on</span>
                <p class="text">尋找</p>
            </div>
        </router-link>
        <router-link to="/home">
            <div class="icon">
                <span class="material-symbols-outlined">house</span>
                <p>首頁</p>
            </div>
        </router-link>
        <router-link to="/home">
            <div class="icon">
                <span class="material-symbols-outlined">account_circle</span>
                <p>自己</p>
            </div>
        </router-link>
    </div>

</template>

<script>
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    export default {
        name:'BeaconPage',
        components:{
            HeaderHome
        },
  }
</script>

<style lang="sass" scoped>
    .header
        height: 10%
        width: 100%
        position: fixed
        top: 0
        left: 0
        overflow: visible
        z-index: 999
    .beacon
        background-color: #FEEABC
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1

    .dock
        background-color: #FFFFFF
        display: flex
        width: max-content
        margin-right: 5px
        text-align: center
        padding-top: 5px 
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        justify-content: space-evenly

        .icon
            width: 73px
            text-align: center
            text-decoration: none
            color: black
            
            .material-symbols-outlined
                font-size: 36px
                color: black
                text-decoration: none
</style>
