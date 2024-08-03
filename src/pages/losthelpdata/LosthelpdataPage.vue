<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            協尋資料
        </div>
        <div class="body" v-for="pet in pets" :key="pet.id">
            <div class="png">
                <div class="q-pa-md">
                    <div class="q-gutter-md">
                        <q-carousel
                            v-model="slide"
                            transition-prev="slide"
                            transition-next="slide"
                            swipeable
                            animated
                            control-color="white"
                            control-size="5px"
                            navigation
                            padding
                            arrows
                            height="200px"
                            width="500px"
                            class="bg-white shadow-1 rounded-borders"
                        >
                            <q-carousel-slide name="style" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + pet.pet_photo1 " />
                                    
                                </div>
                            </q-carousel-slide>
                            <q-carousel-slide name="pc2" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + pet.pet_photo2 " 
                                        />
                                    
                                </div>
                            </q-carousel-slide>
                            <q-carousel-slide name="pc3" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + pet.pet_photo3 " 
                                        />
                                    
                                </div>
                            </q-carousel-slide>
                        </q-carousel>
                    </div>
                </div>
            </div>
            <div>
                <div class="table">
                    <div class="t-left">品種</div>
                    <div class="t-rig">{{ pet.variety }}</div>
                </div>
                <div class="table">
                    <div class="t-left">種類</div>
                    <div class="t-rig">{{ pet.pet_type }}</div>
                </div>
                <div class="table">
                    <div class="t-left">年齡</div>
                    <div class="t-rig">{{ pet.age }}</div>
                </div>
                <div class="table">
                    <div class="t-left">性別</div>
                    <div class="t-rig">{{ pet.pet_sex }}</div>
                </div>
                <div class="table">
                    <div class="t-left">體型</div>
                    <div class="t-rig">{{ pet.pet_size }}</div>
                </div>
                <div class="table">
                    <div class="t-left">毛色</div>
                    <div class="t-rig">{{ pet.color }}</div>
                </div>
                <div class="table">
                    <div class="t-left">結紮</div>
                    <div class="t-rig">{{ pet.ligation }}</div>
                </div>
                <div class="table">
                    <div class="t-left">走失地區</div>
                    <div class="t-rig">{{ pet.pet_area }}</div>
                </div>
                <div class="table">
                    <div class="t-left">刊登日期</div>
                    <div class="t-rig">{{ pet.pub_time }}</div>
                </div>
                <div class="table_add">
                    <div class="t-left_add">協尋說明</div>
                    <div class="t-rig_add">{{ pet.pet_detail }}</div>
                </div>
                <div class="table">
                    <div class="t-left">聯絡人</div>
                    <div class="t-rig">{{ pet.mname }}</div>
                </div>
                <div class="table">
                    <div class="t-left">email</div>
                    <div class="t-rig">{{ pet.email }}</div>
                </div>
                <div class="table">
                    <div class="t-left">聯絡人電話</div>
                    <div class="t-rig">{{ pet.phone }}</div>
                </div>
            </div>
        </div>
        <div class="end" v-if="!showmessage" @click="msg(pets[0].me_num)">
            私訊我
            <span class="material-symbols-outlined">forum</span>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>


<script>
    //呱
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios';
    import { ref } from 'vue'
    export default {
        name:'LosthelpdataPage',
        components:{
            HeaderHome,
            DockHome
        },
        setup () {
            return {
                slide: ref('style'),
            }
        },
        data() {
            return {
                pets: [],
                showmessage: false,
            };
        },
        watch: {
            //查看 pets 的變化，根據需求更新 showmessage
            pets: {
            handler(newVal) {
                const loginnum = localStorage.getItem('token');
                this.showmessage = newVal.some(pet => pet.me_num == loginnum);
            },
            immediate: true  // 若有變化就更新
            }
        },
        mounted() {
            this.fetchData()
            this.me_num = this.$route.query.me_num;
        },
        methods: {
            fetchData() {
                axios.get('/api/php/losthelpdata.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }
                })
                .then(res => {
                    this.pets = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            //查詢是否有聊天紀錄
            msg(me_num){
                axios.get('/api/php/chatroom.php',{
                    params: {
                        chatroom_userID1 : localStorage.getItem('token'),
                        chatroom_userID2 : me_num
                    }
                })
                .then(res => {
                    this.$router.push({
                        path: '/message',
                        query: {
                            me_num: localStorage.getItem('token'),
                            chatroom_ID: res.data.chatroom_ID
                        }
                    })

                })
            },
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
        z-index: 999
    .all
        padding: 0 0 3em 0
        margin: 0
        background-color: #FEEABC
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: auto
        z-index: 1
        .title
            height: 50px
            background-color: #FEEABC
            border-bottom-style: solid
            font-size: 30px
            font-weight: bold
            
            justify-content: center 
        .body
            .png
                widows: 200px
                height: 100%
                .img
                    max-width: 100%
                    max-height: 100%
                    height: auto
                    width: auto
                    object-fit: cover
            .table
                widows: 100vw
                height: 2em
                display: flex
                border-top: 1px solid
                border-bottom: 1px solid
                font-size: 2em
                
                .t-left
                    width: 35%
                    display: flex
                    justify-content: center  
                    align-items: center
                    border-right: 1px solid
                    
                    font-size: 20px
                .t-rig
                    width: 65%
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
                    background-color: #FFFFFF
            .table_add
                widows: 100vw
                height: 60px
                display: flex
                border-top: 1px solid
                border-bottom: 1px solid
                font-size: 2em
                
                .t-left_add
                    width: 35%
                    display: flex
                    justify-content: center  
                    align-items: center
                    border-right: 1px solid
                    
                    font-size: 20px
                .t-rig_add
                    width: 65%
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
                    background-color: #FFFFFF
        .end
            margin: 0 auto
            margin-top: 1rem
            width: 30%
            line-height: 2.5rem
            background-color: #FDFFA6
            border-radius: 0.4rem
            text-align: center
            font-size: 18px
            font-weight: bo
            
            border: 1px solid
            cursor: pointer
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>


