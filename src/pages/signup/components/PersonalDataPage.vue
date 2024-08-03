<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="personalData">
        <div class="PData_bottom">
            <p class="PData_title">會員資訊</p>
            <div v-for="member in members" :key="member.id">
                <div class="data">姓名 : {{ member.mname }}</div>
                <q-input class="mname" color="yellow" v-model="updated_mname" placeholder="姓名" type="name"></q-input>
                <div class="data">身分證 : {{ member.identity_card }}</div>
                <q-input class="identity_card" color="yellow" v-model="updated_identity_card" placeholder="身分證" type="identity_card"></q-input>
                <div class="data">手機 : {{ member.phone }}</div>
                <q-input class="phone" color="yellow" v-model="updated_phone" placeholder="手機" type="phone"></q-input>
                <div class="data">email : {{ member.email }}</div>
                <q-input class="email" color="yellow" v-model="updated_email" placeholder="email" type="email"></q-input>
            </div>
            <div style="min-height: 100px;">
                <div class="image-upload">
                    <div class="custom-file-input" v-if="!imageUrl">
                        <span class="material-symbols-outlined"
                                style="font-size: 100px"
                                v-if="!image">
                            add_photo_alternate
                        </span>
                        <input id="file-input" type="file" @change="fileSelected">
                    </div>
                    <img v-if="image" :src="image" width="200"/> 
                </div>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
            </div>
            <q-btn class="revise_btn" label="修改會員資料" @click="confirm"></q-btn>
        </div>
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <div class="modal_title">修改成功</div>
                <div class="modal_body">
                    本平台已成功<br>
                    送出您的會員資料
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
    //呱
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    export default {
        name:'PersonalDataPage',
        components:{
            HeaderHome,
            DockHome
        },
        data(){
            return{
                members:[],
                updated_mname: '',
                updated_identity_card: '',
                updated_phone: '',
                updated_email: '',
                me_photo:'',
                member_file: null,
                isModalOpen: false,
                dataURL: null,
                formData:null,
                image: false,
            };
        },
        props:{
            PersonalDataPage: Boolean,
        },
        mounted() {
            this.fetchData();
        },
        methods:{
            //顯示資料
            fetchData() {
                axios.get('/api/php/personaldata.php', {
                    params: {
                        me_num: this.$route.query.me_num,
                    }
                })
                .then(res => {
                    this.members = res.data; 
                    console.log(res.data);
                })
                .catch(error => {
                    console.error(error); // 處理任何可能的錯誤
                });
            },
            confirm(){
                this.me_num = localStorage.getItem('token')
                this.upload(this.formData);
                axios.get('/api/php/updatapersonaldata.php', {
                    params: {
                        me_num: this.me_num,
                        updated_mname: this.updated_mname || null,
                        updated_identity_card: this.updated_identity_card || null,
                        updated_phone: this.updated_phone || null,
                        updated_email: this.updated_email || null,
                        me_photo: this.me_photo || null
                    }
                })
                .then(res => {
                    console.log(res.data)
                    this.state = res.data.ok
                    this.isModalOpen = true;
                })
                .catch(error => {
                    console.error(error);
                });
                //this.isModalOpen = true;
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
            fileSelected(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded);
                reader.readAsDataURL(file);

                this.member_file = e.target.files[0];
                this.me_photo = e.target.files[0].name;
                this.formData = new FormData();
                this.formData.append('photo', this.member_file);
            },
            imageLoaded(e) {
                this.image = e.target.result;
            },
            // upload() {
            //     // 用base64字串的方式上傳
            //     axios.post('/upload', {image: this.image});
            //     // 用FormData這種非字串的方式上傳
            //     //const form = new formData();
            //     //form.append(this.file, this.file.name)
            
            // },
            // confirm(){
            // },
            // this.isModalOpen = true;
                
        },
        closeModal() {
            this.isModalOpen = false; // 關閉彈跳視窗
        },
        check()
        {

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
    .personalData
        
        height:90%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: auto
        z-index: 1
        .PData_top
            position: absolute
            height:0
            top:0
            left:0
            padding-bottom: 300px
            width: 100%
            background-color: #FEEABC
        .PData_bottom
            position: relative
            top:0
            left:0
            border-radius: 0 0 0 0
            background-color: #FFFFFF
            padding: 0px 30px 480px 20px
            margin-top: 20px
            overflow: hidden
            justify-content: center  
            text-align: center
            justify-content: center 
            .PData_title
                font-size: 18px
            .data
                font-size: 18px
                text-align: left
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
            .revise_btn
                margin: 0.5rem auto
                width: 100%
                line-height: 1.8rem
                background-color: #FEEABC
                border-radius: 0.4rem
                text-align: center
                margin-top:20px 
                font-size: 0.75rem
                font-weight: bold
                color: #000
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
