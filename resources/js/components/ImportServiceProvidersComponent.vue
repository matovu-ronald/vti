<template>
    <div>
        <multiple-file-uploader
                postURL="http://127.0.0.1:8000/api/import/service/providers"
                successMessagePath=""
                errorMessagePath=""
                :minItems="1"
                :maxItems="30">
        </multiple-file-uploader>
    </div>
</template>

<script>
    import MultipleFileUploader from '@updivision/vue2-multi-uploader'

    export default {
        name: "ImportServiceProvidersComponent",
        components: {
            MultipleFileUploader
        },

    }
</script>

<style scoped>

</style>