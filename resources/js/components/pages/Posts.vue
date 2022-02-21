<template>
  <main>
    <div class="container">
      <div class="posts">

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

      <Sidebar
        :tags = 'tags'
        :categories = 'categories'
      />


    </div>
  </main>
</template>

<script>
import PostItem from '../partials/PostItem.vue'
import Sidebar from '../partials/Sidebar.vue'
export default {
  name: 'Posts',
  components: {
    PostItem,
    Sidebar
  },
  data(){
    return{
      apiUrl:'http://127.0.0.1:8000/api/posts?page=',
      posts: null,
      pages:{},
      tags:[],
      categories:[]
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
        this.posts = res.data.posts.data
        this.tags = res.data.tags
        this.categories = res.data.categories

        console.log(this.posts);
        this.pages = {
          current : res.data.posts.current_page,
          last : res.data.posts.last_page
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  main{
    padding: 30px 0;
    .container{
      display: flex;
      h1{ 
        margin-bottom: 20px;
      }
    }
  }
</style>