<template>
  <main>
    <div class="container">

      <h1>i miei post</h1>

      <div v-if="posts">
        <PostItem
          v-for="post in posts"
          :key="`post${post.id}`"
          :post="post"
        />

        <button
          @click ="getPosts(pages.current - 1)"
          :disabled="pages.current === 1"
        >prev</button>

        <button
          v-for="page in pages.last"
          :key="`page${page}`"
          @click="getPosts(page)"
          :disabled="pages.current === page"
        >
          {{page}}
        </button>

        <button
          @click ="getPosts(pages.current + 1)"
          :disabled="pages.current === pages.last"
        >next</button>
      </div>
      <div v-else>
        loading...
      </div>


    </div>
  </main>
</template>

<script>
import PostItem from './partials/PostItem.vue'
export default {
  name: 'Posts',
  components: {
    PostItem
  },
  data(){
    return{
      apiUrl:'http://127.0.0.1:8000/api/posts?page=',
      posts: null,
      pages:{}
    }
  },
  mounted(){
    this.getPosts();
  },
  methods:{
    getPosts(page = 1){
      this.posts = null;
      axios.get(this.apiUrl + page)
      .then(res =>{
        this.posts = res.data.data
        console.log(this.posts);
        this.pages = {
          current : res.data.current_page,
          last : res.data.last_page
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  main{
    padding: 30px 0;
    h1{ 
      margin-bottom: 20px;
    }
  }
</style>