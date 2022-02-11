<template>
  <div>
    <Header/>

    <Posts/>

    <Footer/>
  </div>
</template>

<script>
import Header from './components/partials/Header';
import Footer from './components/partials/Footer';
import Posts from './components/Posts';
export default {
  name:"App",
  components:{
    Header,
    Footer,
    Posts
  }
  
}
</script>

<style lang="scss">

</style>