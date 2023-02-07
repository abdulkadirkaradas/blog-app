<template>
    <div class="content">
        <div class="body">
            <div class="components" v-if="selectedAction != null && selectedAction != 'dashboard'">
                <div class="button" :class="IsButtonGroupEnable != true ? 'hide' : ''">
                    <div class="section create-button unselect" v-if="IsBackButtonEnable == false" v-on:click="showCreatePage()">{{ nameArray[selectedAction] }} Ekle</div>
                    <div class="section back-button unselect" v-else @click="onClickBackButton()">Geri Dön</div>
                </div>
                <Create v-if="IsCreateShow != false" :actionType="selectedAction"></Create>
                <Index v-if="IsIndexShow != false" :IsIndexShow="IsIndexShow" :actionType="selectedAction" @indexActionsStatus="indexActionsStatus"></Index>
                <Show v-if="IsShowPageActive != false" :id="indexActionId" :currentPage="selectedAction" @backButtonStatus="backButtonStatus"></Show>
                <Edit v-if="IsEditPageActive != false" :id="indexActionId" :currentPage="selectedAction"></Edit>
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
            IsButtonGroupEnable: true,
            IsBackButtonEnable: false,
            IsCreateShow: false,
            IsIndexShow: true,
            indexActionId: null,
            IsShowPageActive: false,
            IsEditPageActive: false,
            nameArray: {
                "designs": "Tasarım",
                "bags": "Çanta",
                "blogs": "Blog",
                "socialmedia": "Sosyal M.",
            },
        }
    },
    mounted() {

    },
    methods: {
        showCreatePage() {
            this.IsCreateShow = true;
            this.IsIndexShow = false;
            this.IsButtonGroupEnable = false;
        },
        indexActionsStatus({showPageStatus, editPageStatus,type, id}) {
            this.IsShowPageActive = showPageStatus;
            this.IsEditPageActive = editPageStatus;
            // this.indexActionType = type;
            this.indexActionId = id;
        },
        backButtonStatus(val) {
            this.IsBackButtonEnable = val;
        },
        onClickBackButton() {
            this.IsIndexShow = true;
            this.IsShowPageActive = false;
            this.IsEditPageActive = false;
            this.IsBackButtonEnable = false;
        }
    },
    watch:  {
        selectedAction(nev, old) {
            if(nev != old) {
                this.IsCreateShow = false;
                this.IsIndexShow = true;
                this.IsButtonGroupEnable = true;
                this.IsShowPageActive = false;
                this.IsEditPageActive = false;
            }
        },
        IsShowPageActive(nev, old) {
            if((nev == true)) {
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

                    & .section {
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
