<template>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <page-top></page-top>
            </div>
            <data-table :tableHeading="tableHeading">
                <tr v-for="(data, index) in dataList">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.name }}</td>
                    <td>
                        <a @click="openEditModal(data, data.id)">
                            <i class="fas fa-edit" style="color: blue;"></i>
                        </a>
                        <a @click="CategoryDatadelete(data.id,index)">
                            <i class="fas fa-trash-alt" style="color: red;"></i>
                        </a>
                    </td>
                </tr>
            </data-table>
        </div>
        <data-modal @submit="submitFromData(fromData)">
            <div class="row">
                <div class="col-md-12">
                    <label> Name</label>
                    <input
                            v-model="fromData.name"
                            class="form-control"
                            type="text"
                            name="name"
                    />

                </div>
                <div class="col-md-12">
                    <label> Category</label>
                    <select v-model="fromData.category_id" name="category_id" class="form-control">
                        <template v-for="(item , index) in requireData.category">
                            <option :value="item.id">{{item.name}}</option>

                        </template>
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
    import axios from "axios";

    export default {
        name: "subcategoryCompnent",
        components: {DataModal, DataTable, PageTop},
        data() {
            return {
                tableHeading: ["SL", "Name", "Action"],
            };
        },
        mounted() {
            this.getDataList();
            this.getRequiredData(['category']);
        },
        methods: {

        },
    };
</script>

<style scoped></style>
