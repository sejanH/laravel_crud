<template>
  <b-navbar toggleable="lg" type="light" variant="white" sticky>
    <div class="container">
      <b-navbar-brand
        href="/"
        v-if="$route.name == 'Login' || $route.name == 'Regsiter'"
        >{{ state.appName }}</b-navbar-brand
      >
      <b-navbar-brand to="/" v-else>{{ state.appName }}</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav v-if="showMenu">
          <b-nav-item-dropdown lazy>
            <template #button-content>
              <b>Categories</b>
            </template>
            <b-nav-item
              v-for="(menu, index) in state.menu"
              :key="index"
              @mouseenter="onOver"
              @click="clicked"
              :to="`/category/${menu.slug}`"
              :data-index="index"
            >
              &#8226; {{ menu.name }}
              <b-icon-arrow-right-short
                v-if="menu.sub_categories.length > 0"
                font-scale="0.85"
              ></b-icon-arrow-right-short>
              <div class="sub" ref="subMenu">
                <b-nav-item
                  v-for="(sub, index2) in selectedSubCategory"
                  @mouseenter="onOver2"
                  :key="index2"
                  :data-index="index2"
                  :to="`/category/${sub.slug}`"
                >
                  &#8226; {{ sub.name }}
                  <div class="last" ref="subMenu2">
                    <b-nav-item
                      v-for="(sub2, index3) in selectedSub2Category"
                      :key="index3"
                      :to="`/category/${sub2.slug}`"
                    >
                      &#8226; {{ sub2.name }}
                    </b-nav-item>
                  </div>
                </b-nav-item>
              </div>
            </b-nav-item>
            <!-- </b-dropdown-item> -->
          </b-nav-item-dropdown>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form>
            <b-form-input
              size="sm"
              class="mr-sm-2"
              placeholder="Search"
            ></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit"
              >Search</b-button
            >
          </b-nav-form>
          <b-nav-item-dropdown right>
            <!-- Using 'button-content' slot -->
            <template #button-content>
              <em v-if="state.user">{{ state.user.name }}</em>
              <em v-else>User</em>
            </template>
            <b-dropdown-item v-if="state.user" href="#"
              >Profile</b-dropdown-item
            >
            <b-dropdown-item v-if="state.role === 'Admin'" href="/dashboard"
              >Dashboard</b-dropdown-item
            >
            <b-dropdown-item v-if="state.user" href="/new"
              >New Post</b-dropdown-item
            >
            <b-dropdown-item v-if="state.user" href="#" @click="postLogout"
              >Sign Out</b-dropdown-item
            >
            <b-dropdown-item v-if="!state.user" href="/login"
              >Sign In</b-dropdown-item
            >
            <b-dropdown-item v-if="!state.user" href="/register"
              >Sign Up</b-dropdown-item
            >
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </div>
  </b-navbar>
</template>

<script>
import { BIconArrowRightShort } from "bootstrap-vue";
export default {
  name: "Header",
  data() {
    return {
      state: this.$parent.state,
      show: false,
      showMobile: false,
      menuIndex: -1,
      subMenuIndex: -1,
      selectedSubCategory: null,
      selectedSub2Category: null,
    };
  },
  watch: {
    menuIndex(val) {
      this.menuIndex = parseInt(val);
    },
    selectedSubCategory(val) {
      this.selectedSubCategory = val;
    },
    subMenuIndex(val) {
      this.subMenuIndex = parseInt(val);
    },
    selectedSub2Category(val) {
      this.selectedSub2Category = val;
    },
  },
  components: {
    BIconArrowRightShort,
  },
  methods: {
    postLogout() {
      axios.post("/logout").then(() => {
        window.location.reload();
      });
    },
    makeSubMenu(index) {
      if (typeof index != "undefined") {
        if (index == -1) {
          this.selectedSubCategory = null;
        } else {
          this.selectedSubCategory = this.state.menu[index].sub_categories;
        }
      }
      return;
    },
    makeSubMenu2(index) {
      if (typeof index != "undefined") {
        if (index == -1) {
          this.selectedSub2Category = null;
        } else {
          this.selectedSub2Category =
            this.state.menu[this.menuIndex].sub_categories[
              index
            ].sub_categories;
        }
      }
      return;
    },
    clicked(e) {
      console.log(e.target);
    },
    onOver(e) {
      this.menuIndex = e.target.parentNode.dataset.index;
      if (
        typeof e.target.parentNode.dataset.index != "undefined" &&
        typeof this.menuIndex != "NaN"
      ) {
        // console.log(this.$refs["subMenu"][e.target.parentNode.dataset.index].getBoundingClientRect());
        // console.log(this.$refs["subMenu"][e.target.parentNode.dataset.index].getBoundingClientRect().top - e.target.parentNode.parentNode.getBoundingClientRect().top);
        this.makeSubMenu(e.target.parentNode.dataset.index);
        // this.$refs["subMenu"][e.target.parentNode.dataset.index].style.height =
        //   e.target.parentNode.parentNode.clientHeight + "px";
        // this.$refs["subMenu"][e.target.parentNode.dataset.index].style.top =
        //   -(this.$refs["subMenu"][e.target.parentNode.dataset.index].getBoundingClientRect().top - e.target.parentNode.parentNode.getBoundingClientRect().top) + "px";
        // this.$refs["subMenu"].classList.add("show");
      }
    },
    onOver2(e) {
      this.subMenuIndex = e.target.parentNode.dataset.index;
      if (
        typeof e.target.parentNode.dataset.index != "undefined" &&
        typeof this.subMenuIndex != "NaN"
      ) {
        this.makeSubMenu2(e.target.parentNode.dataset.index);
        // this.$refs["subMenu2"].style.height =
        //   e.target.parentNode.parentNode.clientHeight + "px";
        // this.$refs["subMenu2"].classList.add("show");
      }
    },
  },
  computed: {
    showMenu() {
      if (this.$route.name == "Login") {
        return false;
      } else if (this.$route.name == "Regsiter") {
        return false;
      }
      return true;
    },
  },
  mounted() {
    // document.addEventListener("click", (e) => {
    //   if (e.target.id !== "profileImage") {
    //     this.show = false;
    //   }
    // });
  },
};
</script>