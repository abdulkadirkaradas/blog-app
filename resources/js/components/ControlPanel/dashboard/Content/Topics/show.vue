<template>
    <div class="content-showing-container">
        <div class="inner-showing-div">
            <div class="section title">{{ topic.name }}</div>
            <div class="section image">
                <img :src="image.file_url">
            </div>
            <div class="section detail" v-html="detail.detail"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: null,
        currentPage: null
    },
    data() {
        return {
            topic: '',
            detail: '',
            image: '',
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        init() {
            let self = this;
            let cPage = this.currentPage.slice(0, -1);
            axios.get(`/admin/find-` + cPage + `/` + self.id + ``).then(function(response) {
                // console.log(response.data.data);
                self.topic = "design" in response.data.data ? response.data.data.design : ("bag" in response.data.data ? response.data.data.bag : response.data.data.blog);
                self.detail = response.data.data.detail[0];
                self.image = response.data.data.images[0];
            });

            this.$emit("backButtonStatus", true);
        }
    },
}
</script>

<style lang="scss">
    .content-showing-container {

        & .inner-showing-div {
            border-left: 0.05vw solid black;
            border-right: 0.05vw solid black;
            border-radius: 0.7vw;
            padding: 1vw;

            & .section {
                padding: 1vw;
                margin-bottom: 0.5vw;
                border-radius: 0.5vw;
                border-bottom: 0.05vw solid black;
                border-top: 0.05vw solid black;
            }

            & .title {
                text-align: center;
            }

            & .image {
                border-bottom: 0.05vw solid black;
                justify-content: center;
                align-items: center;
                display: flex;

                & img {
                    max-height: 25vw;
                    background-position: center;
                    background-size: contain;
                    background-repeat: no-repeat;
                    border: 0.05vw solid #a3a1a1;
                }
            }

            // & .detail {
            // }
        }
    }
</style>
