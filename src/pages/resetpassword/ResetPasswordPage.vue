<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="resetpassword">
        <div class="title">修改密碼</div>
        <hr>
        <div class="bottom">
            <table class="table">
                <tr>
                    <td><p class="infotitle">輸入舊密碼</p></td><td><q-input class="password" color="yellow" v-model="password_old"></q-input></td>
                </tr>
                <tr>
                    <td><p class="infotitle">輸入新密碼</p></td><td><q-input class="password" color="yellow" v-model="password_new"></q-input></td>
                </tr>
                <tr>
                    <td><p class="infotitle">確認新密碼</p></td><td><q-input class="password" color="yellow" v-model="password_check"></q-input></td>
                </tr>
            </table>
            
            <q-btn class="confirm_btn" label="確認送出" @click="confirm"></q-btn>
            
        </div>
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <div class="modal_title">修改成功</div>
                <div class="modal_body">
                    本平台已成功<br>
                    更改您的密碼
                </div>
                <span class="material-symbols-outlined">task_alt</span>
                <router-link to="/home">
                    <q-btn class="modalconfirm_btn" label="確定" @click="confirm"></q-btn>
                </router-link>
            </div>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>


<script>
    //呱+湯
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'ResetPasswordPage',
        components:{
            HeaderHome,
            DockHome
        },
        data() {
            return {
                ResetPasswordPage: true,
                password_old: '',
                password_new: '',
                password_check: '',
                msg: '',
                state: false,
                dataURL: null,
                track: null,
                alert: false,
                isModalOpen: false,
            }
        },
        methods:{
            async confirm(){
                if(this.password_new == this.password_check){
                    console.log('resetpassword')
                    await axios.get(`/api/php/resetpassword.php?password_num=${localStorage.getItem('token')}`,{
                            params: {
                                password_old: this.password_old,
                                password_new: this.password_new,
                                password_check: this.password_check,
                                password_num: this.password_num,
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
                    console.log(this.password_new)
                    this.ResetPasswordPage = false
                }
                this.isModalOpen = true;
            },
            click_alert()
            {
                this.$router.push('/myaccount')
            },
            closeModal() {
                this.isModalOpen = false; // 關閉彈跳視窗
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
    .resetpassword
        height:80%
        background-color:#FEEABC
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        .title
            font-size: 30px
            font-weight: bold
            padding-top: 10px
        .bottom

            width: 90%
            height:0
            top:0
            left:0
            border-radius: 30px 30px 30px 30px
            background-color: #FFFFFF
            padding: 40px 30px 280px 20px
            margin: 20px
            overflow: hidden
            .table
                text-align: center
                .infotitle
                    text-align: center
                    font-size: 18px
                .password
                    text-align: center
            .confirm_btn
                margin: 0 auto
                margin-top: 1rem
                line-height: 2.5rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                font-size: 1rem
                font-weight: bold
                color: #000
                cursor: pointer
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
                height: 20%
                overflow: auto
            .material-symbols-outlined
                font-size: 36px
                color: green
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
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
