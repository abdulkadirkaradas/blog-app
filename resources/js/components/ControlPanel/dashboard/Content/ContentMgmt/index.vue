<template>
    <div class="management">
        <div class="alignment">
            <div class="headers">
                <div class="section title">Başlık</div>
                <div class="section title">Menu İşaretçisi</div>
            </div>
            <div class="c-body">
                <div class="section name"></div>
                <div class="section menu_flag"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
            let self = this;
            axios.get(`/admin/get-all-contents`).then(function (response) {
                self.records = response;
                // console.log(response);
            });
        }
    }
}
</script>

<style lang="scss">
    .management {
        width: 100%;
        height: 100%;
        display: flex;

        & .alignment {
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
                    width: calc(100% / 2);
                    border: 0.05vw solid black;
                    padding: 0.5vw;
                    font-size: 1.3vw;
                }

                // & .title {

                // }
            }

            & .c-body {
                width: 100%;
                height: 100%;
                display: flex;
                margin-bottom: 1vw;
                padding: 0vw;

                & .section {
                    width: calc(100% / 2);
                    border: 0.05vw solid black;
                    padding: 0.5vw;
                    font-size: 1vw;
                }
            }
        }
    }
</style>
