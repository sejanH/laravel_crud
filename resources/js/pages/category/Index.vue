<template>
  <div class="container" v-if="category">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ category.name }}</h1>
      </div>
      <div class="col-md-9">
        <div class="content"></div>
      </div>
      <div class="col-md-3">
        <aside>
          <FilterComponent></FilterComponent>
        </aside>
      </div>
    </div>
  </div>
  <div class="container" v-else>
    <loading :active="isActive"></loading>
  </div>
</template>

<script>
export default {
  name: "CategoryPage",
  title() {
    return `${this.$route.meta.title} - `;
  },
  data() {
    return {
      category: null
    };
  },
  components:{
    FilterComponent: ()=>import("./FilterComponent")
  },
  watch: {
    $route: "getCategoryBySlug",
  },
  methods: {
    getCategoryBySlug() {
      const slug = this.$route.path;
      axios
        .get("/api" + slug)
        .then((result) => {
          this.category = result.data;
          document.title += result.data.name
        })
        .catch(() => {
          this.$router.push("/404");
        });
    },
  },
  computed: {
    isActive() {
      return !this.category;
    },
  },
  created() {
    this.getCategoryBySlug();
  },
};
</script>

<style lang="scss" scoped>
.content{
  min-height: 150vh;
}
</style>