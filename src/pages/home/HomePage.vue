<template>
  <div class="header"><HeaderHome></HeaderHome></div>
  <div class="home">
    <div class="carousel">
      <div class="slider_container">
        <div class="div_img">
          <img class="img" src="@/assets/pet1.png" alt="pure css3 slider" />
        </div>
        <div class="div_img">
          <img class="img" src="@/assets/pet2.png" alt="pure css3 slider" />
        </div>
        <div class="div_img">
          <img class="img" src="@/assets/pet3.png" alt="pure css3 slider" />
        </div>
        <div class="div_img">
          <img class="img" src="@/assets/pet4.png" alt="pure css3 slider" />
        </div>
        <div class="div_img">
          <img class="img" src="@/assets/pet5.png" alt="pure css3 slider" />
        </div>
      </div>

    </div>
    <div class="bottom">
      <p class="title">最新消息!!</p>
      <p class="info">AARS 領養平台 已正式上線 歡迎大家來使用~</p>
      <p class="info" style="color: crimson;">申請帳號獲得300點數、領養動物獲得200點、回報領養狀況獲得100點、六次成功回報獲得點數200點 點數可於二手用品頁面使用</p>
      <p class="title">寵物小知識!!</p>
      <p class="info">領養代替購買、守護一生不棄養、給浪浪們一個家。 </p>
      <p class="info">公立收容所也有許多浪浪們等待大家領養唷～ </p>
      <p class="info">觀察寵物的耳朵、尾巴、姿勢和表情，可以幫助您理解它們的情感和需求。 </p>
      <p class="info">狗通常需要更多的運動和社交互動，而貓則更獨立一些，但也需要關注其健康和情感需求。</p>
      <p class="info">選擇高質量的寵物食物，應滿足其營養需求，避免過多添加人類食物。</p>
      <p class="info">旅行、搬家或家庭變動可能對寵物造成壓力，飼主需提前計劃，為寵物緩解這些變化帶來的不適。</p>
      <br>
    </div>
    <div class="dock">
      <DockHome></DockHome>
    </div>
  </div>
</template>

<script>
  import HeaderHome from '@/pages/home/HeaderPage.vue'
  import DockHome from '@/pages/home/DockPage.vue'
  export default {
    name:'HomePage',
    components:{
        HeaderHome,
        DockHome
    },
  }
</script>

<style lang="sass" scoped>
  .header
      height: 10%
      width: 100%
      position: fixed
      top: 0
      left: 0
      overflow: visible
      z-index: 999
  .home
    background-color: #FEEABC
    height:80%
    width: 100%
    position: fixed
    top: 10%
    left: 0
    z-index: 1
    
    .carousel
      .slider_container
        margin: 30px auto
        width: 80vw
        height: 20vh
        position: relative
        border-bottom-width: 100px
        background-color: #f5f5f5
        box-shadow: #666 0 0 5px
        overflow: hidden

        .div_img
          position: absolute
          top: 0
          left: 0
          opacity: 0
          filter: alpha(opacity=0)

          .img
            width: 80vw
            height: 20vh
            justify-content: center  
            text-align: center
            align-items: center
            object-fit: cover
            object-position: center

        .div_img
          -webkit-animation: round 25s linear infinite
          animation: round 25s linear infinite

        @-webkit-keyframes round
          4%
            opacity: 1
            filter: alpha(opacity=100)
            /* 0 - 1秒 淡入*/
          20%
            opacity: 1
            filter: alpha(opacity=100)
            /* 1- 5秒静止*/
          24%
            opacity: 0
            filter: alpha(opacity=0)
            /* 5-6秒淡出*/

        @keyframes round
          4%
            opacity: 1
            filter: alpha(opacity=100)
            /* 0 - 1秒 淡入*/
          20%
            opacity: 1
            filter: alpha(opacity=100)
            /* 1- 5秒静止*/
          24%
            opacity: 0
            filter: alpha(opacity=0)
            /* 5-6秒淡出*/

        div:nth-child(5)
          -webkit-animation-delay: 0s
          animation-delay: 0s

        div:nth-child(4)
          -webkit-animation-delay: 5s
          animation-delay: 5s

        div:nth-child(3)
          -webkit-animation-delay: 10s
          animation-delay: 10s

        div:nth-child(2)
          -webkit-animation-delay: 15s
          animation-delay: 15s

        div:nth-child(1)
          -webkit-animation-delay: 20s
          animation-delay: 20s

    .bottom
      position: relative
      width: 100%
      top:0
      left:0
      border-radius: 40px 40px 40px 40px
      background-color: #FFFFFF
      padding: 40px 30px 240px 20px
      margin-top: 20px
      overflow: auto
      max-height: calc(100% - 120px)
      .title
        font-size: 20px
        color: orange
      .info
        // text-decoration: underline
    .dock
      height:10%
      width: 100%
      position: fixed
      top: 90%
      left: 0
</style>
