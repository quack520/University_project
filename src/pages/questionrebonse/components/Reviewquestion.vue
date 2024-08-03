<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            資料問題回報
        </div>
        <div class="body" >
            <div v-for="member in members" :key="member.id">
                <div class="table">
                    <div class="t-left">
                        <p>姓名</p>
                    </div>
                    <div class="t-rig">
                        <p>{{ member.mname }}</p>
                    </div>
                </div>
                <div class="table">
                    <div class="t-left">
                        <p>Email</p>
                    </div>
                    <div class="t-rig">
                        <p>{{ member.email }}</p>
                    </div>
                </div>
                <div class="table">
                    <div class="t-left">
                        <p>手機</p>
                    </div>
                    <div class="t-rig">
                        <p>{{ member.phone }}</p>
                    </div>
                </div>
            </div>
            <div class="table">
                <div class="t-left">
                    <p>主旨</p>
                </div>
                <div class="t-rig">
                    <input type="text" v-model="subject" name="subject"  placeholder="例:沒有按時回報" size="30">
                </div>
            </div>
            <div class="content">
                <textarea name="cont" v-model="info" cols="48" rows="6" placeholder="內容回饋"></textarea>
            </div>
        </div>
        <q-btn class="end" label="送出表單" @click="submit"></q-btn>
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <div class="modal_title">回報成功</div>
                <div class="modal_body">
                    本平台已收到您的問題<br>
                    我們將會盡快回覆您<br>
                    請您耐心等候!!!  謝謝
                </div>
                <span class="material-symbols-outlined">task_alt</span>
                <router-link to="/home">
                    <q-btn class="modalconfirm_btn" label="確定" @click="check"></q-btn>
                </router-link>
            </div>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  import axios from 'axios'
  export default {
    name:'ReviewquestionPage',
    components:{
        HeaderHome,
        DockHome
    },
    data(){
        return{
            isModalOpen: false,
            members :[],
            pet_num:this.$route.query.pet_num,
            rebonse_times:this.$route.query.rebonse_times,
            info:'',
            subject:'',
            state:false,
            msg:''
        }
        
    },
    created() {
            this.fetchData();
        },
    methods:{
        closeModal() {
            this.isModalOpen = false; // 關閉彈跳視窗
        },
        async fetchData() {
            try{
                const res = await axios.get('/api/php/reviewquestionget.php', {
                    params: {
                        me_num : localStorage.getItem('token')
                    }                    
                })
                
                this.members = res.data;
                
            }catch (error) {
                    console.error(error);
            }        
        }, 
        async submit(){
            this.isModalOpen = true;
            try{
                const res = await axios.get('/api/php/reviewquestion.php', {
                    params: {
                        me_num:localStorage.getItem('token'),
                        pet_num:this.pet_num,
                        mname:this.members[0].mname,
                        phone:this.members[0].phone,
                        email:this.members[0].email,
                        rebonse_times:this.rebonse_times,
                        info:this.info,
                        subject:this.subject,
                    }
                })
                this.msg = res.data.msg;
                this.state = res.data.ok;
                console.log(this.msg);
                console.log(this.state);
            }catch(error){
                console.error(error);
            }
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
        background-color: #FEEABC
        height:90%
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
            background-color: #FFFFFF
            .table
                width: 100%
                height: 2.5em
                padding: 10px 10px 0px 5px
                display: flex
                border-bottom: 1px solid
                font-size: 18px
                
                .t-left
                    width: 30%
                    display: flex
                    justify-content: left
                    align-items: center
                    padding-left: 10px
                .t-rig
                    width: 85%
                    display: flex
                    justify-content: left  
                    align-items: center

                    input::-webkit-input-placeholder
                        font-size: 18px
                    & > p
                        font-size:  18px
                        
            .content
                padding: 2em
                padding-left:10px 
        .end
            margin: 30px
            margin-top: 1rem
            width: 150px
            background-color: #FDFFA6
            border-radius: 0.4rem
            text-align: center
            font-size: 16px
            cursor: pointer
            color: #000
            font-weight: bold
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
