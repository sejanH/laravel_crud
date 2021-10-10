<template>
  <div>
    <span v-for="(sub, index2) in items.sub_categories" :key="index2">
      <b-dropdown-item :to="`/category/${sub.slug}`">
        <b>&ndash;</b> {{ sub.name }}
      </b-dropdown-item>
      <span v-if="menu.sub_categories[index2].sub_categories.length > 0">
        <b-dropdown-item
          class="child"
          v-for="(sub_sub, index3) in menu.sub_categories[index2]
            .sub_categories"
          :key="index3"
          :to="`/category/${sub_sub.slug}`"
          ><b>&mdash;</b> {{ sub_sub.name }}
        </b-dropdown-item>
      </span>
    </span>
  </div>
</template>

<script>
export default {
  name: "SubMenu",
  props: ["items", "level"],
  mounted() {
      console.log(this.level);
  },
};
</script>

<style>
</style>