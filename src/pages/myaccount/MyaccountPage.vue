<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title"  v-for="member in members" :key="member.me_num">
            <div class="t-img" >
                <span v-if="!member.me_photo" class="material-symbols-outlined">account_circle</span>
                <img v-if="member.me_photo" class="img" 
                    :src="'/api/img/' + member.me_photo " 
                     />
            </div>
            <div class="t-mid-l">{{ member.mname }}</div>
            <div class="t-mid-r"><span class="material-symbols-outlined">savings</span>:{{ member.me_point }}</div>
            
            <div class="t-left">
                <q-btn class="signout_btn"  label="登出" icon-right="logout" @click="signout"></q-btn>
            </div>
        </div>
        <div class="body">
            
            <router-link to="personaldata" style="text-decoration:none">
                <div class="info">
                    <span class="material-symbols-outlined">group</span>
                    <div class="b1" @click="person(me_num)">會員資訊</div>
                </div>
            </router-link>
            <router-link to="resetpassword" style="text-decoration:none">
                <div class="info">
                    <span class="material-symbols-outlined">construction</span>
                    <div class="b1">修改密碼</div>
                </div>
            </router-link>
            <router-link to="mypost" style="text-decoration:none">
                <div class="info">
                    <span class="material-symbols-outlined">export_notes</span>
                    <div class="b1" @click="post(me_num)">我的刊登</div>
                </div>
            </router-link>
            <router-link to="addproduct" style="text-decoration:none">
                <div class="info">
                    <span class="material-symbols-outlined">add_circle</span>
                    <div class="b1">增加商品</div>
                </div>
            </router-link>
            <div class="info2">
                <div class="dropbtn" @click="showlist">
                    <span class="material-symbols-outlined">task</span>
                    <div class="b1">送領養回報系統</div>
                </div>
                <div v-if="rebonse" class="dropdown-content">
                    <router-link to="questionlist" style="text-decoration:none" @click="question(me_num)">
                        <div class="b1">填寫領養回報表單</div>
                    </router-link>
                    <router-link to="reviewlist" style="text-decoration:none" @click="review(me_num)">
                        <div class="b1">查詢領養回報表單</div>
                    </router-link>
                </div>
            </div>
            
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    //呱
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'myaccountPage',
        components:{
            HeaderHome,
            DockHome
        },
        data(){
            return{
                members:[],
                rebonse: false
            }
        },
        mounted() {
            this.me_num = this.$route.query.me_num;
            this.fetchData();
        },
        methods:{
            fetchData() {
                axios.get('/api/php/myaccount.php',{
                    params: {
                        me_num: this.$route.query.me_num,
                    }
                })
                .then(res => {
                    this.members = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            showlist(){
                this.rebonse = !this.rebonse
            },
            signout(){
                // localStorage.removeItem('token');
                // localStorage.removeItem('me_num');
                this.$router.push('/')
            },
            person(){
                this.$router.push({
                    path: '/personaldata',
                    query: {
                        me_num: this.me_num,
                    },
                })
            },
            post(){
                this.$router.push({
                    path: '/mypost',
                    query: {
                        me_num: this.me_num,
                    },
                })
            },
            question(){
                this.$router.push({
                    path: '/questionlist',
                    query: {
                        me_num: this.me_num,
                    },
                })
            },
            review(){
                this.$router.push({
                    path: '/reviewlist',
                    query: {
                        me_num: this.me_num,
                    },
                })
            }
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
    .all
        background-color: #FEEABC
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        
        

        .title
            width: 100%
            height: 15%
            display: flex
            flex-wrap: wrap
            align-content: center
            text-align: center
            border-bottom-style: solid
            color: black 
            align-items: center
            justify-content: space-around
            .t-img
                width: 28%
                height: 10vh
                color: black
                
                .material-symbols-outlined
                    width: max-content
                    font-size: 72px
                    color: black
                    text-decoration: none
                .img
                    width: 72px
                    max-height: 10vh
                    
                
            .t-mid-l
                width: 17%
                height: 10vh
                font-size: 18px
                text-align: left
                padding-top: 20px
            .t-mid-r
                width: 24%
                height: 10vh
                font-size: 18px
                text-align: left
                padding-top: 20px

            .t-left
                width: 31%
                height: 40px
                align-items: center
                display: flex
                padding-top: 30px

                .signout_btn
                    background:#FEEABC
                    color: black
                    width: 100px
                    margin: 20px 0 20px 
                    font-size: 14px
                    margin-bottom: 50px

                    
                .t-right
                    width: 80px
                    height: 40px
                    display: block
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
                    margin-top: 20px
                    margin-right: 15px
                    margin-bottom: 30px
                    margin-left: 20px
                    border: 2px
                    border-style: solid
                    background-color:#FEEABC
                    color: black
        .body
            height: 100%
            text-align: center
            background-color: #FFFFFF
            border-bottom-style: solid
            .info
                display: flex
                width: 100%
                border-bottom-style: solid
                border-color: #000
                color: black
                .material-symbols-outlined
                    width: 20%
                    font-size: 36px
                    color: black
                    text-decoration: none
                    padding-top: 10px
                    text-align: right
                    
                .b1
                    width: 80%
                    height: 60px
                    justify-content: left
                    align-items: center
                    font-size: 18px
                    padding-top: 20px
                    padding-left: 30px
                    text-align: left
                    
                    

            .dropdown
                width: 100%
                height: 60px
                position: relative
                display: inline-block
                // 下拉式選單按鈕
                
            .info2
                display: flex
                flex-direction: column
                color: black
                .material-symbols-outlined
                    width: 20%
                    font-size: 36px
                    color: black
                    text-decoration: none
                    padding-top: 10px
                    text-align: right
                    
                .b1
                    width: 80%
                    height: 60px
                    justify-content: left
                    align-items: center
                    font-size: 18px
                    padding-top: 20px
                    padding-left: 30px
                    text-align: left
                    text-decoration: none
                    
                .dropbtn
                    width: 100%
                    height: 100%
                    display: flex
                    justify-content: left 
                    align-items: left
                    font-size: 18px
                    border-bottom-style: solid
                    border-color: #dddddd
                    background-color: #FFFFFF
                    
                    
                    border: none
                    cursor: pointer
                    .material-symbols-outlined
                        width: 20%
                        font-size: 36px
                        color: black
                        text-decoration: none
                        padding-top: 10px
                        
                    
                    // 下拉式選單內容
                .dropdown-content
                    display: block
                    background-color: #F0F0F0
                    z-index: 1
                    text-decoration: none
                    align-items: center
                    
                    // 滑鼠移上下拉式選單按鈕時顯示下拉內容
                    .b1
                        width: 100%
                        height: 50px
                        justify-content: center
                        align-items: center
                        font-size: 18px
                        text-decoration: none
                        text-align: center
                        border-bottom-style: solid
                        border-bottom-color: #000
                        color: black
                        
                        
                        
            
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
