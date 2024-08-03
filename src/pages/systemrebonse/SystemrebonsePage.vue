<template>
    <div class="header"><HeaderHome></HeaderHome></div>
    <div class="all">
        <div class="title">
            問題回報
        </div>
        <div class="body">
            <div class="table">
                <div class="t-left">
                    <p>姓名</p>
                </div>
                <div class="t-rig">
                    <p>橙汁汗的狗</p>
                </div>
            </div>
            <div class="table">
                <div class="t-left">
                    <p>Email</p>
                </div>
                <div class="t-rig">
                    <p>878787@gmail.com</p>
                </div>
            </div>
            <div class="table">
                <div class="t-left">
                    <p>手機</p>
                </div>
                <div class="t-rig">
                    <p>0987878787</p>
                </div>
            </div>
            <div class="table">
                <div class="t-left">
                    <p>主旨</p>
                </div>
                <div class="t-rig">
                    <input type="text" name="subject" value="" placeholder="例:網站無法登入" size="15">
                </div>
            </div>
            <div class="content">
                <textarea name="cont"  cols="48" rows="5" placeholder="內容回饋"></textarea>
            </div>
        </div>
        <div class="end" @click="submit">確認送出</div>
    </div>
    <div class="dock"><DockHome></DockHome></div>
</template>

<script>
    import HeaderHome from '@/pages/home/HeaderPage.vue'
    import DockHome from '@/pages/home/DockPage.vue'
    export default {
        name:'systemrebonsePage',
        components:{
            HeaderHome,
            DockHome
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
        z-index: 999
    .all
        padding: 0 0 3em 0
        background-color: #FEEABC
        height:90%
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
            background-color: #FFFFFF
            .table
                widows: 100vw
                height: 3em
                padding: 10px 10px 0px 5px
                display: flex
                border-bottom: 1px solid
                font-size: 18px
                .t-left
                    width: 15%
                    display: flex
                    justify-content: center  
                    align-items: center
                .t-rig
                    width: 85%
                    display: flex
                    justify-content: center  
                    align-items: center

                    input::-webkit-input-placeholder
                        font-size: 5vmin
                    & > p
                        font-size:  18px
            .content
                padding-top: 2em
                
        .end
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
    .dock
        height:10%
        width: 100%
        position: fixed
        top: 90%
        left: 0
        z-index: 2
</style>
