<template>
    <div class="content">
        <div class="menu-content">
            <div class="item-header unselect">Tasarımlarım</div>
            <div class="item unselect">Tasarım Ekle</div>
            <div class="item unselect">Tasarımları Gör</div>
            <div class="item-header unselect">Çanta</div>
            <div class="item unselect">Çanta Ekle</div>
            <div class="item unselect">Çantaları Gör</div>
            <div class="item-header unselect">Blog</div>
            <div class="item unselect">Blog Ekle</div>
            <div class="item unselect">Blogları Gör</div>
            <div class="item-header unselect">Sosyal Medya</div>
            <div class="item unselect">SM Yönetimi</div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
    $phone_size: 900px;

    .content {
        width: 100%;
        height: 100%;
        padding: 0.5vw;

        & .menu-content {
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

            & .item {
                width: 100%;
                height: 3vw;
                border: 0.1vw solid black;
                text-align: center;
                margin-bottom: 1vw;
                font-size: 1vw;

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
    }

    .unselect {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

</style>
