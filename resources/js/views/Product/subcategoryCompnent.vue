<template>
    <div class="row">

        <div class="card">
            <div class="card-header">
                <page-top></page-top>
            </div>
            <data-table :tableHeading="tableHeading">
                <tr v-for="(data , index) in dataList">

                    <td>{{index+1}}</td>
                    <td>{{data.name}}</td>
                    <td>Category</td>
                    <td>
                        <a @click="openEditModal(data)"><i class="fas fa-edit"></i></a>
                        <a><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>

            </data-table>

    </div>
        <data-modal :form-data="formData">
            <div class="row">
                <div class="col-md-12">
                    <label> Name</label>
                    <input v-model="formData.name" class="form-control" type="text">
                </div>
                <div class="col-md-12">
                    <label> Category</label>
                    <select v-model="formData.categoy" class="form-control">
                        <option>Select</option>
                        <option></option>
                    </select>
                </div>
            </div>
        </data-modal>
    </div>
</template>

<script>
    import PageTop from "../../compnents/pageTop";
    import DataTable from "../../compnents/dataTable";
    import DataModal from "../../compnents/dataModal";
    export default {
        name: "subcategoryCompnent",
        components: {DataModal, DataTable, PageTop},
        data(){
            return{
                tableHeading:['SL' ,'Name','Category','Action']
            }
        },
        mounted() {
            this.getDataList();
        }
    }
</script>

<style scoped>

</style>