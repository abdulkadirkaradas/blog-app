<template>
    <div class="index-container">
        <div class="alignment">
            <div class="topics" v-if="actionType != 'socialmedia'">
                <div class="headers">
                    <div class="section title">Görsel</div>
                    <div class="section title">İsim</div>
                    <div class="section title">Detay</div>
                </div>
                <div class="i-group" v-for="record in records" :id="record.id" :key="record.id">
                    <div class="section image">
                        <img v-if="record.images.file_url" :src="record.images.file_url">
                    </div>
                    <div class="section name">{{ record.name }}</div>
                    <div class="section detail" v-html="record.detail.detail"></div>
                </div>
            </div>
            <div class="socialmedia" v-else>
                <div class="headers">
                    <div class="section title">Başlık</div>
                    <div class="section title">Açıklama</div>
                    <div class="section title">URL</div>
                </div>
                <div class="i-group" v-for="record in records" :id="record.id" :key="record.id">
                    <div class="section title">{{ record.title }}</div>
                    <div class="section detail">{{ record.description }}</div>
                    <div class="section url">{{ record.url }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        IsIndexShow: null,
        actionType: null,
    },
    data() {
        return {
            records: null,
        }
    },
    mounted() {
        this.getRecords();
    },
    methods: {
        getRecords() {
            var self = this;
            var type = this.actionType;
            type = type != 'socialmedia' ? type : 'sm';
            axios.get(`/admin/get-all-` + type + ``).then(function(response) {
                self.records = response.data.data;
                console.log(self.records);
            });
        }
    },
    watch: {
        actionType(nev, old) {
            if(nev != old) {
                this.getRecords();
            }
        }
    }
}
</script>

<style lang="scss">
    .index-container {
        width: 100%;
        height: 100%;
        display: flex;

        & .alignment {
            width: 100%;
            height: 100%;
            display: flex;

            & .topics {
                width: 100%;
                height: 100%;
                // display: flex;
                padding: 0.5vw;

                & .headers {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    margin-bottom: 0.5vw;

                    & .section {
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        width: calc(100% / 3);
                        font-size: 1.3vw;
                    }

                    & .title {

                        &:nth-child(1) {
                            width: 40%;
                        }

                        &:nth-child(2) {
                            width: 25%;
                        }

                        &:nth-child(3) {
                            width: 35%;
                        }
                    }
                }

                & .i-group {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    margin-bottom: 1vw;

                    & .section {
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        font-size: 1.3vw;
                    }

                    & .image {
                        width: 40%;

                        & img {
                            width: 100%;
                        }
                    }

                    & .name {
                        width: 25%;
                    }

                    & .detail {
                        width: 35%;
                    }
                }
            }

            & .socialmedia {
                width: 100%;
                height: 100%;

                & .headers {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    margin-bottom: 0.5vw;

                    & .section {
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        width: calc(100% / 3);
                        font-size: 1.3vw;
                    }
                }

                & .i-group {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    margin-bottom: 1vw;

                    & .section {
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        width: calc(100% / 3);
                        font-size: 1.3vw;
                    }

                    & .title {
                    }

                    & .detail {
                    }

                    & .url {
                    }
                }
            }
        }
    }
</style>
