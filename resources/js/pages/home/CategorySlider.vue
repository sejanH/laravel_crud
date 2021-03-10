<template>
  <section class="category_section">
    <div class="heading">
      <h4><router-link to="/category/slug">Category A</router-link></h4>
    </div>
    <carousel v-bind="settings">
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
      <slide>
        <div class="section_single">
          <div class="section_body">
            <div class="thumb">
              <img src="/media/dummy.jpeg" alt="" class="img-fluid" />
            </div>
            <div class="description">
              <div class="content">
                <span class="category">
                  <a href="blog-category-01.html" title="">Gardening</a>
                </span>
                <h4 class="title">
                  <a href="garden-single.html" title=""
                    >How to choose high quality soil for your gardens</a
                  >
                </h4>
                <small>21 July, 2017</small>
                <small><a href="#" title="">by Amanda</a></small>
              </div>
            </div>
          </div>
        </div>
      </slide>
    </carousel>
  </section>
</template>

<script>
export default {
  name: "CategorySlider",
  data() {
    return {
      settings: {
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        perPage: 1,
        perPageCustom: [
          [992, 4],
          [768, 3],
          [576, 2],
        ],
        navigationEnabled: true,
        paginationActiveColor:"#00a86b",
        paginationColor:"#79b99c"
      },
    };
  },
  computed: {},
};
</script>

<style lang="scss">
.VueCarousel-navigation{
    position: absolute;
    right: 30px;
    top: -20px;
}
</style>