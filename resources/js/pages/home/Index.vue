<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <loading :active="isActive"></loading>
        <Intro></Intro>
        <CategorySlider></CategorySlider>
        <Intro></Intro>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomePage",
  title() {
    return "Blog";
  },
  data() {
    return {
      // isActive: true,
    };
  },
  components: {
    Intro: () => import("./SectionIntro"),
    CategorySlider: () => import("./CategorySlider"),
  },
  computed: {
    isActive() {
      return false;
    },
  },
};
</script>

<style>
</style>