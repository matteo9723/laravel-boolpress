<template>
    <article>
        <div class="img-box">
            <img :src="post.cover" :alt="post.title">
        </div>
        <div class="text-box">
            <h3>
            <router-link :to="{name: 'detail', params:{slug: post.slug}}">{{ post.title }}</router-link>
        </h3>
        <p class="date">{{ formatDate }}</p>
        <div class="category" v-if="post.category" >
            <span >{{post.category.name}}</span>
        </div>
        <div class="tag" v-if="post.tags" >
            <span v-for="(tag, index) in  post.tags"
            :key="`tag${index}`" >
                {{tag.name}}
            </span>
        </div>
        <p class="text">{{ truncateText }}</p>
        </div>
    </article>
</template>

<script>
export default {
    name: 'PostItem',
    props:{
        'post': Object
    },
    computed:{
        truncateText(){
            return this.post.content.substr(0, 50) + ' ... ';
        },
        formatDate(){

            const d = new Date(this.post.created_at);
            let day = d.getDate();
            let month = d.getMonth() + 1 ;
            const year = d.getFullYear();
            if(day < 10) day = '0'+day;
            if(month < 10) month = '0'+month;

            return `${day}/${month}/${year}`;
        }
    }
}
</script>

<style lang="scss" scoped>
    article{
        display: flex;
        margin-bottom: 20px;
        border: 1px solid gray;
        border-radius: 5px;
        height: 180px;
        width: 90%;
        .img-box{
            width: 30%;
            height: 100%;
            img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
        .text-box{
            width: 70%;
            padding: 10px;
            span{
                display: inline-block;
                padding: 2px 5px;
                margin-right: 3px;
                border-radius: 5px;
                color: white;
                font-size: 12px;
        }
            .category{
                span{
                    background-color: cadetblue;
                }
            }
            .tag{
                span{
                    background-color: yellowgreen;
                }
            }
        }
        .date{
            font-size: 12px;
            font-style: italic;
        }
        .text{
            padding: 5px 0;
        }
        a{
            color: black;
            text-decoration: none;
            &:hover{
                text-decoration: underline;
            }
        }
    }
</style>
