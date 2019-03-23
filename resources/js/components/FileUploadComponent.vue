<template>
    <div>
        <div v-if="successUpload" class="callout callout-success">
            <h4>Service Providers Imported Successfully</h4>
        </div>
        <multiple-file-uploader
                postURL="http://127.0.0.1:8000/api/import/service/providers"
                successMessagePath=""
                errorMessagePath=""
                :minItems="1"
                :maxItems="1"
                dropAreaPrimaryMessage="Drop Excel file here"
                @upload-success='success_handler'
        >
        </multiple-file-uploader>
    </div>
</template>

<script>
    import MultipleFileUploader from '@updivision/vue2-multi-uploader'

    export default {
        name: "FileUploadComponent",
        components: {
            MultipleFileUploader
        },
        data () {
            return {
                successUpload: false
            }
        },
        methods: {
            success_handler: function(response){
                this.successUpload = true;
                console.log(response.data)
            },
        }
    }
</script>

<style scoped>

</style>