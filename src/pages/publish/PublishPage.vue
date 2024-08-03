<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            刊登資料
        </div>
        <div class="body">
            <div class="input">
                <span class="infotitle">刊登資料*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="list_type" name="list_type" value="送養">送養&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="list_type" name="list_type" value="拾獲">拾獲&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="list_type" name="list_type" value="走失">走失
                    <!-- <input class="rdobutton_radio" required type="radio" v-model="list_type" name="list_type" value="協尋">協尋 -->
                </p>
            </div>
            <div class="input">
                <span class="infotitle">名稱*</span>
                <p><input required type="text" v-model="pet_name" name="name"  size="35%"></p>
            </div>
            <div class="input">
                <span >種類*</span>
                <p>
                    <input  type="text" v-model="pet_type" name="name"  placeholder="例:狗" size="35%">
                </p>
            </div>
            <div class="input">
                <span >品種</span>
                <p><input  type="text" v-model="variety" name="name"  placeholder="例:馬爾濟斯" size="35%"></p>
            </div>
            <div class="input">
                <span >年齡*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="age" name="age" value="幼年">幼年&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="age" name="age" value="成年">成年&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="age" name="age" value="未知">未知&emsp;
                </p>
            </div>
            <div class="input">
                <span>性別*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="pet_sex" name="pet_sex" value="公">公&emsp;&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="pet_sex" name="pet_sex" value="母">母&emsp;&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="pet_sex" name="pet_sex" value="未知">未知
                </p>
            </div>
            <div class="input">
                <span >體型*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="pet_size" name="pet_size" value="小型">小型&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="pet_size" name="pet_size" value="中型">中型&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="pet_size" name="pet_size" value="大型">大型&emsp;
                </p>
            </div>
            <div class="input">
                <span >毛色</span>
                <p>
                    <input  type="text" v-model="color" name="name"  placeholder="例:黑白色" size="35%">
                </p>
            </div>
            <div class="input">
                <span >結紮狀況*</span>
                <p>
                    <input class="rdobutton_radio" required type="radio" v-model="ligation" name="ligation" value="是">是&emsp;&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="ligation" name="ligation" value="否">否&emsp;&emsp;&emsp;
                    <input class="rdobutton_radio" required type="radio" v-model="ligation" name="ligation" value="未知">未知
                </p>
            </div>
            <div class="input">
                <span >地區*</span>
                <p>
                    <input  type="text" v-model="pet_area" name="name"  placeholder="請輸入地區" size="35%">
                </p>
            </div>
            <div class="input">
                <span>詳細說明</span>
                <p>
                    <input  type="text" v-model="pet_detail" name="illustrate"  placeholder="描述動物狀態" rows="5" size="33%">
                </p>
            </div>
            <div class="input">
                <span >領養條件*</span>
                <p style="text-align: left">1.需後續追蹤<br>2.須簽愛心切結書</p>
            </div>
            <div class="input">
                <span>上傳圖片*</span>
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
                    <div class="picture">
                    <div style="min-height: 100px;">
                        <div class="image-upload">
                            <div class="custom-file-input" v-if="!imageUrl2">
                                <span class="material-symbols-outlined"
                                        style="font-size: 100px"
                                        v-if="!image2">
                                    add_photo_alternate
                                </span>
                                <input id="file-input" type="file" @change="fileSelected2">
                            </div>
                            <img v-if="image2" :src="image2" width="120" height="120"/> 
                        </div>
                    </div>
                    <div class="picture">
                    <div style="min-height: 100px;">
                        <div class="image-upload">
                            <div class="custom-file-input" v-if="!imageUrl3">
                                <span class="material-symbols-outlined"
                                        style="font-size: 100px"
                                        v-if="!image3">
                                    add_photo_alternate
                                </span>
                                <input id="file-input" type="file" @change="fileSelected3">
                            </div>
                            <img v-if="image3" :src="image3" width="120" height="120"/> 
                        </div>
                    </div>
                </div>
                </div>
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
                </div>
            </div>
            <div class="end">
                <span class="material-symbols-outlined">call</span>
                <span class="connect">聯絡方式</span>
                <p class="connectinfo">聯絡人姓名*<input class="connectinput" type="text" v-model="mname" name="usrname"  placeholder="陳曉明"  size="23%"></p>
                <p class="connectinfo">聯絡人電話*<input class="connectinput" type="tel" v-model="phone" name="phone"  placeholder="0900000123"  size="23%"></p>
                <p class="connectinfo">聯絡人信箱*<input class="connectinput" type="text" v-model="email" name="eamil"  placeholder="123456@gmail.com"  size="23%"></p>
            </div>
            <q-btn class="confirm_btn" label="確認送出" @click="showModal"></q-btn>
            <div v-if="isModalOpen" class="modal">
                <div class="modal-content">
                    <span class="close" @click="closeModal">&times;</span>
                    <div class="modal_title">刊登條款</div>
                    <div class="modal_body">
                        刊登人使用由AARS寵物資訊平台(以下簡稱「AARS」)所提供之送養資訊刊登服務(以下簡稱「本服務」)時，均受到本「刊登條款」規範。
                        1.AARS要求所有刊登送養資訊及查看送養資訊者均須加入會員，是為了保證所有查看資訊的人都確實的留下紀錄，請送養人注意，如將動物送養後有查覺異常或有任何虐待事項，請立即通報政府單位，我們將配合政府單位之發文要求提供相關紀錄資料。
                        2.送養資訊不限刊登時間，因此將動物確定送養後請回網站關閉送養資訊，避免造成自身困擾。
                        3.目前不開放剛出生或尚未開眼之動物送養。
                        4.AARS 僅為資訊交流平台，無法保證刊登內容之正確性，刊登人對其刊登內容及送養之行為應負完全之責任，刊登人應提供確實之刊登內容，並自負相關法律責任。
                        5.AARS 對刊登資訊保有最終篩選、修改、刪除及決定刊登與否之權利。
                        6.AARS 秉持以領養代替購買之精神，禁止以下類型之刊登內容：
                            a.要求補貼、認養價、營養費、結紮費等一切任何額外費用或有實際販賣行為。
                            b.捏造不實資訊。
                            c.特意收集個人資料。
                            如有違反上述條款之情事，AARS可能將其進行會員停權或封鎖之處置。
                        7.刊登人應確定刊登之內容未使用未經授權之文字、圖片、影音或任何形式之資訊。
                        8.刊登人同意授權於本服務刊登之資訊內容無償提供第三人分享、轉載或推廣。
                    </div>
                    <div class="chbox">
                        <q-checkbox 
                            v-model="orange" 
                            label="我以詳閱且同意本刊登條款" 
                            color="orange" 
                            true-value="yes"
                            false-value="no"
                            width="100%" />
                    </div>
                    <q-btn class="modalconfirm_btn" label="確定" @click="confirm"></q-btn>
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
    //import { ref } from 'vue'
    export default {
        name:'PublishPage',
        components:{
            HeaderHome,
            DockHome
        },
        data () {
            return {
                PublishPage: true,
                me_num:'',
                list_type:'',
                pet_name:'',
                pet_type:'',
                variety:'',
                age:'',
                pet_sex:'',
                color:'',
                ligation:'',
                pet_area:'',
                pet_detail:'',

                pet_photo1:'',
                pet_file1: null,
                formData1:null,
                pet_photo2:'',
                pet_file2: null,
                formData2:null,
                pet_photo3:'',
                pet_file3: null,
                formData3:null,

                mname:'',
                phone:'',
                pet_size:'',
                email:'',

                image: '',
                image2: '',
                image3: '',
                msg:'',
                state: false,
                dataURL: null,
                track: null,
                alert: false,
                isModalOpen: false,
                //orange: ref(false),
                orange: 'no',
            }
        },
        async mounted() {
            this.me_num = localStorage.getItem('token');
        },
        methods:{
            async confirm() {
                if (this.orange === 'yes') {
                    try{
                        const res = await axios
                        .get('/api/php/publish.php', {
                            params:{
                                me_num: this.me_num,
                                list_type: this.list_type,
                                pet_name: this.pet_name,
                                pet_type: this.pet_type,
                                variety: this.variety,
                                age: this.age,
                                pet_sex: this.pet_sex,
                                color: this.color,
                                ligation: this.ligation,
                                pet_area: this.pet_area,
                                pet_detail: this.pet_detail,

                                pet_photo1: this.pet_photo1,
                                pet_photo2: this.pet_photo2,
                                pet_photo3: this.pet_photo3,

                                mname: this.mname,
                                phone: this.phone,
                                pet_size: this.pet_size,
                                email: this.email,
                            }
                        });
                        console.log(res.data);
                        this.msg = res.data.msg;
                        this.state = res.data.ok;
                    }catch (error) {
                            console.error(error);
                    }

                    await this.upload1(this.formData1);
                    await this.upload2(this.formData2);
                    await this.upload3(this.formData3);

                    this.$router.push({
                        path: '/home',
                        query: {
                            me_num: this.me_num,
                        },
                    });
                }
            },
            
            fileSelected(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded);
                reader.readAsDataURL(file);

                this.pet_file1 = e.target.files[0];
                this.pet_photo1 = e.target.files[0].name;
                this.formData1 = new FormData();
                this.formData1.append('photo', this.pet_file1);
            },
            imageLoaded(e) {
                this.image = e.target.result;
            },
            async upload1(formData1) {
                try {
                    const response = await axios.post(`/api/php/photofile.php`, formData1, {
                        headers: {
                            "Content-Type": "multipart/form-data", // 設定檔頭，確保後端能正確解析 FormData
                        },
                    });
                    console.log("照片上傳成功", response.data);
                } catch (error) {
                    console.error("照片上傳失敗", error);
                }
            },

            fileSelected2(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded2);
                reader.readAsDataURL(file);

                this.pet_file2 = e.target.files[0];
                this.pet_photo2 = e.target.files[0].name;
                this.formData2 = new FormData();
                this.formData2.append('photo', this.pet_file2);
            },
            imageLoaded2(e) {
                this.image2 = e.target.result;
            },
            async upload2(formData2) {
                try {
                    const response = await axios.post(`/api/php/photofile.php`, formData2, {
                        headers: {
                            "Content-Type": "multipart/form-data", // 設定檔頭，確保後端能正確解析 FormData
                        },
                    });
                    console.log("照片上傳成功", response.data);
                } catch (error) {
                    console.error("照片上傳失敗", error);
                }
            },

            fileSelected3(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded3);
                reader.readAsDataURL(file);

                this.pet_file3 = e.target.files[0];
                this.pet_photo3 = e.target.files[0].name;
                this.formData3 = new FormData();
                this.formData3.append('photo', this.pet_file3);

            },
            imageLoaded3(e) {
                this.image3 = e.target.result;
            },
            async upload3(formData3) {
                try {
                    const response = await axios.post(`/api/php/photofile.php`, formData3, {
                        headers: {
                            "Content-Type": "multipart/form-data", // 設定檔頭，確保後端能正確解析 FormData
                        },
                    });
                    console.log("照片上傳成功", response.data);
                } catch (error) {
                    console.error("照片上傳失敗", error);
                }
            },

            showModal() {
                this.isModalOpen = true; // 打開彈跳視窗
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
        margin:0 auto
        overflow: auto
        height:80%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        background-color: FEEABC
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
            height: max-content
            text-align: left
            background-color: #FEEABC
            border-bottom-style: solid
            display: flex
            flex-wrap: wrap
            justify-content: center
            .input
                width: 100%
                display: flex
                align-items: center
                border-bottom-style: solid
                border-color: #FFFFFF
                text-align: left
                .rdobutton_radio
                    width: 20px
                    height: 20px
                & > span
                    width: 35vw
                    height: 10vh
                    display: flex
                    justify-content: left  
                    align-items: center
                    text-align: left
                    padding-left: 10px
                    font-size: 18px
                    letter-spacing: 2px
                & > p
                    width: 80%
                    display: flex
                    text-align: justify
                    padding-top: 20px
                    padding-left: 10px 
                    font-size: 15px
                .image-upload
                    display: flex
                    width: 80%
                    display: flex
                    text-align: justify
                .inputText
                    font-size: 15px
                    width: 90px
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
                
            .end
                background-color: FEEABC
                width: 100%
                .material-symbols-outline
                    font-size: 36px
                    color: black
                    text-decoration: none
                .connect
                    text-align: left
                    font-size: 1.5em
                
                    background-color: FEEABC
                .connectinfo
                    text-align: justify
                    padding-top: 20px
                    padding-left: 10px 
                    font-size: 18px
                    
                    background-color: FEEABC
                    .connectinput
                        margin-left: 10px
                        width:66%
                        background-color: FEEABC
            .confirm_btn
                margin-top: 1rem
                line-height: 2.5rem
                border-radius: 0.4rem
                text-align: center
                font-size: 1rem
                font-weight: bold
                color: #000
                cursor: pointer
                background:#FEEABC
                width: 100px
                margin: 20px 0 20px 0
                
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

                
                
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
