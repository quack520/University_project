<template>
    <div v-for="pet in pets" :key="pet.id">
        <div class="losthelp">
            <div class="losthelplist">
                <div class="pet_icon">
                    <span class="material-symbols-outlined">account_circle</span>
                    <p class="data">{{ pet.pet_name }}</p>
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">pin_drop</span>
                    <p class="data">{{ pet.pet_area }}</p>
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">transgender</span>
                    <p class="data">{{ pet.pet_sex }}</p>
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">format_list_bulleted</span>
                    <p class="data">{{ pet.pet_type }}</p>
                </div>
                <div class="img">
                    <img class="img" 
                    :src="'/api/img/' + pet.pet_photo1" 
                     />
                </div>
                    <div class="detail-btn" @click="pet_detail(pet.pet_num)">詳細資料</div>
            </div>
        </div>
    </div>
</template>

<script>
    //呱
    import axios from 'axios';
    export default {
        name: 'LosthelplistPage',
        data() {
            return {
                pets: []
            };
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/api/php/losthelplist.php')
                    .then(res => {
                        this.pets = res.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            pet_detail(pet_num) {
                this.$router.push({
                    path: '/losthelpdata',
                    query: {
                        pet_num: pet_num,
                    }
                })
            }
        }
    };
</script>

<style lang="sass" scoped>
    .losthelp
        padding: 2.5px
        justify-content: center
        text-align: center
        width: 100%
        height: 450px
        .losthelplist
            background-color:#FFFFFF
            width: 170px
            border-radius: 30px 30px 30PX 30PX
            margin: 0.3rem
            height:100%
            justify-content: center
            padding-bottom: 1px 
        .pet_icon
            display: flex
            width:100%
            justify-content: center
            .material-symbols-outlined
                font-size: 30px
                width:30%
                color: black
                text-decoration: none
                padding-top: 15px
                padding-left: 40px
                text-align:right
                justify-content: right
            .data
                width:70%
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
        .img
            padding-top:10px
            // width: 80% 

            width: 170px
            height: 170px
            .pet_img
                width: 170px
                height: 170px

        .detail-btn
            margin: 0 auto
            margin-top: 1rem
            margin-bottom: 10px 
            width: 4.8rem
            line-height: 1.8rem
            background-color: #FEEABC
            border-radius: 0.4rem
            text-align: center
            font-size: 0.75rem
            font-weight: bold
            color: #000
            margin-top: 1.6rem
            margin-bottom: 1.6rem
            cursor: pointers
</style>
