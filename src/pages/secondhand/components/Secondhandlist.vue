<template>
    <div v-for="good in goods" :key="good.id">
        <div class="secondhandlist">
            <div class="secondhand_icon">
                <span class="material-symbols-outlined">account_circle</span>
                <p class="data">{{ good.mname }}</p>
            </div>
            <img class="img" 
                    :src="'/api/img/' + good.good_photo1 " 
                     />
                    
            <div class="secondhand">
                {{ good.good_name }}
            </div>
            <div class="detail-btn" @click="good_detail(good.good_num)">詳細資料</div>
        </div>
    </div>
</template>


<script> 
    //呱
    import axios from 'axios';
    export default {
        name:'SecondhandlistPage',
        data() {
            return {
                goods: []
            };
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/api/php/secondhandlist.php')
                .then(res => {
                    this.goods = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            good_detail(good_num) {
                this.$router.push({
                    path: '/secondhandinfo',
                    query: {
                        good_num: good_num,
                    }
                })
            },
        }
    }  
</script>

<style lang="sass" scoped>
    .secondhandlist
        background-color:#FFFFFF
        width: 160px
        border-radius: 30px 30px 30PX 30PX
        margin: 0.3rem
        height: 280px
        .secondhand_icon
            display: flex
            align-items: center
            margin-bottom: 1rem
            justify-content: center
            width: 100%
            .material-symbols-outlined
                font-size: 30px
                width:30%
                color: black
                text-decoration: none
                padding-top: 15px
                padding-left: 30px
                text-align:right

            .data
                width:60%
                margin: 0 auto
                margin-top: 1rem
                width: 3.2rem
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                justify-content: left
                font-size: 0.75rem
                font-weight: bold
                color: #000
        .secondhand
            margin: 0 auto
            margin-top: 10px
            width: 100%
            line-height: 1.8rem
            border-radius: 0.4rem
            text-align: center
            font-size: 18px
            font-weight: bold
            color: #000
        .img
            width: 125px
            height: 128px
            
        .detail-btn
            margin: 0 auto
            
            width: 3.2rem
            line-height: 1.8rem
            background-color: #FEEABC
            border-radius: 0.4rem
            text-align: center
            font-size: 0.75rem
            font-weight: bold
            color: #000
            margin-top: 10px

            cursor: pointer

</style>

