<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            送領養回報
        </div>
        <div class="body">
            <div v-for="pet in pets" :key="pet.id">
                <div class="input">
                    <span>刊登資料*</span>
                    <p class="data">{{ pet.list_type }}</p>
                </div>
                <div class="input"> 
                    <span>名稱*</span>
                    <p class="data">{{ pet.pet_name }}</p>
                </div>
                <div class="input">
                    <span>種類*</span>
                    <p class="data">{{ pet.pet_type }}</p>
                </div>
                <div class="input">
                    <span>品種</span>
                    <p class="data">{{ pet.variety }}</p>
                </div>
            </div>
            <div class="input">
                <span>年齡*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="report_age" name="age" value="幼年">幼年&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="report_age" name="age" value="成年">成年&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="report_age" name="age" value="未知">未知&emsp;
                </p>
            </div>
            <div class="input">
                <span>結紮狀況*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="report_ligation" name="ligation" value="是">是&emsp;&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="report_ligation" name="ligation" value="否">否&emsp;&emsp;&emsp; 
                </p>
            </div>
            <div class="input">
                <span>上傳照片</span>
                <div class="image-upload">
                    <div class="custom-file-input" v-if="!imageUrl">
                    <span class="material-symbols-outlined"
                            style="font-size: 100px"
                            v-if="!image">
                        add_photo_alternate
                    </span>
                    <input id="file-input" type="file" @change="fileSelected">
                    </div>
                    <img v-if="image" :src="image" width="200" height="200"/> 
                    
                </div>
            </div>
            <div class="sure" @click="submit">
                確認送出
            </div> 
        </div>
    </div>
    <div v-if="isModalOpen" class="modal">
        <div class="modal-content">
            <span class="close" @click="closeModal">&times;</span>
            <div class="modal_title">回報成功</div>
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
    //湯
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
    name:'QuestionrebonsePage',
    components:{
        HeaderHome,
        DockHome
    },
    
    data () {
        return {
            image:'',
            QuestionrebonsePagePage: true,
            pets:[],
            age:'',
            ligation:'',
            rebonse_photo:'',
            rebonse_file:null,
            rebonse_times:'',
            msg:'',
            formData:null,
            state: false,
            dataURL: null,
            track: null,
            alert: false,
            isModalOpen: false,
        }
    },
        created() {
            this.fetchData();
        },
        methods:{
            async fetchData() {
                
                await axios.get('/api/php/questionrebonseget.php', {
                    params: {
                        pet_num: this.$route.query.pet_num
                    }
                    
                })
                .then(res => {
                    this.pets = res.data;
                    for (const pet of res.data) {
                        this.pet_name = pet.pet_name;
                        this.list_type = pet.list_type;
                        this.pet_type = pet.pet_type;
                        this.variety = pet.variety;
                        this.rebonse_times = pet.rebonse_times;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                    
            },            
            fileSelected(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded);
                reader.readAsDataURL(file);

                this.rebonse_file = e.target.files[0];
                this.rebonse_photo = e.target.files[0].name;
                this.formData = new FormData();
                this.formData.append('photo', this.rebonse_file);
            },
            imageLoaded(e) {
                this.image = e.target.result;
            },
            async publish(){
                await axios.get(`/api/php/questionrebonse.php`,{
                    params:{
                        pet_num: this.$route.query.pet_num,
                        pet_name :this.pet_name,
                        list_type : this.list_type,
                        pet_type :this.pet_type,
                        variety :this.variety,
                        age: this.report_age,
                        ligation: this.report_ligation,
                        rebonse_photo:this.rebonse_photo,
                    }
                })
                .then(res => {
                    this.msg = res.data.msg;
                    this.state = res.data.ok;
                    console.log(this.msg);
                    console.log(this.state);
                })
                .catch(error => {
                    console.error(error);
                });
            },
            async upload(formData) {
                try {
                    const response = await axios.post(`/api/php/photofile.php`, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data", // 設定檔頭，確保後端能正確解析 FormData
                        },
                    });
                    console.log("照片上傳成功", response.data);
                } catch (error) {
                    console.error("照片上傳失敗", error);
                }
            },
            submit() {
                this.publish();
                console.log(this.rebonse_photo);
                this.upload(this.formData);
                this.isModalOpen = true;
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
            width: 100%
            height: 100%
            text-align: center
            background-color: #FEEABC
            .input
                display: flex
                justify-content: center  
                align-items: center
                border-bottom-style: solid
                border-color: #FFFFFF
                .rdobutton_radio
                    width: 20px
                    height: 20px
                & > span
                    width: 30%
                    height: 10%
                    display: flex
                    justify-content: left  
                    align-items: center
                    text-align: left
                    padding-left: 20px
                    font-size: 18px
                    letter-spacing: 2px
                & > p
                    width: 70%
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
            .sure
                margin: 0 auto
                margin-top: 1rem
                width: 30%
                line-height: 2.5rem
                background-color: #FDFFA6
                border-radius: 0.4rem
                text-align: center
                font-size: 18px
                font-weight: bo
                border: 1px solid
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
