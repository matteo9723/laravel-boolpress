<template>
  <main class="container">
      <h1>
          {{ post.title }}
      </h1>
      <div class="image">
          <img :src="post.cover" :alt="post.title">
      </div>
      <h3 v-if="post.category">{{ post.category.name }}</h3>
      <div class="tags">
          <span class="tag"
            v-for="(tag, index) in post.tags"
            :key="`tag${index}`"
          >{{ tag.name }}</span>
      </div>
      <p>
          {{ post.content }}
      </p>
  </main>
</template>

<script>
export default {
    name: 'PostDetail',
    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts/',
            post:{
                title:'',
                content:'',
                category:{},
                tags:[]
            }
        }
    },
    methods:{
        getApi(){
            console.log(this.apiUrl + this.$route.params.slug);
            axios.get(this.apiUrl + this.$route.params.slug)
                .then(res => {
                    this.post = res.data;
                })
        }
    },
    mounted(){
        console.log(this.$route.params.slug);
        this.getApi();
    }
}
</script>

<style lang="scss" scoped>
.container{
    margin-top: 30px;
    .image{
        width: 100%;
        img{
            width: 100%;
        }
    }
    .tags{
        margin-bottom: 30px;
        .tag{
            display: inline-block;
            margin-right: 15px;
            font-size: 12px;
            background-color: aqua;
            padding: 5px;
            border-radius: 10px;
        }
    }
}
</style>
