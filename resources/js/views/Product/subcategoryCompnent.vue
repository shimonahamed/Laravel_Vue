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
                    <td>{{ data.categoryId }}</td>
                    <td>
                        <a @click="openEditModal(data)"
                            ><i class="fas fa-edit"></i
                        ></a>
                        <a @click="CategoryDatadelete(data)"
                            ><i class="fas fa-trash-alt"></i
                        ></a>
                    </td>
                </tr>
            </data-table>
        </div>
        <data-modal :from-data="fromData">
            <div class="row">
                <div class="col-md-12">
                    <label> Name</label>
                    <input
                        v-model="fromData.name"
                        class="form-control"
                        type="text"
                    />
                </div>
                <div class="col-md-12">
                    <label> Category</label>
                    <select v-model="fromData.categoryId" class="form-control">
                        <option value="">Select</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
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
    components: { DataModal, DataTable, PageTop },
    data() {
        return {
            tableHeading: ["SL", "Name", "Category", "Action"],
        };
    },
    mounted() {
        this.getDataList();
    },
    methods: {},
};
</script>

<style scoped></style>
