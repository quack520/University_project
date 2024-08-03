<template>
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter" v-for="chatroom in chatrooms" :key="chatroom.id">
            <span v-if="!chatroom.chatroom_photo" class="material-symbols-outlined">account_circle</span>
            <img v-if="chatroom.chatroom_photo" class="img" 
                :src="'/api/img/' + chatroom.chatroom_photo "/>
            <!-- bigname() -->
            {{ chatroom.chatroom_name }} 
        </div>
    </div>
    <div class="messagetop">
        <div class="q-pa-md row justify-center">
            <div style="width: 100%; max-width: 400px">
                <div v-for="item in chatroom_messages" :key="item.id">
                <q-chat-message
                    :text="[item.message]"
                    :sent="item.user_ID === user_ID"
                ></q-chat-message>
                </div>
            </div>
        </div>
    </div>
    <div class="messagebottom">
        <div class="q-pa-md row justify-center">
            <input class="left" type="text" v-model="send_message.text" placeholder="輸入訊息">
            <span class="material-symbols-outlined" @click="sendMessage">send</span>
        </div>
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</template>

<script>
    //呱
    import { initializeApp } from "firebase/app";
    import { getDatabase, ref, onValue, push } from "firebase/database";
    import axios from 'axios';
    export default {
        name:'MessagePage',
        data() {
            return {
                send_message: {
                    user_ID: '',
                    text: '',
                },
                chatrooms: [],
                inputmsg: '',
                animate: false,
                chatroom_messages: '',
                user_ID: '',
                chatroom_ID: '',

            };
        },
        mounted() {
            this.user_ID = localStorage.getItem('token')
            const me_num = this.$route.query.me_num;

            const firebaseConfig = {
                apiKey: "AIzaSyCj-j9s1ntgdMXVjVmpzx8ipegFC0HicG4",
                authDomain: "aarsmessage-cf488.firebaseapp.com",
                databaseURL: "https://aarsmessage-cf488-default-rtdb.firebaseio.com",
                projectId: "aarsmessage-cf488",
                storageBucket: "aarsmessage-cf488.appspot.com",
                messagingSenderId: "740873975961",
                appId: "1:740873975961:web:7eeaf74811f026f2dba008",
                measurementId: "G-BG1CGWRCW3"
            };
            // 初始化 Firebase
            const app = initializeApp(firebaseConfig);
            // 獲得資料庫的引用
            const db = getDatabase(app);
            //抓到chatroom資料表
            const chatroom_ID = this.$route.query.chatroom_ID
            this.msgRef = ref(db, `chatroom/chatroom_ID/${chatroom_ID}`);

            //監聽資料變化
            onValue(this.msgRef, (snapshot) => {
                const data = snapshot.val();
                this.chatroom_messages = data
            });
            
            console.log("me_num:", me_num);
            console.log("chatroom_ID:", chatroom_ID);

            this.bigname();
            // //寫入資料庫的
            // const dataToWrite = {
            //     user_ID: localStorage.getItem('token'),
            //     message: '你好聊天室4'
            // };
            // const newChildRef = push(this.msgRef, dataToWrite);
            // console.log('新節點的唯一ID:', newChildRef.key)
        },
        methods: {
            bigname() {
                axios.get('/api/php/bigname.php', {
                    params: {
                        me_num: this.$route.query.me_num,
                        chatroom_ID: this.$route.query.chatroom_ID,
                    }
                })
                .then(res => {
                    const chatroom = res.data.find(room => room.chatroom_ID === this.$route.query.chatroom_ID);
                    if (chatroom) {
                        this.chatrooms = [chatroom];
                    }
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            back()
            { 
                // this.$router.go(-1)
                if(this.$route.query.me_num) {
                    this.$router.push({
                        path: '/messagelist',
                        query: { 
                            me_num: this.$route.query.me_num 
                        }
                    });
                } else {
                    this.$router.go(-1);
                }
            },
            sendMessage() {
                if (this.send_message.text.trim() === ''){
                    //如果訊息框為空，什麼都不做
                    return
                } else{
                    const dataToWrite = {
                        user_ID: this.user_ID,
                        message: this.send_message.text
                    };
                    //寫入firebase
                    const newChildRef = push(this.msgRef, dataToWrite);
                    console.log('新節點的唯一ID:', newChildRef.key)

                    this.send_message.text = ''
                }
            },
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
            width: 20%
            text-align: left
            margin-top: 1rem
            .material-symbols-outlined
                font-size: 36px
        .infocenter
            width: 60%
            text-align: center
            margin-top: 9px
            font-size: 30px
            font-weight: bold
            display: flex
            align-items: flex-start
            justify-content: center
            .material-symbols-outlined
                font-size: 50px
            .img
                width: 50px
    .messagetop
        background-color: #FFF
        height:80%
        width: 100%
        position: fixed
        overflow: auto
        top: 10%
        left: 0
        z-index: 1
    .messagebottom
        background-color: #FFF
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 1
        .left
            width: 90%
            height: 40px
        .material-symbols-outlined
            width: 10%
            font-size: 36px
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
</style>
