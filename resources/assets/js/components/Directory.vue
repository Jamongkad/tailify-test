<template>
    <div class="container">
        <div style="height:25px"></div>
        <h1 class="text-center">A glimpse in the Life</h1>
        <p class="text-center small">a lovely little photo directory by Mathew Wong</p>
        <div style="height:50px"></div>
        <div class="row">
            <div class="col-sm-6 col-md-4" v-for="photo in photos"> 
                <div class="thumbnail"> 
                    <div class="crop vertical-center">
                        <a href="/" @click.prevent="preview(photo)"><img :src="photo.basename" data-holder-rendered="true" style=''></a>
                    </div>
                    <div class="caption"> 
                        <h3>{{ photo.filename }}</h3> 
                        <p><a href="#" class="btn btn-primary" role="button" @click.prevent="preview(photo)">Preview</a> 
                           <a href="#" class="btn btn-success" role="button" @click.prevent="pastebin(photo)">Post to Pastebin</a></p> 
                    </div> 
                </div> 
            </div>
        </div>
        <modal v-if="showModal" @close="showModal = false; photoData = []; loading = true" :photodata="photoData" :loading="loading"></modal>
    </div>
</template>

<script>
    import Modal from './Modal.vue'
    export default {
        data() {
            return {
                photos: [],
                photoData: [],
                showModal: false,
                loading: true,
            }
        },
        mounted() {
            //pull photos from API
            this.$http.get('/api/photos').then((response) => {
                this.photos = response.data.images;
            }); 
        },
        components: {
            Modal
        },
        methods: {
            //Stores photo data which can be accessed by the Photopreview Component
            preview(data) {
                this.$store.commit('setphoto', data);
                this.$router.push({ path: 'photopreview' });
            }, 
            //Sends photo data to Pastebin API
            pastebin(data) { 
                this.showModal = true;

                this.$http.post('/api/pastebin', {payload: data.filename + " - " + data.filesize}).then((response) => {
                    console.log(response.data);
                    this.loading = false;
                    this.photoData = response.data;
                });

            }
        }
    }
</script>

<style scoped>
.crop {
    overflow: hidden;
    height: 300px;
}

.crop img {
    margin: -75px 0 0 0px;
    width: 100%;
}

.vertical-center {
    display: flex;
    align-items: center;
}
</style>
