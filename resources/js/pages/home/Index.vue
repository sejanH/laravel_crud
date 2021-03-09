<template>
  <div class="container">
      <Intro></Intro>
      <Intro></Intro>
  </div>
</template>

<script>
export default {
    name:"HomePage",
    components:{
      Intro: ()=>import("./SectionIntro")
    }

}
</script>

<style>

</style>