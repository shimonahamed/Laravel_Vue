<template>

    <div class="modal fade" :id="modalId" >
        <div class="modal-dialog">
            <from @submit.prevent="submitForm(formData)">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot></slot>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="submitFromData" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </from>
        </div>
    </div>
</template>

<script>
    export default {
        name: "dataModal",
        props:{
            modalId:{
                type : [String],
                default:'myModal'
            },
            formData : {
                type : [Object, Array],
                default(){
                    return {}
                }
            }
        }

    }
</script>

<style scoped>

</style>