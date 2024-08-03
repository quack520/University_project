<template>
    <div v-for="coa in coas" :key="coa.id">
        <div class="publicadopt">
            <div class="publicadoptlist">
                <div class="pet_icon">
                    <span class="material-symbols-outlined">gite</span>
                    <p class="data">{{ coa.animal_place }}</p>
                    <!-- <p class="data">台北市動物之家</p> -->
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">pin_drop</span>
                    <p class="data">{{ coa.shelter_address }}</p>
                    <!-- <p class="data">122</p> -->
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">transgender</span>
                    <p class="data">{{ coa.animal_sex }}</p>
                    <!-- <p class="data">122</p> -->
                </div>
                <div class="pet_icon">
                    <span class="material-symbols-outlined">format_list_bulleted</span>
                    <p class="data">{{ coa.animal_kind }}</p>
                    <!-- <p class="data">122</p> -->
                </div>
                <div class="img1">
                    <!--<img class="pet_img" :src="pet.image">-->
                    <img class="img" 
                    :src=" coa.album_file  " />
                </div>
                    <q-btn class="detail_btn" label="詳細資料"  @click="coa_detail(coa.animal_id)"></q-btn>
            </div>
        </div>
    </div>
</template>

<script>
    //呱
    import axios from 'axios'
    export default {
        name: "PublicadoptlistPage",
        data(){
            return{
                coas: []
            };
        },
        mounted() {
            this.fetchData()
        },
        methods:{
            fetchData() {
                axios.get('/api/php/publicadoptionlist.php')
                .then(res => {
                    this.coas = res.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            coa_detail(num){
                this.$router.push({
                    path: '/publicadoptiondata',
                    query: {
                        animal_id: num
                    }
                })
            }
        }
    };
</script>

<style lang="sass" scoped>
    .publicadopt
        // padding: 2.5px
        margin: 0.2rem
        justify-content: center
        text-align: center
        width: 100%
        height: 510px
        .publicadoptlist
            background-color:#FFFFFF
            width: 170px
            border-radius: 30px 30px 30PX 30PX
            margin: 0.3rem
            justify-content: center
            padding-bottom: 1px 
            height: 500px
        .pet_icon
            display: flex
            width:100%
            justify-content: center
            align-items: center
            .material-symbols-outlined
                font-size: 30px
                width:25%
                color: black
                text-decoration: none
                padding-top: 15px
                text-align: right
                justify-content: right
            .data
                width:75%
                margin: 0 auto
                margin-top: 1rem
                width: 5.8rem
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                justify-content: left
                font-size: 0.75rem
                font-weight: bold
                color: #000
        .img1
            padding-top:10px
            width:100%
            .img
                width: 140px
                height: 180px
            .pet_img
                width: 140px
                height: 140px

        .detail_btn
            background:#FEEABC
            color: black
            width: 100px
            margin: 10px 0 20px 0
</style>
