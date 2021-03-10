<template>
  <div class="container">
      <Intro></Intro>
      <CategorySlider></CategorySlider>
      <Intro></Intro>
  </div>
</template>

<script>
export default {
    name:"HomePage",
    title(){
      return "Blog";
    },
    components:{
      Intro: ()=>import("./SectionIntro"),
      CategorySlider: ()=>import("./CategorySlider"),
    }

}
</script>

<style>

</style>