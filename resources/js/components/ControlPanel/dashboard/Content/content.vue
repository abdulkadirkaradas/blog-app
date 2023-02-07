<template>
    <div class="content">
        <div class="body">
            <div class="components" v-if="selectedAction != null && selectedAction != 'dashboard'">
                <div class="button" :class="IsButtonShow != true ? 'hide' : ''">
                    <div class="question unselect" v-on:click="showCreatePage()">{{ nameArray[selectedAction] }} Ekle</div>
                </div>
                <Create v-if="IsCreateShow == true" :actionType="selectedAction"></Create>
                <Index v-if="IsIndexShow == true" :IsIndexShow="IsIndexShow" :actionType="selectedAction" @indexActionsStatus="indexActionsStatus"></Index>
                <Show v-if="IsShowPageActive != false && IsShowPageActive != null" :id="indexActionId" :currentPage="selectedAction"></Show>
                <Edit v-if="IsEditPageActive != false && IsEditPageActive != null" :id="indexActionId" :currentPage="selectedAction"></Edit>
            </div>
            <div class="dboard" v-if="selectedAction == 'dashboard'">
            </div>
        </div>
    </div>
</template>

<script>
import Create from './Topics/create.vue';
import Index from './Topics/index.vue';
import Show from './Topics/show.vue';
import Edit from './Topics/edit.vue';
export default {
    props: {
        selectedAction: null,
    },
    data () {
        return {
            IsCreateShow: false,
            IsIndexShow: true,
            nameArray: {
                "designs": "Tasarım",
                "bags": "Çanta",
                "blogs": "Blog",
                "socialmedia": "Sosyal M.",
            },
            IsButtonShow: true,
            // indexActionType: null,
            indexActionId: null,
            IsShowPageActive: null,
            IsEditPageActive: null,
        }
    },
    mounted() {

    },
    methods: {
        showCreatePage() {
            this.IsCreateShow = true;
            this.IsIndexShow = false;
            this.IsButtonShow = false;
        },
        indexActionsStatus({showPageStatus, editPageStatus,type, id}) {
            this.IsShowPageActive = showPageStatus;
            this.IsEditPageActive = editPageStatus;
            // this.indexActionType = type;
            this.indexActionId = id;
        }
    },
    watch:  {
        selectedAction(nev, old) {
            if(nev != old) {
                this.IsCreateShow = false;
                this.IsIndexShow = true;
                this.IsButtonShow = true;
                this.IsShowPageActive = false;
                this.IsEditPageActive = false;
            }
        },
        IsShowPageActive(nev, old) {
            if((nev == true) || (old == true)) {
                this.IsIndexShow = false;
            } else {
                this.IsIndexShow = true;
            }
        }
    },
    components: {
        Create, Index, Show, Edit
    }
}
</script>

<style lang="scss">
    .content {
        padding: 0.5vw;
        background-color: #fff;
        background-clip: border-box;
        border: 0.1vw solid rgba(0, 0, 0, 0.1254901961);
        border-radius: 0.7vw;
        overflow: hidden;

        & .body {
            text-align: justify;
            color: black;
            padding: 1.2vw;

            display: flex;
            flex-direction: column;

            & .components {

                & .button {
                    margin-bottom: 1vw;
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    border-bottom: 0.05vw solid black;
                    padding-bottom: 0.5vw;

                    & .question {
                        width: 10vw;
                        height: 2.5vw;
                        font-size: 1.3vw;
                        cursor: pointer;

                        background-color: #00000005;
                        border: 0.1vw solid #00000020;
                        border-radius: 0.7vw;

                        justify-content: center;
                        align-items: center;
                        display: flex;
                    }
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

    .hide {
        display: none !important;
    }
</style>
