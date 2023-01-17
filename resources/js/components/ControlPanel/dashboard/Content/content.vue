<template>
    <div class="content">
        <div class="body">
            <div class="components" v-if="selectedAction != null && selectedAction != 'dashboard'">
                <div class="button">
                    <div class="question unselect" v-on:click="showCreatePage()">{{ nameArray[selectedAction] }} Ekle</div>
                </div>
                <Create v-if="IsCreateShow == true" :actionType="selectedAction" ></Create>
                <Index v-if="IsIndexShow == true"></Index>
            </div>
            <div class="dboard" v-if="selectedAction == 'dashboard'">
            </div>
        </div>
    </div>
</template>

<script>
import Create from './Topics/create.vue';
import Index from './Topics/index.vue';
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
                "manageSM": "SM",
            },
            index: 0,
        }
    },
    methods: {
        showCreatePage() {
            this.IsCreateShow = true;
            this.IsIndexShow = false;
        }
    },
    watch:  {
        selectedAction(nev, old) {
            if(nev != old) {
                this.IsCreateShow = false;
                this.IsIndexShow = true;
            }
        }
    },
    components: {
        Create, Index
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
</style>
