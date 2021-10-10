<template>
  <div class="row">
    <div class="col-md-9 postBody">
      <div class="heading">
        <span class="sub_heading_top">
          <router-link to="/category/blog-category-01" title=""
            >Gardening</router-link
          >
        </span>
        <h2>POST TITLE</h2>
        <span class="sub_heading_bottom">
          <small>21 July, 2017</small>
          <small><a href="#" title="">by Amanda</a></small>
        </span>
      </div>
      <div class="content">
        <div class="cover">
          <img src="https://via.placeholder.com/1140x350" alt="" />
        </div>
      </div>
    </div>
    <div class="col-md-3 sideBar">
      <div class="fixed">
        <div class="recent">
          recent posts
        </div>
        <div class="author">
          about the author
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SinglePost",
};
</script>
