<template>
    <div class="header">
        <div class="infoleft">
            <span class="material-symbols-outlined" @click="back">chevron_left</span>
        </div>
        <div class="infocenter">
            新增商品
        </div>
        <div class="inforight">
            <div class="submit" @click="showModal">送出</div>
        </div>
    </div>
    <div class="addproduct">
        <div class="add">
            <div class="addtitle">新增照片</div>
            <div class="addpicture">
                <div class="picture">
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
                            <img v-if="image" :src="image" width="120" height="120"/> 
                        </div>
                    </div>
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
        </div>
        <div class="productinfo">
        <div class="info">
            <p class="infotitle">商品名稱</p>
            <q-input class="infoinput" color="yellow" v-model="good_name" >
                <template v-slot:prepend>

                </template>
            </q-input>
        </div>
        <div class="info">
            <p class="infotitle">商品數量</p>
            <q-input class="infoinput" color="yellow" v-model="good_amount" >
                <template v-slot:prepend>
            
                </template>
            </q-input>
        </div>
        <div class="info">
            <p class="infotitle">點數<span class="material-symbols-outlined">savings</span></p>
            <q-input class="infoinput" color="yellow" v-model="good_point" >
                <template v-slot:prepend>
            
                </template>

            </q-input>
        </div>
        <div class="info">
            <p class="infotitle">所在位置</p>
            <q-input class="infoinput" color="yellow" v-model="good_area" >
                <template v-slot:prepend>
                
                </template>
            </q-input>
        </div>
        <div class="info">
            <p class="infotitle">類別</p>
            <q-input class="infoinput" color="yellow" v-model="good_type" >
                <template v-slot:prepend>
                
                </template>
            </q-input>
        </div>
        <div class="info">
            <p class="infotitle">商品產地</p>
            <q-input class="infoinput" color="yellow" v-model="good_place" >
                <template v-slot:prepend>
                
                </template>
            </q-input>
        </div>
        <div class="infoproduct">
            <p class="productinfotitle">商品資訊</p>
            <textarea class="productinfoinput" v-model="good_detail" name="cont"  cols="48" rows="6" placeholder="請輸入商品資訊"></textarea>
        </div>     
    </div> 
        <div v-if="isModalOpen" class="modal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <div class="modal_title">刊登條款</div>
                <div class="modal_body">
                    刊登人使用由AARS寵物資訊平台(以下簡稱「AARS」)所提供之送養資訊刊登服務(以下簡稱「本服務」)時，均受到本「刊登條款」規範。
                    1.AARS要求所有刊登商品資訊及查看商品資訊者均須加入會員，是為了保證所有查看資訊的人都確實的留下紀錄。 
                    2.AARS 僅為資訊交流平台，無法保證刊登內容之正確性，刊登人對其刊登內容應負完全之責任，刊登人應提供確實之刊登內容，並自負相關法律責任。
                    3.AARS 對刊登資訊保有最終篩選、修改、刪除及決定刊登與否之權利。
                    4.AARS 秉持信用及誠實之精神，禁止以下類型之刊登內容：
                        a.捏造不實資訊。
                        b.特意收集個人資料。
                        c.寵物用具以外之商品。
                    如有違反上述條款之情事，AARS可能將其進行會員停權或封鎖之處置。
                    5.刊登人應確定刊登之內容未使用未經授權之文字、圖片、影音或任何形式之資訊。
                    6.刊登人同意授權於本服務刊登之資訊內容無償提供第三人分享、轉載或推廣。
                </div>
                <q-checkbox 
                    v-model="orange" 
                    label="我以詳閱且同意本刊登條款" 
                    color="orange" 
                    true-value="yes"
                    false-value="no" />
                <q-btn class="modalconfirm_btn" label="確定" @click="confirm"></q-btn>
            </div>
        </div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    //湯
    import DockHome from '@/pages/home/DockPage.vue'
    import axios from 'axios'
    //import { ref } from 'vue'
    export default{
        name:'AddproductPage',
        components:{
            DockHome
        },
        data () {
            return {
                AddproductPage: true,
                me_num:'',
                good_name:'',
                good_amount:'',
                good_point:'',
                good_area:'',
                good_type:'',
                good_place:'',
                good_detail:'',

                good_photo1:'',
                good_file1: null,
                formData1:null,
                good_photo2:'',
                good_file2: null,
                formData2:null,
                good_photo3:'',
                good_file3: null,
                formData3:null,

                msg:'',
                image: '',
                image2: '',
                image3: '',
                dataURL: null,
                state: false,
                track: null,
                alert: false,
                isModalOpen: false,
                //orange: ref(false),
                orange: 'no',
                // imageUrl: false,
                // imageUrl2: false,
                // imageUrl3: false,
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
                        .get('/api/php/addproduct.php', {
                            params:{
                                me_num: this.me_num,
                                good_name: this.good_name,
                                good_amount: this.good_amount,
                                good_point: this.good_point,
                                good_area: this.good_area,
                                good_type: this.good_type,
                                good_place: this.good_place,
                                good_detail: this.good_detail,
                                good_photo1: this.good_photo1,
                                good_photo2: this.good_photo2,
                                good_photo3: this.good_photo3,
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
            back()
            {
                //this.$router.go(-1)
                this.$router.push({
                    path: '/secondhand',
                    query: {
                        me_num: this.me_num,
                    },
                });
            },
            fileSelected(e) {
                const file = e.target.files.item(0);
                const reader = new FileReader();
                reader.addEventListener('load', this.imageLoaded);
                reader.readAsDataURL(file);

                this.good_file1 = e.target.files[0];
                this.good_photo1 = e.target.files[0].name;
                this.formData1 = new FormData();
                this.formData1.append('photo', this.good_file1);
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

                this.good_file2 = e.target.files[0];
                this.good_photo2 = e.target.files[0].name;
                this.formData2 = new FormData();
                this.formData2.append('photo', this.good_file2);
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

                this.good_file3 = e.target.files[0];
                this.good_photo3 = e.target.files[0].name;
                this.formData3 = new FormData();
                this.formData3.append('photo', this.good_file3);

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
                this.isModalOpen = true;
            },
            closeModal() {
                this.isModalOpen = false; // 關閉彈跳視窗
            },
        },
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
        .inforight
            width: 33%
            text-align: right
            .submit
                margin: 0 auto
                margin-top: 1rem
                width: 60px
                line-height: 1.8rem
                background-color: #FFFFFF
                border-radius: 0.4rem
                text-align: center
                font-size: 0.75rem
                font-weight: bold
                color: #000
                cursor: pointer
    .addproduct
        background-color: #FFFFFF
        height:90%
        width: 100%
        position: fixed
        top: 10%
        left: 0
        overflow: auto
        display: flex
        flex-wrap: wrap
        
        
        .add
            width: 100%
            height: 27%
            border-bottom: solid
            border-color: #000
            .addtitle
                margin-top: 10px
                margin-left: 10px
                font-size: 18px
                font-weight: bold
                text-align: left
            .addpicture
                display: flex
                width: 100%
                align-items: center
                .picture
                    width: 33%
                    height: 100px
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
        .productinfo
            width: 100%
            height: 75%
            .info
                display: flex
                flex-wrap: wrap
                height: 60px
                border-bottom: solid
                border-color: #000 
                .infotitle
                    width: 25%
                    font-size: 18px
                    font-weight: bold
                    text-align: left
                    padding-top: 15px
                    padding-left: 10px
                .infoinput
                    width: 75%
                    height:40px
            .infoproduct
                .productinfotitle
                    font-size: 18px
                    font-weight: bold
                    text-align: left
                    padding-top: 5px
                    padding-left: 10px
                .productinfoinput
                    margin: 5px
                    overflow: auto
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

            /* 關閉按鈕 */
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
</style>
