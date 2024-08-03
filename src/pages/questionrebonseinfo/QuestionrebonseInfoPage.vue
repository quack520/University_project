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
                <p>{{ pet_questionrebonse.age }}</p>
            </div>
            <div class="input">
                <span>結紮狀況</span>
                <p>{{ pet_questionrebonse.ligation }}</p>
            </div>
            <div class="input">
                <span>近期照片</span>
                <img  class="img" 
                    :src="'/api/img/' + pet_questionrebonse.rebonse_photo" 
                     />
            </div>
            <!-- <div class="input">
                <span>審核狀況*</span>
                <p>{{ msg }}</p>
            </div>             -->
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'questionrebonseinfoPage',
        components:{
            HeaderHome,
            DockHome
        },
        data(){
            return{
                pets_questionrebonse:[],
                // msg:''
            }
        },
        created(){
            this.fetchData();
        },
        methods:{
            async fetchData(){
                try{
                    const res = await axios.get('/api/php/questionrebonseInfo.php', {
                        params: {
                            pet_num: this.$route.query.pet_num,
                            rebonse_times:this.$route.query.rebonse_times
                        }
                    });
                    this.pets_questionrebonse = res.data;
                }catch (error) {
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
                .img
                    width: 200px
                .rdobutton_radio
                    width: 20px
                    height: 20px
                & > span
                    width: 40%
                    height: 10%
                    display: flex
                    justify-content: left  
                    align-items: center
                    text-align: left
                    padding-left: 20px
                    font-size: 18px

                    letter-spacing: 2px
                & > p
                    width: 60%
                    display: flex
                    text-align: justify
                    padding-top: 10px
                    padding-left: 10px 
                    font-size: 16px


                    .image-upload
                    display: flex
                    width: 80%
                    display: flex
                    text-align: justify
                .image-preview
                    margin-bottom: 20px
                    img
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
                    margin: 30px 30px 30px 30px
                    margin-top: 1rem
                    width: 150px
                    line-height: 2.5rem
                    background-color: #FDFFA6
                    border-radius: 0.4rem
                    text-align: center
                    font-size: 18px
                    font-weight: bo

                    border: 1px solid
                    cursor: pointer
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
