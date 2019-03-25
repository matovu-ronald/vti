<template>
    <div>
        <multiple-file-uploader
                postURL="http://127.0.0.1:8000/api/import/courses"
                successMessagePath=""
                errorMessagePath=""
                :minItems="1"
                :maxItems="30"
                successMsg="Courses imported successfully"
                @upload-success='success_handler'>
        </multiple-file-uploader>
    </div>
</template>

<script>
    import MultipleFileUploader from '@updivision/vue2-multi-uploader';
    export default {
        name: "ImportCoursesComponent",
        components: {
            MultipleFileUploader
        },
        data () {
            return {
                successResponse: ''
            }
        },
        methods: {
            success_handler: function(response){
                console.log(response)
            },
        }

    }
</script>

<style scoped>

</style>