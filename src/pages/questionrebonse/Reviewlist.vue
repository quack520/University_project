<template>
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter">
            回報表單
        </div>
    </div>
    <div class="message">
        <div class="body" v-for="pet in pets" :key="pet.id">
            <router-link to="/returnlist" style="text-decoration:none" @click="returnlist(pet.pet_num)">
                <div class="text">
                    <div class="lef">
                        <p class="data">{{ pet.pet_name }}</p>
                    </div>
                    <div class="mid">
                        <div class="title">種類:</div><p class="data">{{ pet.pet_type }}</p>
                    </div>
                    <div class="rig">
                        <div class="title">品種:</div><p class="data">{{ pet.variety }}</p>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'QuestionlistPage',
        components:{
            DockHome
        },
        data(){
            return{
                pets:[],
            };
        },
        mounted() {
            this.fetchData();
        },
        methods:{
            back()
            {
                if(this.$route.query.me_num) {
                    this.$router.push({
                        path: '/myaccount',
                        query: { 
                            me_num: this.$route.query.me_num 
                        }
                    });
                } else {
                    this.$router.go(-1);
                }
            },
            fetchData() {
                axios.get(`/api/php/reviewlist.php?me_num=${localStorage.getItem('token')}`,)
                
                    .then(res => {
                        this.pets = res.data;
                        this.pet_num = res.pet_num
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            returnlist(num) {
                this.$router.push({
                    path: '/returnlist',
                    query: {
                        pet_num: num
                    }
                })
            }
        }
  
    };
</script>

<style lang="sass" scoped>
    .header
        height:10%
        width: 100%
        position: fixed
        top: 0
        left: 0
        background-color:#FEEABC
        display: flex 
        border-bottom: solid
        border-color: #000 
        
        .infoleft
            width: 33%
            text-align: left
            margin-top: 1rem
            .material-symbols-outlined
                font-size: 36px
                
        .infocenter
            width: 33%
            text-align: center
            margin-top: 9px
            font-size: 30px
            font-weight: bolds
            justify-content: center
    .message
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        .body
            .text
                width: 100vw
                height: 10vh
                border-bottom-style: solid
                display: flex
                justify-content: center
                align-items: center
                margin: 16px 0 0 0
                color: #000
                .lef
                    width: 25vw
                    display: flex
                    justify-content: center
                    align-items: center
                    .data
                        font-size: 16px
                .mid
                    width: 50vw
                    display: flex
                    justify-content: center
                    align-items: center
                    .title
                        margin: 0 0 16px
                        font-size: 16px
                    .data
                        font-size: 16px
                .rig
                    width: 25vw
                    display: flex
                    justify-content: center
                    align-items: center
                    .title
                        margin: 0 0 16px
                        font-size: 16px
                    .data
                        font-size: 16px
            .color
                width: 25vw
                height: 10vh
                background-color: #ADADAD
                display: flex
                justify-content: center
                align-items: center
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
</style>
