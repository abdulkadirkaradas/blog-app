<template>
    <div class="management">
        <div class="alignment">
            <div class="headers">
                <div class="section title"></div>
                <div class="section title"></div>
            </div>
            <div class="body">
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

        }
    },
    mounted() {

    },
    methods: {
        getRecords() {
            axios.get(`/admin/get-all-contents`).then(function(response) {
                console.log(response);
            });
        }
    }
}
</script>

<style lang="scss">

</style>
