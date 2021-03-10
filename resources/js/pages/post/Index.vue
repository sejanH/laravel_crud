<template>
  <div class="container">
    <router-view></router-view>
  </div>
</template>

<script>
import "../../../sass/post.scss";
export default {
  name: "SinglePostWrapper",
  title() {
    return this.$route.meta.title;
  },
};
</script>

<style lang="scss">
</style>