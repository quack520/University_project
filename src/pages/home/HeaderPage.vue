<template>
    <div class="header">
        <div class="infoleft">
            <span class="material-symbols-outlined" @click="toggleMenu">menu</span>
            <ul v-if="showMenu" class="menu">
                <router-link to="/home" style="text-decoration:none">
                    <li class="menuli"><span class="material-symbols-outlined">house</span>首頁</li>
                </router-link>
                <router-link to="/secondhand" style="text-decoration:none">
                    <li class="menuli"><span class="material-symbols-outlined">handshake</span>二手用品</li>
                </router-link>
                <router-link to="/addproduct" style="text-decoration:none">
                  <li class="menuli"><span class="material-symbols-outlined">post_add</span>二手用品刊登</li>
                </router-link>
                <router-link to="/publish" style="text-decoration:none">
                    <li class="menuli"><span class="material-symbols-outlined">file_open</span>刊登</li>
                </router-link> 
                <!-- <router-link to="/beacon" style="text-decoration:none">
                  <li class="menuli"><span class="material-symbols-outlined">tap_and_play</span>Beacon</li>
                </router-link> -->
                <!-- <router-link to="/systemrebonse">
                    <li class="menuli"><span class="material-symbols-outlined">live_help</span>問題回報</li>
                </router-link> -->
            </ul>
        </div>
        <div class="infocenter">
            <img src="@/assets/AARS.png" class="aarslogo" alt="AARSLogo">
        </div>

        <div class="inforight" >
            <router-link to="/messagelist">
                <span class="material-symbols-outlined" @click="message(me_num, chatroom_ID)">chat</span>
            </router-link>
        </div>
        <head>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        </head>
    </div>
</template>
<script>
    //呱
    import axios from 'axios'
    export default {
        name: 'HeaderHome',
        data() {
            return {
                showMenu: false,
            }
        },
        mounted() {
            this.me_num = localStorage.getItem('token');
        },
        methods: {
            async fetchData() {
                try {
                    const res = await axios.get('/api/php/messagelist.php', {
                        params: {
                            me_num: this.me_num,
                            //chatroom_ID: this.chatroom_ID,
                        }
                    });
                    //console.log(res.data);
                    this.msg = res.data.msg;
                    this.state = res.data.ok;
                     // 儲存chatroom_ID
                    this.chatroom_ID = res.data.chatroom_ID;
                } catch (error) {
                    console.error(error);
                }
            },
            toggleMenu() {
                this.showMenu = !this.showMenu;
            },
            message() {
                this.fetchData();
                this.$router.push({
                    path: '/messagelist',
                    query: {
                        me_num: this.me_num,
                        chatroom_ID: this.chatroom_ID,
                    },
                });
            }
        },
    }
</script>
<style lang="sass" scoped>
  .header
      height:60px
      background-color:#FEEABC
      display: flex 
      .infoleft
          width: 20%
          text-align: left
          display: inline-block
          cursor: pointer
          position: relative
          color: black
          .material-symbols-outlined
              font-size: 36px
              padding: 10px
              color: black
          .menu 
              list-style-type: none
              color: black
              
              height: 100%
              padding: 0
              margin: 0
              .menuli 
                  padding: 10px 
                  width: 180px
                  background-color: #FCFCFC
                  color: #000
                  
      .infocenter
          width: 60%
          text-align: center
          .aarslogo
              height: 60px

      .inforight
          width: 20%
          text-align: right
          cursor: pointer
          .material-symbols-outlined
              font-size: 36px
              padding: 10px
              color: black
          
</style>