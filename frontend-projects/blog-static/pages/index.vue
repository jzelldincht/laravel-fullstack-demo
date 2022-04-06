<template>
  <div>
    <div class="main">
      Index Page

      <nuxt-link :to="{name:'articles-id', params: {id: 1}, query: {a: 1, b: 2}}">文章详情</nuxt-link>

      <el-button type="primary" round>主要按钮</el-button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'IndexPage'
}
</script>
