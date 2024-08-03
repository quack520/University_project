<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            送領養回報
        </div>
        <div class="body" v-for="pet_questionrebonse in pets_questionrebonse" :key="pet_questionrebonse.id">
            <div class="input">
                <span>刊登資料</span>
                <p>{{ pet_questionrebonse.list_type }}</p>
            </div>
            <div class="input">
                <span>名稱</span>
                <p>{{ pet_questionrebonse.pet_name }}</p>
            </div>
            <div class="input">
                <span>種類</span>
                <p>{{ pet_questionrebonse.pet_type }}</p>
            </div>
            <div class="input">
                <span>品種</span>
                <p>{{ pet_questionrebonse.variety }}</p>
            </div>
            <div class="input">
                <span>年齡</span>
                <p>{{pet_questionrebonse.age}}</p>
            </div>
            <div class="input">
                <span>結紮狀況</span>
                <p>{{pet_questionrebonse.ligation}}</p>
            </div>
            <div class="input">
                <span>近期照片</span>
                <img  class="img" 
                    :src="'/api/img/' + pet_questionrebonse.rebonse_photo "/>
            </div>
            <div class="btn">
                <router-link to="/reviewquestion">
                    <q-btn class="check_btn" label="資料問題回報" @click="question_rebonse(pet_questionrebonse.pet_num,pet_questionrebonse.rebonse_times)"></q-btn>
                </router-link>
                <q-btn class="check_btn" label="確認無誤" @click="submit"></q-btn>
            </div>
        </div>
    </div>
    <div v-if="isModalOpen" class="modal">
        <div class="modal-content">
            <span class="close" @click="closeModal">&times;</span>
            <div class="modal_title">確認成功</div>
            <div class="modal_body">
                本平台已成功<br>
                收到您的回報
            </div>
            <span class="material-symbols-outlined">task_alt</span>
            <router-link to="/home">
                <q-btn class="modalconfirm_btn" label="確定" @click="confirm"></q-btn>
            </router-link>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>


<script>
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'resetpasswordPage',
        components:{
            HeaderHome,
            DockHome
        },
        data(){
            return{
                pets_questionrebonse:[],
                rebonse_times:'',
                msg:'',
                state: false,
                pet_num:this.$route.query.pet_num,
                isModalOpen: false,
            }
        },
        created() {
            this.fetchData();
        },
        methods:{
            async fetchData(){
                try{
                    const res = await axios.get('/api/php/reviewget.php', {
                        params: {
                            pet_num: this.$route.query.pet_num,
                            rebonse_times:this.$route.query.rebonse_times
                        }
                    });
                    this.pets_questionrebonse = res.data;
                    for (const pet_questionrebonse of res.data) {
                        this.rebonse_times = pet_questionrebonse.rebonse_times;
                    }
                }catch (error) {
                    console.error(error);
                }
            },
            question_rebonse(num,times){
                this.$router.push({
                    path: '/reviewquestion',
                    query: {
                        pet_num: num,
                        rebonse_times:times
                    }
                })
            },
            
            async submit(){
                this.isModalOpen = true;
                try{
                    const res = await axios.get('/api/php/review.php', {
                        params: {
                            pet_num: this.pet_num,
                            rebonse_times: this.rebonse_times
                        }
                    })
                    this.msg = res.data.msg;
                    this.state = res.data.ok;
                    console.log(this.msg);
                    console.log(this.state);
                }catch (error) {
                        console.error(error);
                }     
                           
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
    .all
        padding: 0 0 3em 0
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
            height: 100%
            text-align: center
            background-color: #FEEABC
            .input
                display: flex
                font-size: 18px
                align-items: center
                border-bottom-style: solid
                border-color: #FFFFFF
                .rdobutton_radio
                    width: 20px
                    height: 20px
                & > span
                    width: 35%
                    height: 10%
                    display: flex
                    justify-content: left  
                    align-items: center
                    text-align: left
                    padding-left: 20px
                    font-size: 20px

                    letter-spacing: 2px
                & > p
                    width: 65%
                    display: flex
                    text-align: justify
                    padding-top: 10px
                    padding-left: 10px 
                    font-size: 18px


                    .image-upload
                    display: flex
                    width: 80%
                    display: flex
                    text-align: justify
                .img
                        max-width: 200px
                        max-height: 200px
                .custom-file-input
                    position: relative
                    display: inline-block
                    
                    input[type="file"]
                        position: absolute
                        top: 0
                        left: 0
                        opacity: 0
                        width: 100%
                        height: 100%
                        cursor: pointer
                        margin-bottom: -50px
                    img
                        width: 100px
                        height: 100px
                        cursor: pointer
            .btn
                display: flex
                
                .check_btn
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



