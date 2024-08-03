<template>
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter">
            填寫領養回報表單
        </div>
    </div>
    <div class="frequency">
        <div class="flex">
            <div class="title">
                送養
            </div>

            <q-btn class="submit" label="填寫回饋表單" @click="questionrebonse"></q-btn>
            <div class="question" v-for="pet_questionrebonse in pets_questionrebonse" :key="pet_questionrebonse.id" >
                <router-link to="/questionrebonseinfo" style="text-decoration:none" @click="questionInfo(pet_questionrebonse.pet_num,pet_questionrebonse.rebonse_times)">
                    <div class="pet" >     
                                       
                        <div class="p_title1">
                            <div class="che" v-if="pet_questionrebonse.rebonse_check == '1'">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                            <div class="x" v-if="pet_questionrebonse.rebonse_check == '2'">
                                <span class="material-symbols-outlined">close</span>
                            </div>
                            第{{pet_questionrebonse.rebonse_times}}次回報/共6次
                        </div>       
                    </div>
                </router-link>
            </div>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'FrequwncyPage',
        components:{
            DockHome
        },
        data(){
            return{
                pets_questionrebonse:[],
            }
        },
        created(){
            this.fetchData()
        },
        
        methods:{
            back()
            {
                this.$router.go(-1)
            },
            async fetchData(){
                await axios.get('/api/php/frequency.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }                    
                })
                .then(res => {
                    this.pets_questionrebonse = res.data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                    
            },
            questionrebonse()
            {
                this.$router.push({
                    path: '/questionrebonse',
                    query: {
                        pet_num: this.$route.query.pet_num
                    }
                })
            },
            questionInfo(num,times)
            {
                this.$router.push({
                    path: '/questionrebonseinfo',
                    query: {
                        pet_num: num,
                        rebonse_times: times
                    }
                })
            }
        }
    }
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
            width: 20%
            text-align: left
            margin-top: 1rem
            .material-symbols-outlined
                font-size: 36px
                
        .infocenter
            width: 65%
            text-align: center
            margin-top: 12px
            font-size: 24px
            font-weight: bold
            justify-content: center
    .frequency
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        background-color: #FEEABC
        .flex
            display: flex
            flex-wrap: wrap
            justify-content: space-between
            align-items: center
            .title
                font-size: 18px
                background-color: #FFFFFF
                border-radius: 15px 15px 15px 15px
                width:90px
                height: 30px
                margin-top: 5px
                margin-bottom: 5px
                justify-content: center
                border-bottom: solid
                margin-left: 120px
            .submit
                width: 35%
                background-color: #FFFFFF
                border-radius: 15px 15px 15px 15px
                border-bottom: solid
            .question
                width: 100%    
                .pet
                    width: 100%
                    height: 50px
                    display: flex
                    background-color: #FFFFFF
                    align-items: center
                    border-top: solid
                    border-block-color: #000
                    justify-content: center

                    .p_title1
                        width: 100%
                        font-size: 18px
                        text-align: center
                        padding-left: 5px
                        color: #000
                        display: flex
                        justify-content: center
                        .che
                            color: green
                        .x
                            color: red

    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
</style>
