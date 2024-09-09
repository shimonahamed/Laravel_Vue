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
                    <td>{{ getCategoryName(data.category_id) }}</td>
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
                    <span v-if="errors.has('name')" class="text-danger">{{ errors.first(result.name) }}</span>

                </div>
                <div class="col-md-12">
                    <label> Category</label>
                    <select v-model="fromData.category_id" name="category_id" class="form-control">
                        <option value="Select Category">Select Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <span v-if="errors.has('category_id')" class="text-danger">{{ errors.first('category_id') }}</span>

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
    components: { DataModal, DataTable, PageTop },
    data() {
        return {
            tableHeading: ["SL", "Name", "Category", "Action"],
            categories: [],
        };
    },
    mounted() {
        this.getDataList();
        this.getCategories();
    },
    methods: {
        getCategoryName(category_id) {
            const category = this.categories.find(cat => cat.id === category_id);
            return category ? category.name : '';
        },
        getCategories() {
            axios.get('/api/categories')
                .then(response => {
                this.categories = response.data.result;
            });
        },
    },
};
</script>

<style scoped></style>
