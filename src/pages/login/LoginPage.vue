<template>
    <div class="login">
        <div class="login_bottom">
            <p class="welcome">歡迎!</p>
            <p>請登入帳號及密碼</p>
            <q-input class="account" color="yellow" v-model="account" placeholder="帳號">
                <template v-slot:prepend>
                    <span class="material-symbols-outlined">person</span>
                </template>
            </q-input>
            <q-input class="password" color="yellow" v-model="password" placeholder="密碼" type="password">
                <template v-slot:prepend>
                    <span class="material-symbols-outlined">lock</span>
                </template>
            </q-input>
            <div class="msg">{{msg}}</div>
            <div class="login_btn" @click="login">登入</div>
            <router-link to="signup">
                <div class="sign_up" @click="sign_up">註冊</div>
            </router-link>
    
            <div class="msg">當您使用 AARS 會員功能、登入、註冊時
    即代表您同意會員權益及隱私權政策</div>
        </div>
    </div>
    <div v-if="isModalOpen" class="modal">
        <div class="modal-content">
            <span class="close" @click="closeModal">&times;</span>
            <div class="modal_title">系統偵測</div>
            <div class="modal_body">
                本平台已偵測到此帳號涉嫌違規使用<br>
                例如:送領養回報系統<br>
                導致此帳號被封鎖
            </div>
            <span class="material-symbols-outlined">warning</span>
            <router-link to="/">
                <q-btn class="modalconfirm_btn" label="確定" @click="closeModal"></q-btn>
            </router-link>
        </div>
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</template>
    
<script>
    //呱+湯
    import axios from 'axios'
    export default {
        name:'LoginPage',
        data () {
            return {
                me_num:'',
                account:'',
                password:'',
                msg:'',
                state: false,
                isModalOpen: false,
            }
        },
        methods:{
            async login(){
                await axios.get('/api/php/login.php',{
                params: {
                    account: this.account,
                    password: this.password
                }
                })
                .then(res => {
                    console.log(res.data)
                    this.msg = res.data.err_msg
                    this.me_num = res.data.me_num
                    this.state = res.data.ok
                })
                if(this.state)
                { 
                    localStorage.setItem('token',this.me_num)
                    this.$router.push('/home')
                }
            },
            clear(){
                this.account = ''
                this.password = ''
            },
            closeModal() {
                this.isModalOpen = false; // 關閉彈跳視窗
            },
        }
    }
</script>

<style lang="sass" scoped>
    .login
        padding-bottom: 450px
        z-index: 1
        .login_bottom
            position: relative
            top:0
            left:0
            border-radius: 0 0 0 0
            background-color: #FFFFFF
            padding: 40px 30px 480px 20px
            overflow: hidden
            .welcome
                font-size: 1rem
                font-weight: bold
            .account
                margin-top: 0.5rem
                .material-symbols-outlined
                    font-size: 36px
                    color: black
                    text-decoration: none
            .password 
                margin-top: 0.5rem
                .material-symbols-outlined
                    font-size: 36px
                    color: black
                    text-decoration: none
            .login_btn
                margin: 0 auto
                margin-top: 1rem
                width: 100%
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                font-size: 0.75rem
                font-weight: bold
                color: #000
                cursor: pointer
            .forgot_password
                margin: 0 auto
                text-align: center
                margin-top: 0.5rem
            .sign_up
                margin: 0.5rem auto
                width: 100%
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                font-size: 0.75rem
                font-weight: bold
                color: #000
                cursor: pointer
            .msg
                font-weight: bold
                color: red
                text-align: center
                margin-top: 2.4rem
    .modal 
        display: block
        position: fixed
        top: 0
        left: 0
        width: 100%
        height: 100%
        background-color: rgba(0, 0, 0, 0.7)
        /* 半透明黑色背景 */
        z-index: 9999
        /* 設定層級，使彈跳視窗浮在內容之上 */

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
            height: 40%
            display: flex
            flex-wrap: wrap
            justify-content: center

            .close
                position: absolute
                top: 10px
                right: 10px
                font-size: 20px
                cursor: pointer
            .modal_title
                width:100%
                height: 30%
                text-align: center
                font-size: 20px
                
            .modal_body
                width: 100%
                height: 30%
                overflow: auto
            .material-symbols-outlined
                font-size: 48px
                color: red
                width: 100%
            .modalconfirm_btn
                line-height: 1.9rem
                border-radius: 0.4rem
                text-align: center
                font-size: 1rem
                font-weight: bold
                color: #000
                cursor: pointer
                background: #FDFFA6
                width: 70px      
</style>
