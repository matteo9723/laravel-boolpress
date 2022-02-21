<template>
  <div class="box">
        <div>
          <h3>categorie</h3>
          <div class="category">
              <button 
                v-for="category in categories" 
                :key="`cat${category.id}`">
                {{category.name}}
              </button>
           
          </div>
        </div>
        <div>
          <h3>tag</h3>
          <div class="tag">
            <button 
                v-for="tag in tags" 
                :key="`ag${tag.id}`">
                {{tag.name}}
              </button>
          </div>
        </div>
        
      </div>
</template>

<script>
export default {
    name:'Sidebar',
    props:{
        'tags': Array,
        'categories': Array
    }

}
</script>

<style>

</style>