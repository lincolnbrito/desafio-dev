<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Início</router-link>
      <router-link to="/import">Importar</router-link>
      <router-link to="/about">Sobre</router-link>
    </div>
    <router-view/>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

</style>
