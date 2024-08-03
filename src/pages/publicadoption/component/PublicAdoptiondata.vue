<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            公立領養
        </div>
        <div class="body" v-for="coa in coas" :key="coa.id">
            <div class="png">
                <img class="img" 
                :src=" coa.album_file  " />
            </div>
            <div>
            <!-- <div v-if="pet"> -->
                <div class="name">{{ coa.animal_place }}</div>
                <!-- <div class="name">台北市動物之家</div> -->
                <div class="table">
                    <div class="t-left">區域編號</div>
                    <div class="t-rig">{{ coa.animal_subid }}</div>
                </div>
                <div class="table">
                    <div class="t-left">年齡</div>
                    <div class="t-rig">{{ coa.animal_age }}</div>
                </div>
                <div class="table">
                    <div class="t-left">性別</div>
                    <div class="t-rig">{{ coa.animal_sex }}</div>
                </div>
                <div class="table">
                    <div class="t-left">體型</div>
                    <div class="t-rig">{{ coa.animal_bodytype }}</div>
                </div>
                <div class="table">
                    <div class="t-left">毛色</div>
                    <div class="t-rig">{{ coa.animal_colour }}</div>
                </div>
                <div class="table">
                    <div class="t-left">結紮</div>
                    <div class="t-rig">{{ coa.animal_sterilization }}</div>
                </div>
                <div class="table">
                    <div class="t-left">狂犬病疫苗</div>
                    <div class="t-rig">{{ coa.animal_bacterin }}</div>
                </div>
                <div class="table">
                    <div class="t-left">詳細說明</div>
                    <div class="t-rig">{{ coa.animal_remark }}</div>
                </div>
                <div class="table_add">
                    <div class="t-left_add">地址</div>
                    <div class="t-rig_add">{{ coa.shelter_address}}</div>
                </div>
                <div class="table">
                    <div class="t-left">電話</div>
                    <div class="t-rig">{{ coa.shelter_tel }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    //呱
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    import { ref } from 'vue'
    export default {
        name:'PublicAdoptiondataPage',
        components:{
            HeaderHome,
            DockHome
        },
        setup () {
            return {
                slide: ref('style'),
            }
        },
        data() {
            return {
                coas: [],
            };
        },
        async mounted() {
            await this.fetchData();
        },
        methods: {
            async fetchData() {
                await axios.get('/api/php/publicadoptiondata.php', {
                    params: {
                        animal_id: this.$route.query.animal_id
                    }
                })
                .then(res => {
                    this.coas = res.data;
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error);
                });
            }
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
        margin: 0
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
            z-index: 1 
        .body
            width: 100%
            height: 90%
            .png
                width: 100%
                height: 160px
                .img
                    width:120px
            .name
                font-size: 22px
            .table
                widows: 100vw
                height: 40px
                display: flex
                border-top: 1px solid
                border-bottom: 1px solid
                font-size: 2em
                
                .t-left
                    width: 35%
                    display: flex
                    justify-content: center  
                    align-items: center
                    border-right: 1px solid
                    
                    font-size: 20px
                .t-rig
                    width: 65%
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
                    background-color: #FFFFFF
            .table_add
                widows: 100vw
                height: 60px
                display: flex
                border-top: 1px solid
                border-bottom: 1px solid
                font-size: 2em
                
                .t-left_add
                    width: 35%
                    display: flex
                    justify-content: center  
                    align-items: center
                    border-right: 1px solid
                    
                    font-size: 20px
                .t-rig_add
                    width: 65%
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
                    background-color: #FFFFFF

            .illustrate
                widows: 100vw
                height: 5%
                display: flex
                border-top: 1px solid
                border-bottom: 1px solid
                font-size: 2em
                
                .i-left
                    width: 35%
                    display: flex
                    justify-content: center  
                    align-items: center
                    border-right: 1px solid
                    background-color: #FFFFFF
                    font-size: 20px
                .i-rig
                    width: 65%
                    display: flex
                    justify-content: center  
                    align-items: center
                    font-size: 18px
        
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>



