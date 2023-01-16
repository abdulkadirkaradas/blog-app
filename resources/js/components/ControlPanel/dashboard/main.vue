<template>
    <div class="main-container">
        <div class="menu-container">
            <Menu></Menu>
        </div>
        <div class="main-content">
            <div class="header-container">
                <Header></Header>
            </div>
            <div class="content-container">
                <Content></Content>
            </div>
        </div>
    </div>
</template>

<script>
import Menu from "./Menu/menu.vue";
import Header from './Header/header.vue';
import Content from './Content/content.vue';
export default {
    components: {
        Menu, Header, Content
    }
}
</script>

<style lang="scss">
    $phone_size: 900px;

    .main-container {

        & .menu-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 12vw;
            height: 100%;

            justify-content: center;
            display: flex;
            align-items: center;
        }

        & .main-content {
            width: 88vw;
            position: absolute;
            top: 0;
            right: 0;

            & .header-container {
                padding: 0.5vw;
            }

            & .content-container {
                width: 100%;
                padding: 0.5vw;
                float: right;
                position: relative;
            }
        }

        @media screen and (max-width: $phone_size) {
            & .menu-container {
                width: 20vw;
            }

            & .main-content {
                width: 80vw;
            }
        }
    }
</style>
