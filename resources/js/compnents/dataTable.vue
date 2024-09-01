<template>
    <div class="card-body">
        <table class="table table-head-bg-primary mt-4">
            <thead>
            <tr>
                <template v-for="heading in tableHeading">
                    <th >{{ heading }}</th>
                </template>
            </tr>
            </thead>
            <tbody>


                <slot></slot>

            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        name: "dataTable",
        props :{
            tableHeading : {
                type : [Array, Object],
                default (){
                    return [];
                }
            }
        }
    }
</script>

<style scoped>

</style>