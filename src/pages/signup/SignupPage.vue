<template>
    <div class="signup">
        <div class="signup_bottom">
            <p class="signup_title">會員註冊</p>
            <q-input class="mname" color="yellow" v-model="mname" placeholder="姓名" type="name">
                <template v-slot:prepend>
                    <!--<q-icon name="account_circle" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="identity_card" color="yellow" v-model="identity_card" placeholder="身分證" type="identity_card">
                <template v-slot:prepend>
                    <!--<q-icon name="account_circle" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="phone" color="yellow" v-model="phone" placeholder="手機" type="phone">
                <template v-slot:prepend>
                    <!--<q-icon name="account_circle" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="email" color="yellow" v-model="email" placeholder="email" type="email">
                <template v-slot:prepend>
                    <!--<q-icon name="account_circle" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="account" color="yellow" v-model="account" placeholder="帳號" type="account">
                <template v-slot:prepend>
                    <!--<q-icon name="account_circle" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="password" color="yellow" v-model="password" placeholder="密碼" type="password">
                <template v-slot:prepend>
                    <!--<q-icon name="lock" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <q-input class="password" color="yellow" v-model="password_check" placeholder="再次輸入密碼" type="password">
                <template v-slot:prepend>
                    <!--<q-icon name="lock" style="color:#FFBD09;font-size:0.8rem;"></q-icon>-->
                </template>
            </q-input>
            <!-- <router-link to="/home">  -->
                <div class="signup_btn" @click="signup">立即註冊</div>
            <!-- </router-link>  -->
            <router-link to="/">
                <div class="login_btn" >登入</div>
            </router-link>
            <div class="msg">當您使用 AARS 會員功能、登入、註冊時
    即代表您同意會員權益及隱私權政策</div>
        </div>
    </div>
    <personal-data :PersonalDataPage="PersonalDataPage" :account="account"></personal-data>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</template>

<script>
    //呱+湯
    import axios from 'axios'
    export default {
        name:'SignupPage',
        data () {
            return {
                SignupPage: true,
                mname:'',
                identity_card:'',
                phone:'',
                email:'',
                account: '',
                password: '',
                password_check:'',
                msg:'',
                state: false,
                dataURL: null,
                track: null,
                alert: false
            }
        },
        methods:{
            async signup(){
                if(this.password == this.password_check){
                    console.log('signup')
                    await axios.get(`/api/php/signup.php`,{
                        params: {
                            mname: this.mname,
                            identity_card: this.identity_card,
                            phone: this.phone,
                            email: this.email,
                            account: this.account,
                            password: this.password,
                            password_check: this.password_check,
                        }
                    })
                .then(res => {
                    console.log(res.data)
                    this.msg = res.data.msg
                    this.state = res.data.ok
                })
                }else{
                    this.msg="請輸入相同的密碼"
                }
                if(this.state==true){
                    console.log(this.account)
                    this.SignupPage = false
                    this.PersonalDataPage = true
                    this.$router.push('/')
                }   
            },
            // click_alert()
            // {
            //     this.$router.push('/login')
            // },
        }
    }
</script>

<style lang="sass" scoped>
    .signup
        .signup_bottom
            border-radius: 0 0 0 0
            background-color: #FFFFFF
            padding: 0px 30px 480px 20px
            margin-top: 20px
            overflow: scroll
            .signup_btn
                margin: 0.5rem auto
                width: 100%
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                margin-top:50px 
                font-size: 0.75rem
                font-weight: bold
                color: #000
                cursor: pointer
            .login_btn
                margin: 0.5rem auto
                width: 100%
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                margin-top:20px 
                font-size: 0.75rem
                font-weight: bold
                color: #000
                cursor: pointer
            .msg
                font-weight: bold
                color: red
                text-align: center
                margin-top: 2.4rem
</style>
