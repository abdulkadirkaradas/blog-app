<template>
    <div class="content">
        <div class="body">
            <div class="components" v-if="selectedAction != null && selectedAction != 'dashboard'">
                <div class="button">
                    <div class="question unselect" v-on:click="showCreatePage()">{{ selectedAction }} Ekle</div>
                </div>
                <Create v-if="IsCreateShow == true"></Create>
                <Index v-if="IsIndexShow == true"></Index>
            </div>
            <div class="dboard" v-if="selectedAction == 'dashboard'">
            </div>
        </div>
    </div>
</template>

<script>
import Create from './Designs/create.vue';
import Index from './Designs/index.vue';
export default {
    data () {
        return {
            IsCreateShow: false,
            IsIndexShow: true,
        }
    },
    props: {
        selectedAction: null,
    },
    methods: {
        showCreatePage() {
            this.IsCreateShow = true;
            this.IsIndexShow = false;

            console.log(this.IsCreateShow, this.IsIndexShow);
        }
    },
    components: {
        Create, Index
    }
}
</script>

<style lang="scss">
    .content {
        background: #f2f2f2;
        overflow: hidden;
        border-radius: 1vw;
        box-shadow: 0 0 0.25vw #d0d0d0;

        & .body {
            text-align: justify;
            color: black;
            padding: 1.2vw;

            & .components {

                & .button {
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
