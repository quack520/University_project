<template>
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter">
            查詢領養回報表單
        </div>
    </div>
    <div class="returnlist">
        <div class="flex"  v-for="pet in pets" :key="pet.id">
            <div class="titleleft">名字:{{pet.pet_name}}</div>
            <div class="titleright">品種:{{pet.variety}}</div>
            <q-btn class="titlebot" label="未即時回報" @click="showModal(pet.pet_num)"></q-btn>
            <div v-if="isModalOpen" class="modal">
                <div class="modal-content">
                    <span class="close" @click="closeModal">&times;</span>
                    <div class="modal_title">提醒</div>
                    <div class="modal_body">
                        {{msg}}<br>
                    </div>
                    <q-btn class="modalconfirm_btn" label="確定" @click="closeModal"></q-btn>
                </div>
            </div>
        </div>
        <div class="frequency" v-for="pet_questionrebonse in pets_questionrebonse" :key="pet_questionrebonse.id">
            <div class="che" v-if="pet_questionrebonse.rebonse_check == '1'"><span class="material-symbols-outlined">
check_circle
</span></div>
            
            <div class="x" v-if="pet_questionrebonse.rebonse_check == '2'"><span class="material-symbols-outlined">
close
</span></div>
             
            <router-link to="/review" style="text-decoration: none" @click="review(pet_questionrebonse.pet_num,pet_questionrebonse.rebonse_times)">
                <div class="times">
                    第{{pet_questionrebonse.rebonse_times}}次回報
                </div>
            </router-link>
            
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'ReturnlistPage',
        data(){
            return{
                isModalOpen: false,
                pets:[],
                pets_questionrebonse:[],
                state:false,
                msg:''
            }
        },
        components:{
            DockHome
        },
        created(){
            this.catchData();
            this.fetchData();
        },
        methods:{
            back()
            {
                this.$router.go(-1)
            },
            async catchData(){
                await axios.get('/api/php/returnlistget.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }                    
                })
                .then(res => {
                    this.pets = res.data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                    
            },
            async fetchData(){
                await axios.get('/api/php/returnlist.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }                    
                })
                .then(res => {
                    this.pets_questionrebonse = res.data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },
            review(num,times) {
                this.$router.push({
                    path: '/review',
                    query: {
                        pet_num: num,
                        rebonse_times:times
                    }
                })
            },
            async showModal() {                
                this.isModalOpen = true; // 打開彈跳視窗
                await axios.get('/api/php/nonrebonseontime.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }                    
                })
                .then(res => {
                    this.msg = res.data.msg;
                    this.state = res.data.ok;
                    console.log(this.msg);
                    console.log(this.state);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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
            width: 65%
            text-align: center
            margin-top: 12px
            font-size: 24px
            font-weight: bold
            justify-content: center
    .returnlist
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 1
        background-color: #FEEABC
        .flex
            display: flex
            flex-wrap: wrap
            justify-content: center
            align-items: center
            width:100%
            height: 50px
            .titleleft
                font-size: 18px
                align-items: center
                width: 30%
                
            .titleright
                font-size: 18px
                align-items: center
                width: 40%
            .titlebot
                font-size: 15px
                font-display: flex
                font-family: Microsoft JhengHei
                align-items: center
                width: 30%
                height: 10%
                background: #E0E0E0

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
                        height: 60%
                        overflow: auto
                    .chbox
                        width:100%
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

        .frequency
            background: #FFFFFF
            font-size: 18px
            height: 50px
            width: 100%
            padding-top: 10px 
            border-bottom: solid
            border-color: #E0E0E0  
            display: flex
            justify-content: center

            .times
                color: #000

                
            .che
                color: green
            .x
                color: red
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
</style>
