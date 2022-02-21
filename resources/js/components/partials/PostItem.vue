<template>
  <article>
    <h3>
      <router-link :to="{name:'detail', params:{slug: post.slug}}">{{post.title}}</router-link>   
    </h3>
    <h4 v-if="post.category"> {{post.category.name}}</h4>
    <div v-if="post.tags" > 
      <span
        v-for="(tag , index) in post.tags"
        :key="`tag${index}`"
      >{{tag.name}}</span>
    </div>
    <div class="date">{{formatDate}}</div>
    <p class="text">{{post.content}}</p>
  </article>
</template>

<script>
export default {
  name:'PostItem',
  props:{
    'post': Object
  },
  computed:{
    formatDate(){
      const d = new Date(this.post.created_at);
      let day = d.getDate();
      let month = d.getMonth() + 1;
      const year = d.getFullYear();

      if(day <10) day = '0' + day;
      if(month <10) month = '0' + month;

      return `${day} / ${month} / ${year}`;
    }
  }
}
</script>

<style lang="scss" scoped>

  article{
    margin-bottom: 20px;
    .date{
      font-size: 12px;
      font-style: italic;
    }
    .text{
      padding: 10px 0;
    }
  }

</style>