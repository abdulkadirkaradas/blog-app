<template>
    <div class="index-container">
        <div class="alignment">
            <div class="section designs"></div>
            <div class="section bags"></div>
            <div class="section blogs"></div>
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
            designs: null,
            bags: null,
            blogs: null,
            socialmedia: null,
        }
    },
    mounted() {
        this.getRecords();
    },
    methods: {
        getRecords() {
            var type = this.actionType;
            type = type != 'socialmedia' ? type : 'sm';
            axios.get(`/admin/get-all-` + type + ``).then(function(response) {
                console.log(response);
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

            & .section {
                border: 1px solid black;
                width: calc(100% / 3);
                padding: 0.7vw;
            }

            // & .designs {
            // }

            // & .bags {
            // }

            // & .blogs {
            // }
        }
    }
</style>
