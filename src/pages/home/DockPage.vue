<template>
    <div class="dock">
        <router-link to="/publicadoption" style="text-decoration:none">
            <div class="icon">
                <span class="material-symbols-outlined">pet_supplies</span>
                <p class="text">公立領養</p>
            </div>
        </router-link> 
        <router-link to="/adopt" style="text-decoration:none">
            <div class="icon">
                <span class="material-symbols-outlined">sound_detection_dog_barking</span>
                <p>送領養</p>
            </div>
        </router-link>
        <router-link to="/home" style="text-decoration:none">
            <div class="icon">
                <span class="material-symbols-outlined">house</span>
                <p>首頁</p>
            </div>
        </router-link>
        <router-link to="/losthelp" style="text-decoration:none">
            <div class="icon">
                <span class="material-symbols-outlined">pets</span>
                <p>走失協尋</p>
            </div>
        </router-link>
        <router-link to="/myaccount" style="text-decoration:none">
            <div class="icon"  @click="my(me_num)">
                <span class="material-symbols-outlined" >person</span>
                <p>我的帳號</p>
            </div>
        </router-link>
    </div>
    <router-view/>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
</template>

<script>
    //呱
    export default {
        name:'DockHome',
        mounted() {
            this.me_num = localStorage.getItem('token');
        },
        methods:{
            my(){
                this.$router.push({
                    path: '/myaccount',
                    query: {
                        me_num: this.me_num,
                    },
                })
            },
        }
    }
</script>

<style lang="sass" scoped>
    .dock
        background-color: #FFFFFF
        display: flex
        margin-right: 5px
        text-align: center
        padding-top: 5px 
        justify-content: space-evenly
        & > a 
            &.router-link-active 
                .material-symbols-outlined
                    color: #FFD400
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


