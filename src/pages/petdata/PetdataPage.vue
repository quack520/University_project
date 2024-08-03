<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title"> 
            寵物資料
        </div>
        <div class="body">
            <div class="png" v-for="pet in pets" :key="pet.id">
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
                            width="100%"
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
            <div v-for="pet in pets" :key="pet.id">
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
                    <div class="t-left">地區</div>
                    <div class="t-rig">{{ pet.pet_area }}</div>
                </div>
                <div class="table">
                    <div class="t-left">刊登日期</div>
                    <div class="t-rig">{{ pet.pub_time }}</div>
                </div>
                <div class="table_add">
                    <div class="t-left_add">詳細說明</div>
                    <div class="t-rig_add">{{ pet.pet_detail }}</div>
                </div>
                <div class="table">
                    <div class="t-left">認養條件</div>
                    <div class="t-rig">需後續追蹤<br>須簽愛心切結書</div>
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
        <div class="end-flex">
            <div class="end" v-if="!showmessage" @click="msg(pets[0].me_num)">
                私訊我
                <span class="material-symbols-outlined">forum</span>
            </div>
            <div class="end" v-if="!showmessage" @click="adopt(pets[0].me_num)">
                申請領養
            </div>
            <div class="end" v-if="showmessage" @click="apply(pets[0].me_num)">
                確認申請領養人
            </div>
        </div>
        <div v-if="isModalOpen1" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal1">&times;</span>
                <div class="modal_title1">申請成功</div>
                <div class="modal_body1">
                    本平台已收到您的申請
                </div>
                <span class="material-symbols-outlined">task_alt</span>
                <router-link to="/home">
                    <q-btn class="modalconfirm_btn1" label="確定" ></q-btn>
                </router-link>
            </div>
        </div>
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <div class="modal_title">申請人</div>
                <div class="modal_body">
                    <div class="list"  >
                        <div class="modaltitle">名稱</div>
                        <div class="modaltitle">申請日期</div>
                    </div>
                    <div class="list" v-for="pet_apply in pets_apply" :key="pet_apply.id" >
                        <div class="modaldata">{{pet_apply.apply_name}}</div>
                        <div class="modaldata">{{ pet_apply.date }}</div>
                        <q-btn class="modalconfirm_btn" label="確定" @click="confirm(pet_apply.pet_num,pet_apply.apply_num)"></q-btn>
                    </div>
                </div>        
            </div>
        </div>
        <div v-if="isModalOpen2" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal2">&times;</span>
                <div class="modal_title1">確認成功</div>
                <div class="modal_body1">
                    您已確認申請人
                </div>
                <span class="material-symbols-outlined">task_alt</span>
                <router-link to="/home">
                    <q-btn class="modalconfirm_btn1" label="確定" ></q-btn>
                </router-link>
            </div>
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
        name:'PetdataPage',
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
                pets_apply:[],
                pets: [],
                rebonse_num:'',
                isModalOpen: false,
                isModalOpen1: false,
                isModalOpen2: false,
                err:'',
                state: false,
                showmessage: false,
            };
        },
        watch: {
            // 查看 pets 的變化，并根據需求更新 showmessage
            pets: {
            handler(newVal) {
                const loginnum = localStorage.getItem('token');
                this.showmessage = newVal.some(pet => pet.me_num == loginnum);
            },
            immediate: true  // 若有變化就更新
            }
        },
        mounted() {
            //為了進php找資料用的
            this.fetchData()
            this.me_num = this.$route.query.me_num;
        },
        methods: {
            closeModal1() {
                this.isModalOpen1 = false; // 關閉彈跳視窗
            },
            closeModal2() {
                this.isModalOpen2 = false; // 關閉彈跳視窗
            },
            
            fetchData() {
                axios.get('/api/php/petdata.php', {
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
            adopt() {
                this.isModalOpen1 = true; // 打開彈跳視窗
                axios.get('/api/php/petapply.php',{
                    params: {
                        apply_num:localStorage.getItem('token'),
                        pet_num: this.$route.query.pet_num
                    },
                })
                .then(res => {
                    console.log(res.data)
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            apply(){
                this.isModalOpen = true; // 打開彈跳視窗
                axios.get('/api/php/petapplyget.php',{
                    params: {
                        pet_num: this.$route.query.pet_num
                    }
                })
                .then(res => {
                    this.pets_apply = res.data;
                    this.rebonse_num = res.data;
                    console.log(this.rebonse_num);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            confirm(pet_num,apply_num){
                this.isModalOpen2 = true; // 打開彈跳視窗
                this.isModalOpen = false; // 關閉彈跳視窗
                axios.get('/api/php/applycheck.php',{
                    params:{
                        pet_num : pet_num ,
                        apply_num : apply_num
                    }
                })
                .then(res => {
                    console.log(res.data)
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                
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
            width: 100%
            .png
                width: 100%
                height: 230px
                .img
                    width: 100%
                    height: 230px
                    // max-width: 100%
                    // max-height: 100%
                    // height: auto
                    // width: auto
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
        .end-flex
            display: flex
            .end
                margin: 0 auto
                margin-top: 1rem
                width: 40%
                line-height: 2.5rem
                background-color: #FDFFA6
                border-radius: 0.4rem
                text-align: center
                font-size: 18px
                font-weight: bo
                border: 1px solid
                cursor: pointer

        .modal 
            display: flex
            position: fixed
            align-items: center
            top: 0
            left: 0
            width: 100%
            height: 100%
            background-color: rgba(0, 0, 0, 0.7)
                /* 半透明黑色背景 */
            z-index: 9999 
            /*設定層級，使彈跳視窗浮在內容之上 */
            

            /* 彈跳視窗內容 */
            .modal-content 
                position: absolute
                top: 50%
                left: 50%
                transform: translate(-50%, -50%)
                background-color: #fff
                padding: 20px
                border-radius: 10px
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)
                width: 80%
                height: 70%
                display: flex
                flex-wrap: wrap
                justify-content: center

                /* 關閉按鈕 */
                .close 
                    position: absolute
                    top: 10px
                    right: 10px
                    font-size: 20px
                    cursor: pointer
                .modal_title
                    width:100%
                    height: 10%
                    text-align: center
                    font-size: 20px
                .modal_body
                    width: 100%
                    height: 90%
                    overflow: auto
                    .list
                        display: flex
                        align-items: center
                        height: 45px
                        .modaltitle
                            width: 33%
                            font-size: 15px
                        .modaldata
                            width: 33%
                            font-size: 15px
                            
                        .modalconfirm_btn
                            border-radius: 0.5rem
                            text-align: center
                            font-size: 15px
                            font-weight: bold
                            color: #000
                            cursor: pointer
                            background: #FDFFA6
                            width: 70px
                            height: 20px
                .modal_title1
                    width:100%
                    height: 30%
                    text-align: center
                    font-size: 20px
                .modal_body1
                    width: 100%
                    height: 30%
                    overflow: auto
                    font-size: 20px
                .material-symbols-outlined
                    font-size: 36px
                    color: green
                    width:100%
                .modalconfirm_btn1
                    border-radius: 0.5rem
                    text-align: center
                    font-size: 15px
                    font-weight: bold
                    color: #000
                    cursor: pointer
                    background: #FDFFA6
                    width: 70px
                    height: 20px
                    
    
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>





