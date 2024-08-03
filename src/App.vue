<template>
  <router-view/>
  <div></div>

</template>

<style>
  #app {
    font-family: 微軟正黑體;
    -webkit-font-smoothing: antialiased;
    font-weight: bold;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }

  nav {
    padding: 30px;
  }

  nav a {
    font-weight: bold;
    color: #2c3e50;
  }

  nav a.router-link-exact-active {
    color: #42b983;
  }
</style>
