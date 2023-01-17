<template>
    <div class="action-container">
        <form method="POST" id="store_form" enctype="multipart/form-data">
            <div class="alignment">
                <div class="left">
                    <div class="f-group">
                        <input type="text" id="name" placeholder="Lütfen isim giriniz!">
                    </div>
                    <!-- add flag -->
                    <div class="f-group-editor">
                        <Editor :init="{plugins: ['wordcount', 'emoticons'], toolbar: ['emoticons']}"></Editor>
                    </div>
                </div>
                <div class="right">
                    <div class="image-group" id="i-group">
                        <div class="preview">
                            <img id="image-preview">
                        </div>
                        <div class="uploader unselect">
                            <label for="file-uploader" @click="document.getElementById('file-uploader').click()">Resim Yükle</label>
                            <input type="file" id="file-uploader" accept="image/*" v-on:change="showPreview($event)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-area unselect">
                <div class="submit">Kaydet</div>
            </div>
        </form>
    </div>
</template>

<script>
import * as $ from "jquery";
import Editor from '@tinymce/tinymce-vue';
import tinymce from "tinymce";
export default {
    props: {
        actionType: null
    },
    data() {
        return {

        }
    },
    mounted() {
        tinymce.activeEditor.setContent("");
        $("input").val();
        $(".preview > img").remove();
        $(".preview").append("<img id='image-preview'>");
        $("#image-preview").attr("display", "none");
    },
    methods: {
        showPreview(event) {
            if(event.target.files.length > 0) {
                let imageGroup = document.getElementById("i-group");

                let src = URL.createObjectURL(event.target.files[0]);
                let preview = document.getElementById("image-preview");

                preview.src = src;
                preview.style.display = "block";

                imageGroup.style.borderLeft = "0.05vw solid black";
                imageGroup.style.borderRight = "0.05vw solid black";

                this.$emit("status", "opened");
            }
        }
    },
    components: {
        Editor
    }
}
</script>

<style lang="scss">
    .action-container {
        & .alignment {
            width: 100%;
            height: 100%;
            display: flex;

            & .left {
            width: 50%;
            float: left;

                & .f-group {
                    margin-bottom: 0.3vw;

                    label {
                        width: 100%;

                        display: inline-block;
                        margin-bottom: 0.4vw;
                        font-family: sans-serif;
                        font-size: 1.2vw;
                    }

                    input {
                        width: 100%;
                        height: 2.6vw;
                        font-size: 1.25vw;

                        margin-bottom: 1vw;

                        display: block;
                        padding: 0.4vw 0.4vw;
                        line-height: 1.5;
                        color: #495057;
                        background-color: #fff;
                        background-clip: padding-box;
                        border: 0.05vw solid #ced4da;
                        border-radius: 0.2vw;
                        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                    }
                }
            }

            & .right {
                width: 50%;
                float: right;
                padding: 1.5vw;

                & .image-group {
                    width: 100%;
                    height: 100%;

                    & .preview {
                        justify-content: center;
                        align-items: center;
                        display: flex;
                        padding: 1vw;

                        & img {
                            display: none;
                            width: 35vw;
                            margin-bottom: 0.5vw;
                        }
                    }

                    & .uploader {
                        justify-content: center;
                        align-items: center;
                        display: flex;

                        label {
                            display: block;
                            width: 45%;
                            height: 4vw;
                            line-height: 4vw;
                            text-align: center;
                            background:#1172c2;
                            color: #fff;
                            font-size: 1.5vw;
                            text-transform:Uppercase;
                            font-weight: 600;
                            border-radius: 1vw;
                            cursor:pointer;
                        }

                        input {
                            display: none;
                        }
                    }
                }
            }
        }

        & .submit-area {
            margin-top: 1vw;
            justify-content: center;
            align-items: center;
            display: flex;

            & .submit {
                width: 10vw;
                height: 2.5vw;
                font-size: 1.3vw;
                cursor: pointer;
                background-color: rgba(0, 0, 0, 0.0196078431);
                border: 0.1vw solid rgba(0, 0, 0, 0.1254901961);
                border-radius: 0.7vw;
                justify-content: center;
                align-items: center;
                display: flex;
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
