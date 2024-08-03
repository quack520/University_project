<template>
    <meta charset="UTF-8">
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter">
            <!-- <span class="material-symbols-outlined" >chat</span>訊息 -->
            <span class="material-symbols-outlined">chat</span>訊息
        </div>
    </div>
        <div class="message">
            <div class="body" v-for="chatroom in chatrooms" :key="chatroom.id">
                    <div class="text" @click="messagepage(me_num, chatroom.chatroom_ID)">
                        <div class="lef">
                            <span v-if="!chatroom.chatroom_photo" class="material-symbols-outlined">account_circle</span>
                            <img v-if="chatroom.chatroom_photo" class="img" 
                                :src="'/api/img/' + chatroom.chatroom_photo " 
                                />
                        </div>
                        <div class="mid">
                            <!-- messagelist -->
                            {{ chatroom.chatroom_name }}
                        </div>
                        <div class="rig">
                            <!-- <div class="midbottom">{{ chatroom.chatroom_message }}</div> -->
                            <p class="data">{{ chatroom.chatroom_message }}</p>
                        </div>
                        <!-- <div class="rig">1</div> -->
                    </div>
                <!-- </router-link> -->
            </div>
        </div>
    <div class="dock"><DockHome></DockHome></div>
</template>


<script>
    //呱
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios';
    export default {
        name: 'MessagelistPage',
        data() {
            return {
                chatrooms: []
            };
        },
        components: {
            DockHome
        },
        mounted() {
            this.me_num = localStorage.getItem('token');
            this.fetchData();
            this.printMeNum();
        },
        methods: {
            back()
            { 
                this.$router.push({
                    path: '/home',
                });
            },
            //fetchData是為了進php抓資料
            fetchData() {
                axios.get('/api/php/messagelist.php', {
                    params: {
                        me_num: this.$route.query.me_num,
                    }
                })
                .then(res => {
                    //this指的是data的變數
                    this.chatrooms = res.data;
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            messagepage(me_num, chatroom_ID)
            {
                this.$router.push({
                    path: '/message',
                    query: {
                        me_num: me_num,
                        chatroom_ID: chatroom_ID
                    },
                });
                console.log(me_num,chatroom_ID)
            },
            printMeNum() {
                console.log('me_num:', this.me_num);
            },
        },
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
            font-weight: bold
            
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

                .lef
                    width: 25vw
                    display: flex
                    justify-content: center
                    
                    .material-symbols-outlined
                        font-size: 50px
                    .img
                        width: 60px
                .mid
                    width: 50vw
                    display: block
                    align-center: left
                    font-size: 18px
                    .midtop
                        height: 50%
                        text-align: left
                    .midbottom
                        height: 50%
                        text-align: left
                .rig
                    width: 25vw
                    justify-content: center
                    align-items: center
                    font-size: 18px
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
</style>


