<template>
    <div>
        <div class="col-md-12" v-if="!isLoading">
            <img class="card-img-top" :src="article.image" alt="Blog Post">
            <div class="card-body px-0">
                <h3 class="card-title">{{ article.subject }}</h3>
                <p>Posted by: {{ article.user ? article.user.name : null }} | Comments: {{ article.comments ? article.comments.length : 0  }} | Views: {{ article.views }} | likes: {{ article.likes }}</p>
                <button @click="addLike" v-if="!liked" class="btn btn-success my-3">Like Article</button>
                <button @click="addLike" v-else class="btn btn-success my-3" disabled>Liked</button>
                <p class="card-text">{{ article.body }}...</p>
                <button 
                    type="button" 
                    class="btn btn-outline-secondary mx-2"
                    v-for="tag in article.tags"
                    :key="tag"
                >
                    {{ tag }}
                </button>
            </div>
            <div class="card p-3">
                <h4 class="card-title">Comments ({{ article.comments? article.comments.length : 0 }})</h4>
                <div 
                    class="card m-1 p-3"
                    v-for="comment in article.comments"
                    :key="comment.id"
                >
                    {{comment.comment}}
                    <p>Comment by: {{ comment.user ? comment.user.name : 'Not Avaliable' }}</p>
                    <p>Date Posted: {{ comment.created_at }}</p>
                </div>
            </div>
        </div>
        <div class="my-4" v-else>
            <h4 class="text-center">Loading ...</h4>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            article_id:{
                type: [Number],
                required: true
            }
        },
        data(){
            return {
                article: {},
                liked: false,
                isLoading: false
            }
        },
        methods: {
            loadComment(){
                this.isLoading = true;
                axios.get('/api/articles/'+this.article_id).then((res) => {
                    this.article = res.data.article
                    this.isLoading = false;
                }).catch(()=>{
                    alert('sorry, post cannot be displayat the moment');
                });
            },
            addLike(){
                axios.post('/api/articles/'+this.article_id+'/like').then((res) => {
                    this.article.likes = res.data.like;
                    this.liked = true;
                });
            },
            addView(){
                axios.post('/api/articles/'+this.article_id+'/views').then((res) => {
                    this.article.views = res.data.view
                });
            }
        },
        mounted() {
            this.loadComment();
            this.addView();
        }
    }
</script>
