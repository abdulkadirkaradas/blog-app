<template>
    <div class="index-container">
        <div class="alignment">
            <div class="topics" v-if="actionType != 'socialmedia'">
                <div class="headers unselect">
                    <div class="section title">Görsel</div>
                    <div class="section title">Başlık</div>
                    <div class="section title">Detay</div>
                    <div class="action-title">İşlemler</div>
                </div>
                <div class="i-group" v-for="record in records" :id="record.id" :key="record.id">
                    <div class="section image">
                        <img v-if="record.images.file_url" :src="record.images.file_url">
                    </div>
                    <div class="section name">{{ record.name }}</div>
                    <div class="section detail" v-html="record.detail.detail"></div>
                    <div class="actions unselect">
                        <div class="action-section show" @click="runAction('show', record.id)">Göster</div>
                        <div class="action-section edit" @click="runAction('edit', record.id)">Düzenle</div>
                        <div class="action-section delete" @click="runAction('delete', record.id)">Sil</div>
                    </div>
                </div>
            </div>
            <div class="socialmedia" v-else>
                <div class="headers unselect">
                    <div class="section title">Başlık</div>
                    <div class="section title">Açıklama</div>
                    <div class="section title">URL</div>
                    <div class="action-title">İşlemler</div>
                </div>
                <div class="i-group" v-for="record in records" :id="record.id" :key="record.id">
                    <div class="section title">{{ record.title }}</div>
                    <div class="section detail">{{ record.description }}</div>
                    <div class="section url">{{ record.url }}</div>
                    <div class="actions unselect">
                        <div class="action-section show" @click="runAction('show', record.id)">Göster</div>
                        <div class="action-section edit" @click="runAction('edit', record.id)">Düzenle</div>
                        <div class="action-section delete" @click="runAction('delete', record.id)">Sil</div>
                    </div>
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
        this.init();
    },
    methods: {
        init() {
            var self = this;
            var type = this.actionType;
            type = type != 'socialmedia' ? type : 'sm';
            axios.get(`/admin/get-all-` + type + ``).then(function(response) {
                self.records = response.data.data;
                // console.log(self.records);
            });
        },
        runAction(type, id) {
            type = type == "show" ? "show" : (type == "edit" ? "edit" : "delete" );
            if(type != "delete") {
                let showPageStatus = type == "show" ? true : false;
                let editPageStatus = type == "edit" ? true : false;
                this.$emit("indexActionsStatus", {
                    showPageStatus: showPageStatus,
                    editPageStatus: editPageStatus,
                    type: type,
                    id: id
                });
            }
            // console.log(type, id);
        },
    },
    watch: {
        actionType(nev, old) {
            if(nev != old) {
                this.init();
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
                        width: calc(100% / 3);
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        font-size: 1.3vw;
                    }

                    & .action-title {
                        width: 15%;
                        border: 0.05vw solid black;
                        padding: 0.5vw;
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
                        font-size: 1vw;
                    }

                    & .actions {
                        border: 0.05vw solid black;
                        padding: 0.3vw;

                        & .action-section {
                            width: 10.1vw;
                            font-size: 1.45vw;
                            border: 0.05vw solid black;
                            padding: 0.3vw;
                            margin-bottom: 0.3vw;
                            cursor: pointer;
                        }
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
                        width: calc(100% / 3);
                        border: 0.05vw solid black;
                        padding: 0.5vw;
                        font-size: 1.3vw;
                    }

                    & .action-title {
                        width: 15%;
                        border: 0.05vw solid black;
                        padding: 0.5vw;
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

                    & .actions {
                        border: 0.05vw solid black;
                        padding: 0.3vw;

                        & .action-section {
                            width: 10.1vw;
                            font-size: 1.45vw;
                            border: 0.05vw solid black;
                            padding: 0.3vw;
                            margin-bottom: 0.3vw;
                            cursor: pointer;
                        }
                    }

                    // & .title {
                    // }

                    // & .detail {
                    // }

                    // & .url {
                    // }
                }
            }
        }
    }

    .unselect {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
