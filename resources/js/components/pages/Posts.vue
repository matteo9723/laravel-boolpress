<template>
  <main>
      <div class="container">
          <div class="post-container" v-if="success" >
                <div v-if="posts">
                <h1>{{ title }}</h1>

                <PostItem
                    v-for="post in posts"
                    :key="post.id"
                    :post="post"
                />

                <div v-if="globalPosts" class="navigation" >
                    <button
                        @click="getPosts(pagination.current - 1)"
                        :disabled = "pagination.current === 1"
                    > << </button>

                    <button
                        v-for="i in pagination.last"
                        :key="i"
                        @click="getPosts(i)"
                        :disabled = "pagination.current === i"
                    > {{ i }} </button>

                    <button
                        @click="getPosts(pagination.current + 1)"
                        :disabled = "pagination.current === pagination.last"
                    > >> </button>
                </div>
            </div>
            <div  v-else> loading ... </div>

          </div>
          <!-- /post container -->
          <div class="post-container" v-else>
              <h2>{{ error_msg }}</h2>
          </div>

          <Sidebar
            :tags="tags"
            :categories="categories"
            @getPostCategory="getPostCategory"
            @getPostTag="getPostTag"
            @getAllPosts="getPosts"
           />




      </div>
  </main>
</template>

<script>

import PostItem from '../partials/PostItem';
import Sidebar from '../partials/Sidebar'

export default {
    name: 'Posts',
    components:{
        PostItem,
        Sidebar
    },
    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts',
            posts: null,
            pagination:{},
            tags:[],
            categories:[],
            success: true,
            error_msg:'',
            title:'I miei post',
            globalPosts: true
        }
    },
    mounted(){
        this.getPosts();
    },
    methods:{
        getPostTag(slug_tag){
            this.reset();
            axios.get(this.apiUrl + '/posttag/' + slug_tag)
                .then(res => {
                    this.posts = res.data.tag.posts;
                    this.globalPosts = false;
                    this.title = "I miei post per il tag: " + res.data.tag.name;
                    if(!res.data.success){
                        this.error_msg = res.data.error;
                        this.success = false;
                    }
                })
        },
        getPostCategory(slug_category){
            this.reset();
            axios.get(this.apiUrl + '/postcategory/' + slug_category)
                .then(res => {
                    this.posts = res.data.category.posts;
                    this.globalPosts = false;
                    this.title = "I miei post per la categoria: " + res.data.category.name;
                    if(!res.data.success){
                        this.error_msg = res.data.error;
                        this.success = false;
                    }
                })
        },
        getPosts(page = 1){
            this.reset();
            axios.get(this.apiUrl + '?page=' + page )
            .then(res => {
                // devo metere data.data peché la paginazione restituisce a sua volta un oggetto data

                this.posts = res.data.posts.data;
                this.categories = res.data.categories;
                this.tags = res.data.tags;
                this.pagination = {
                    current: res.data.posts.current_page,
                    last: res.data.posts.last_page
                }
            })
        },
        reset(){
            this.error_msg = '';
            this.success = true;
            this.posts = null;
            this.title = 'I miei post';
            this.globalPosts = true;
        }
    }
}
</script>

<style lang="scss" scoped>
main{
    .container{
        display: flex;
        .post-container{
            width: 75%;
        }
    }
    padding: 30px 0;
    h1{
        margin-bottom: 20px;
    }
    margin-bottom: 50px;
    .navigation{
        button{
            cursor: pointer;
            padding: 5px;
        }
    }
}

</style>
