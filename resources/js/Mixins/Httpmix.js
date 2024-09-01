import axios from "axios";
import { Toast } from 'vue-toastification';

export default {
    data(){
        return{
            dataList:{},
            formData:{}

        }

    },
    methods:{
        getDataList : function (){
            const _this = this;
            axios.get(`${baseUrl}/${this.$route.meta.dataUrl}`)
                .then(function (response){
                    _this.dataList = response.data.result;
                });
        },
        submitFromData() {
            const _this = this;
            if (_this.formData.id) {
                axios.put(`${baseUrl}/${this.$route.meta.dataUrl}/${_this.formData.id}`, _this.formData)
                    .then(function (response) {
                        _this.getDataList();
                        _this.$toast.success('Data updated successfully!');
                        _this.openModal('myModal', 'hide');
                    })
                    .catch(function (error) {
                        console.error('Error updating category:', error);
                        _this.$toast.error('Data updated Unsuccessfully!');


                    });
            } else {
                axios.post(`${baseUrl}/${this.$route.meta.dataUrl}`, _this.formData)
                    .then(function (response) {
                        _this.getDataList();
                        _this.$toast.success('Data Create successfully!');

                        _this.openModal('myModal', 'hide');

                    })
                    .catch(function (error) {
                        console.error('Error adding category:', error);
                        _this.$toast.error('Data Create Unsuccessfully!');


                    });
            }
        },
        Categorydelete(data) {
            const _this = this;
            axios.delete(`${baseUrl}/${this.$route.meta.dataUrl}/${data.id}`)
                .then(response => {
                    _this.getDataList();
                    _this.$toast.success('Data Delete successfully!');

                })
                .catch(error => {
                    console.error('Error deleting category:', error);
                    _this.$toast.error('Data Delete Unsuccessfully!');


                });
        }

    },
        openEditModal(data) {
            this.formData = { ...data };
            this.openModal('myModal', 'show');
        },


}