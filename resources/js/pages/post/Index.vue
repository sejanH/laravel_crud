<template>
  <div class="container" v-if="post">
    <div class="row">
      <div class="col-md-9 postBody">
        <div class="heading">
          <span class="sub_heading_top">
            <router-link :to="`/category/${post.category.slug}`" :title="'Go to '+ post.category.name"
              >{{post.category.name}}</router-link
            >
          </span>
          <h2>{{post.title}}</h2>
          <span class="sub_heading_bottom">
            <small>21 July, 2017</small>
            <small><a href="#" title="">by {{post.creator.name}}</a></small>
          </span>
        </div>
        <div class="content">
          <div class="cover">
            <img src="https://via.placeholder.com/1140x350" alt="" />
          </div>
          <div class="post_body" v-html="post.body"></div>
          <div class="post_body" v-html="post.body2"></div>
        </div>
      </div>
      <div class="col-md-3 sideBar">
        <div class="fixed">
          <div class="recent">recent posts</div>
          <div class="author">about the author</div>
        </div>
      </div>
    </div>
  </div>
  <div class="container" v-else>
    <loading :active="isActive"></loading>
  </div>
</template>

<script>
import "../../../sass/post.scss";
export default {
  name: "SinglePostWrapper",
  title() {
    return `${this.$route.meta.title} - `;
  },
  data(){
    return{
      post: null
    }
  },
  methods: {
    getPostBySlug(){
      const slug = this.$route.path;
      axios
        .get("/api" + slug)
        .then((result) => {
          this.post = result.data;
          document.title += result.data.title
        })
        .catch(() => {
          this.$router.push("/404");
        });
    }
  },
  created() {
    this.getPostBySlug()
  },
  computed:{
    isActive() {
      return !this.post;
    },
  }
};
</script>

<style lang="scss">
.postBody {
  min-height: 500vh;
}
.cover {
  img {
    max-width: 100%;
  }
}
.sideBar {
  min-height: 90vh;
  overflow-y: auto;
  background-color: aliceblue;
  position: relative;
  .fixed {
    position: fixed;
  }
}
</style>