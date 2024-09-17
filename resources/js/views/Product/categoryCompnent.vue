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
                        <a v-if="permissions.includes('category_edit')"  @click="openEditModal(data , data.id)">
                            <i class="fas fa-edit" style="color: blue;"></i>
                        </a>
                        <a v-if="" @click="CategoryDatadelete(data.id, index)">
                            <i class="fas fa-trash-alt" style="color: red;"></i>
                        </a>
                    </td>
                </tr>
            </data-table>
        </div>
        <data-modal @submit="submitFromData(fromData)">
            <div class="row">
                <div class="col-md-12">
                    <label>Category Name</label>

                    <input
                            v-validate="'required'"
                            v-model="fromData.name"
                            class="form-control"
                            name="name"
                            type="text"
                    />
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
        name: "categoryCompnent",
        components: {DataModal, DataTable, PageTop},
        data() {
            return {
                tableHeading: ["Sl", "name", "Action"],

            };
        },
        mounted() {
            this.getDataList();
            this.$set(this.fromData, "name", "");
        },
        computed: {}
    };
</script>

<style scoped></style>
