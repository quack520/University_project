<template>
    <div class="header">
        <div class="infoleft" @click="back">
            <span class="material-symbols-outlined" >chevron_left</span>
        </div>
        <div class="infocenter">
            我的刊登
        </div>
    </div>
    <!-- 0顯示1隱藏 -->
    <div class="mypost">
        <div class="mypost" v-if="dataLoaded || (pets.length || pets_lost.length || pets_take.length || goods.length)">
            <div class="flex">
                <div class="title">送養</div>
                <!-- <div class="pet" v-for="pet in pets" :key="pet.id" > -->
                <div class="pet" v-for="pet in pets" :key="pet.id" >
                    <div class="info" @click="adopt(pet.pet_num)">
                        <div class="p_title">種類：{{pet.pet_type}}</div>       
                        <div class="p_data">名字：{{pet.pet_name}}</div>               
                        <div class="p_data">品種:{{pet.variety}}</div>
                    </div>
                    <div class="img">
                        <span class="material-symbols-outlined" @click="hide_adopt(pet.pet_num)">cancel</span> 
                    </div>              
                </div>
            </div>
            <div class="flex">
                <div class="title">走失</div>
                <div class="pet" v-for="pet in pets_lost" :key="pet.id" >
                    <div class="info" @click="lost(pet.pet_num)">
                        <div class="p_title">種類：{{pet.pet_type}}</div>       
                        <div class="p_data">名字：{{pet.pet_name}}</div>               
                        <div class="p_data">品種：{{pet.variety}}</div> 
                    </div>
                    <div class="img"> 
                        <span class="material-symbols-outlined"  @click="hide_lost(pet.pet_num)">cancel</span>
                    </div>
                                
                </div>
            </div>
            <div class="flex">
                <div class="title">拾獲</div>
                <div class="pet" v-for="pet in pets_take" :key="pet.id" >
                    <div class="info" @click="pickup(pet.pet_num)">
                        <div class="p_title">種類：{{pet.pet_type}}</div>       
                        <div class="p_data">名字：{{pet.pet_name}}</div>               
                        <div class="p_data">品種：{{pet.variety}}</div> 
                    </div>   
                    <div class="img" >
                        <span class="material-symbols-outlined" @click="hide_take(pet.pet_num)">cancel</span>   
                    </div>       
                </div>
            </div>
            <div class="flex">
                <div class="title">二手用品</div>
                <div class="pet" v-for="good in goods" :key="good.id">
                    <div class="info"  @click="second(good.good_num)">
                        <div class="p_title">名字：{{good.good_name}}</div>       
                        <div class="p_data">數量：{{good.good_amount}}</div>   
                        <div class="p_data"></div>  
                    </div>
                    <div class="img" > 
                        <span class="material-symbols-outlined" @click="hide_good(good.good_num)">cancel</span>            
                    </div>
                </div>
            </div>
        </div>
        <div class="zero" v-if="shouldShowImage">
            <img class="img" src="@/assets/nopost.jpg" />
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    //呱
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default{
        name:'MypostPage',
        components:{
            DockHome
        },
        data(){
            return{
                pets:[],
                pets_lost:[],
                pets_take:[],
                goods:[],
                dataLoaded: false,
            }
        },
        computed: {
            shouldShowImage() {
                // 檢查所有數據是否為空且所有的hide_status=1
                const allDataHidden = (
                    this.pets.every(pet => pet.hide_status === 1) &&
                    this.pets_lost.every(pet => pet.hide_status === 1) &&
                    this.pets_take.every(pet => pet.hide_status === 1) &&
                    this.goods.every(good => good.hide_status === 1)
                );

                // 返回結果決定是否要顯示照片
                return allDataHidden;
            }
        },
        mounted() {
            this.me_num = this.$route.query.me_num;
            this.fetchData();
            this.restoreHideStatus();
        },
        methods:{
            fetchData() {
                axios.get('/api/php/mypost.php',{
                    params: {
                        me_num: this.$route.query.me_num
                    }
                })
                .then(res => {
                    this.pets = res.data.pets;
                    this.pets_lost = res.data.pets_lost;
                    this.pets_take = res.data.pets_take;
                    this.goods = res.data.goods;
                    this.dataLoaded = true;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            back()
            { 
                if(this.$route.query.me_num) {
                    this.$router.push({
                        path: '/myaccount',
                        query: { 
                            me_num: this.$route.query.me_num 
                        }
                    });
                } else {
                    this.$router.go(-1);
                }
            },
            adopt(pet_num){
                this.$router.push({
                    path: '/petdata',
                    query: {
                        pet_num: pet_num
                    },
                });
            },
            lost(pet_num){
                this.$router.push({
                    path: '/losthelpdata',
                    query: {
                        pet_num: pet_num
                    },
                });
            },
            pickup(pet_num){
                this.$router.push({
                    path: '/losthelpdata',
                    query: {
                        pet_num: pet_num
                    },
                });
            },
            second(good_num){
                this.$router.push({
                    path: '/secondhandinfo',
                    query: {
                        good_num: good_num
                    },
                });
            },
            hide_adopt(pet_num){
                axios.get('/api/php/hidemypost.php', {
                    params: {
                        pet_num: pet_num,
                        hide_status: 1
                    }
                })
                .then(res => {
                    // 在localStorage記錄隱藏狀態
                    localStorage.setItem(`hide_${pet_num}`, 'hidden');

                    // 更新前端顯示狀態
                    const index = this.pets.findIndex(pet => pet.pet_num === pet_num);
                    if (index !== -1) {
                        this.pets.splice(index, 1);
                    }
                    console.log(`hide_${pet_num} status:`, localStorage.getItem(`hide_${pet_num}`));
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            hide_lost(pet_num){
                axios.get('/api/php/hidemypost.php', {
                    params: {
                        pet_num: pet_num,
                        hide_status: 1
                    }
                })
                .then(res => {
                    localStorage.setItem(`hide_${pet_num}`, 'hidden');

                    const index = this.pets.findIndex(pet => pet.pet_num === pet_num);
                    if (index !== -1) {
                        this.pets.splice(index, 1);
                    }
                    console.log(`hide_${pet_num} status:`, localStorage.getItem(`hide_${pet_num}`));
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            hide_take(pet_num){
                axios.get('/api/php/hidemypost.php', {
                    params: {
                        pet_num: pet_num,
                        hide_status: 1
                    }
                })
                .then(res => {
                    localStorage.setItem(`hide_${pet_num}`, 'hidden');
                
                    const index = this.pets.findIndex(pet => pet.pet_num === pet_num);
                    if (index !== -1) {
                        this.pets.splice(index, 1);
                    }
                    console.log(`hide_${pet_num} status:`, localStorage.getItem(`hide_${pet_num}`));
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            hide_good(good_num){
                axios.get('/api/php/hidemypost.php', {
                    params: {
                        good_num: good_num,
                        hide_status: 1
                    }
                })
                .then(res => {
                    localStorage.setItem(`hide_${good_num}`, 'hidden');

                    const index = this.goods.findIndex(good => good.good_num === good_num);
                    if (index !== -1) {
                        this.goods.splice(index, 1);
                    }
                    console.log(`hide_${good_num} status:`, localStorage.getItem(`hide_${good_num}`));
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            restoreHideStatus() {
                this.pets.forEach(pet => {
                    const hideStatus = localStorage.getItem(`hide_${pet.pet_num}`);
                    console.log(`Pet ${pet.pet_num} hide_status:`, hideStatus);
                    if (hideStatus === 'hidden') {
                        pet.hide_status = 1;
                    } else {
                        pet.hide_status = 0;
                    }
                });
                this.goods.forEach(good => {
                    const hideStatus = localStorage.getItem(`hide_${good.good_num}`);
                    console.log(`Good ${good.good_num} hide_status:`, hideStatus);
                    if (hideStatus === 'hidden') {
                        good.hide_status = 1;
                    } else {
                        good.hide_status = 0;
                    }
                });
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
        z-index: 999
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
        
    .mypost
        background-color: #FEEABC
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: auto
        z-index: 1
        
        .flex
            display: flex
            flex-wrap: wrap
            justify-content: center
            align-items: center
            .title
                font-size: 18px
                background-color: #FFFFFF
                border-radius: 15px 15px 15px 15px
                width:90px
                height: 30px
                margin-top: 5px
                margin-bottom: 5px
                justify-content: center
                border-bottom: solid
            .pet
                width: 100%
                background-color: #FFFFFF
                border-top: solid
                display: flex
                .info
                    width: 89%
                    height: 50px
                    display: flex
                    align-items: center

                    .p_title
                        width: 40%
                        font-size: 18px
                        text-align: left
                        padding-left: 5px
                    .p_data
                        width: 30%
                        font-size: 18px
                        text-align: left
                        padding-left: 5px
                .img
                    width: 11%
                    .material-symbols-outlined
                        font-size: 48px
                        z-index: 9999
    .zero
        background-color: #FEEABC
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        z-index: 2
        display: flex
        align-items: center
        justify-content: center
        

    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
