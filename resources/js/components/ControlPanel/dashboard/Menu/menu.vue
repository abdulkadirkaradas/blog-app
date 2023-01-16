<template>
    <div class="menu-content">
        <div class="item-header unselect">Tasarımlarım</div>
        <div class="item unselect" @click="getAction('designs')">Tasarım İşlemleri</div>
        <div class="item-header unselect">Çantalarım</div>
        <div class="item unselect" @click="getAction('bags')">Çanta İşlemleri</div>
        <div class="item-header unselect">Bloglarım</div>
        <div class="item unselect" @click="getAction('blogs')">Blog İşlemleri</div>
        <div class="item-header unselect">Sosyal Medya</div>
        <div class="item unselect" @click="getAction('manageSM')">SM Yönetimi</div>
        <div class="item-header dashboard unselect" @click="getAction('dashboard')">Dashboard</div>
    </div>
</template>

<script>
export default {
    data () {
        return {
        }
    },
    methods: {
        getAction(name) {
            this.$emit("action", name);
        }
    },
}
</script>

<style lang="scss">
    $phone_size: 900px;

    .menu-content {
        width: 100%;
        height: 100%;
        padding: 0.5vw;
        background-color: #fff;
        background-clip: border-box;
        border: 0.1vw solid #00000020;
        border-radius: 0.7vw;

        & .item-header {
            text-align: center;
            font-size: 1.3vw;
            border-bottom: 0.1vw solid black;
            margin-bottom: 0.5vw;
        }

        & .dashboard {
            border-bottom: 0.1vw solid black;
            border-top: 0.1vw solid black;
            margin-top: 2vw;
            cursor: pointer;
        }

        & .item {
            width: 100%;
            height: 3vw;
            border: 0.1vw solid black;
            text-align: center;
            margin-bottom: 1vw;
            font-size: 1vw;
            cursor: pointer;

            background-color: #00000005;
            border: 0.1vw solid #00000020;
            border-radius: 0.7vw;

            justify-content: center;
            align-items: center;
            display: flex;
        }

        @media screen and (max-width: $phone_size) {
            & .item-header {
                font-size: 2vw;
            }

            & .item {
                font-size: 1.7vw;
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
