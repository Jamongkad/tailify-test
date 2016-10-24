<template>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <router-link to="/"> 
                    Back 
                </router-link>
                <h3>{{ photodata.filename }}</h3>
                <img :src="photodata.basename" class="img-responsive img-thumbnail" data-holder-rendered="true" style=''>
            </div>
            <div class="text-center">
                <router-link to="/">
                    Back
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        computed: {
            photodata() {
                return this.$store.state.photodata;
            }
        },
        mounted() {
        },
        components: { },
        methods: {

        }
    }
</script>

<style scoped>
.img-responsive {
    margin: 0 auto;
}
</style>
