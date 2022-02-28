<template>
        <div class="sidebar">
              <div class="box">
                  <h3>Categorie</h3>
                  <div class="category">
                      <span
                        v-for="category in categories"
                        :key="`cat${category.id}`"
                        @click="$emit('getPostCategory', category.slug)"
                      >{{ category.name }}</span>

                  </div>
              </div>
              <div class="box">
                  <h3>Tag</h3>
                    <div class="tag">
                        <span
                            v-for="tag in tags"
                            :key="`tag${tag.id}`"
                            @click="$emit('getPostTag', tag.slug)"
                        >{{ tag.name }}</span>
                    </div>
              </div>

                <button
                    @click="$emit('getAllPosts')"
                >Tutti i post</button>

          </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props:{
        'tags': Array,
        'categories':Array
    }
}
</script>

<style lang="scss" scoped>
.sidebar{
    width: 25%;
    button{
        border-radius: 6px;
        border: none;
        padding: 6px;
        cursor: pointer;
        color: red;
    }
    .box{
        border: 2px solid grey;
        border-radius: 10px;
        padding: 30px 15px;
        margin-bottom: 20px;
        h3{
            margin-bottom: 15px;
        }
        span{
            display: inline-block;
            padding: 2px 5px;
            margin: 3px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .category{
            span{
                background-color: cadetblue;
                &:hover{
                    background-color: rgb(156, 212, 214);
                }
            }
        }
        .tag{
            span{
                background-color: yellowgreen;
                &:hover{
                    background-color: rgb(189, 238, 92);
                }
            }
        }

    }
}

</style>
