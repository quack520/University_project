<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="secondhandinfo">
        <div class="SHIbottom" v-for="good in goods" :key="good.id">
            <div class="imgs">
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
                            <q-carousel-slide name="pc1" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + good.good_photo1 " 
                                        />
                                    
                                </div>
                            </q-carousel-slide>
                            <q-carousel-slide name="pc2" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + good.good_photo2 " 
                                        />
                                    
                                </div>
                            </q-carousel-slide>
                            <q-carousel-slide name="pc3" class="column no-wrap flex-center">
                                
                                <div class="q-mt-md text-center">
                                    <img class="img" 
                                        :src="'/api/img/' + good.good_photo3 " 
                                        />
                                    
                                </div>
                            </q-carousel-slide>
                        </q-carousel>
                    </div>
                </div>
            </div>
            <hr>
            <div class="flex">
                <div class="Alltitle2"></div>
                <div class="Alltitle">{{ good.good_name }}</div>
                <q-btn class="buy_btn" v-if="!showmessage" label="申請購買" @click="buy"></q-btn>
                <q-btn class="buy_btn" v-if="showmessage" label="審核申請" @click="apply"></q-btn>
            </div>
            <hr>
            <div class="transport">
                <div class="info">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <p class="data">貨運</p>
                </div>
                <div class="info">
                    <span class="material-symbols-outlined">handshake</span>
                    <p class="data">面交</p>
                </div>
                <div class="info">
                    <span class="material-symbols-outlined">pin_drop</span>
                    <p class="data">{{ good.good_area }}</p>
                </div>
            </div>
            <hr>
            <div class="commodity">
                <div class="title">商品數量 </div><div class="data">{{ good.good_amount }}</div>
            </div>
            <div class="commodity">
                <div class="title">點數<span class="material-symbols-outlined">savings</span> </div><div class="data">{{ good.good_point }}</div>
            </div>
            <div class="commodity">
                <div class="title">商品種類 </div><div class="data"></div>{{ good.good_type }}
            </div>
            <div class="commodity">
                <div class="title">商品產地 </div><div class="data">{{ good.good_place }}</div>
            </div>
            <hr>
            <div class="commodity">
                <div class="title">商品資訊</div>
                <div class="data">{{ good.good_detail }}</div>
            </div>
            <hr>
            <div class="commodity">
                <div class="title">交貨運送</div>
                <div class="data">7-11運費$60/全家$60/萊爾富50</div>
            </div>
            <hr>
            <div class="Publisher">
                <div class="title">刊登者資訊</div>
                <div class="bottom">
                    <div class="bottominfo"><span class="material-symbols-outlined">account_circle</span></div>
                    <div class="bottominfo"><p class="data">{{ good.mname }}</p></div>
                    <div class="bottominfo"></div>
                </div>
            </div>
            <hr>
            <div class="Publisher">
                <div class="bottom">
                    <div class="bottominfo"><span class="material-symbols-outlined">call</span></div>
                    <div class="bottominfo"><p class="data">{{ good.phone }}</p></div>
                    <div class="bottominfo" v-if="!showmessage" @click="msg(goods[0].me_num)"><span class="material-symbols-outlined">forum</span></div>
                </div>
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
                        <div class="modaldata">{{pet_apply.me_name}}</div>
                        <div class="modaldata">{{ pet_apply.apply_date }}</div>
                        <q-btn class="modalconfirm_btn" label="確定" @click="confirm(pet_apply.me_num)"></q-btn>
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
        <div v-if="isModalOpen3" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal3">&times;</span>
                <div class="modal_title1">點數不足</div>
                <div class="modal_body1">
                    您的申請人擁有的點數餘額不足
                </div>
                <span class="material-symbols-outlined">task_alt</span>
                <q-btn class="modalconfirm_btn1" label="確定" @click="closeModal3" ></q-btn>
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
        name:'SecondhandinfoPage',
        components:{
            HeaderHome,
            DockHome
        },
        data() {
                return {
                    goods: [],
                    pets_apply:[],
                    showmessage: false,
                    isModalOpen3:false,
                    isModalOpen2:false,
                    isModalOpen1:false,
                    isModalOpen:false,
                    err:'',
                    state:false
                };
        },
        setup () {
            return {
                slide: ref('pc1'),
            }
        },
        watch: {
            //檢查 pets 的變化，并根據需求更新 showmessage
            goods: {
            handler(newVal) {
                const loginnum = localStorage.getItem('token');
                this.showmessage = newVal.some(good => good.me_num == loginnum);
            },
            immediate: true  // 有變化就更新
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
            closeModal3() {
                this.isModalOpen3 = false; // 關閉彈跳視窗
            },
            closeModal() {
                this.isModalOpen = false; // 關閉彈跳視窗
            },
            buy(){
                this.isModalOpen1 = true; // 打開彈跳視窗
                axios.get('/api/php/buysecond.php', {
                    params: {
                        good_num: this.$route.query.good_num,
                        me_num:localStorage.getItem('token')
                    }
                })
                .then(res => {
                    this.err = res.data.msg;
                    this.state = res.data.ok;
                    console.log(this.msg);
                    console.log(this.state);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            apply(){
                this.isModalOpen = true; // 打開彈跳視窗
                axios.get('/api/php/applysecondget.php', {
                    params: {
                        good_num: this.$route.query.good_num
                    }
                })
                .then(res => {
                    this.pets_apply = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            confirm(me_num){
                this.isModalOpen = false; // 關閉彈跳視窗
                axios.get('/api/php/secondapplycheck.php', {
                    params: {
                        good_num: this.$route.query.good_num,
                        check_num:localStorage.getItem('token'),
                        me_num:me_num
                    }
                })
                .then(res => {
                    this.pets_apply = res.data;
                    this.state = res.data.ok;
                    if(this.state == true)
                    {
                        this.isModalOpen2 = true; // 如果確認成功打開彈跳視窗
                    }else{
                        this.isModalOpen3 = true; //如果確認申請人點數不足打開此彈跳視窗
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            },
            fetchData() {
                axios.get('/api/php/secondhandinfo.php', {
                    params: {
                        good_num: this.$route.query.good_num
                    }
                })
                .then(res => {
                    this.goods = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
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
    .secondhandinfo
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: scroll
        z-index: 1
        .SHIbottom
            width: 100%
            .flex
                display: flex
                justify-content: space-around
                .Alltitle
                    font-size: 1.3rem
                    font-weight: bold
                    width: 33%
                    padding-top: 5px
                .Alltitle2
                    width: 20%
                .buy_btn
                    line-height: 1.9rem
                    border-radius: 0.4rem
                    text-align: center
                    font-size: 16px
                    font-weight: bold
                    color: #000
                    cursor: pointer
                    background: #FDFFA6
                    width: 100px
            .transport
                display: flex
                justify-content: center

                .info
                    width: 33%
                    text-align: center
                    font-weight: bold
                    display: flex
                    
                    .material-symbols-outlined
                        font-size: 36px
                        padding: 10px
                    .data
                        font-size: 18px
                        padding-top: 35px

            .commodity
                display: flex
                font-size: 18px
                padding: 5px
                .title
                    font-weight: bold
                    width: 30%
                    text-align: left
                    
                    .data
                        width:70%
                        padding: 0px 0px 0px 40px
            .Publisher
                display: block
                .title
                    text-align: left
                    font-weight: bold
                    font-size: 18px
                .bottom
                    display: flex
                    .bottominfo
                        width:33%
                        font-size: 18px
                        
                        .data
                            padding-top: 10px
                        .material-symbols-outlined
                            font-size: 36px
                            padding: 10px
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
