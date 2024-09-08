import axios from "axios";
// import { Validator } from "vee-validate";
import { extend, validateAll, required } from 'vee-validate';
import { Toast } from "vue-toastification";
extend('required', required);


export default {
    data() {
        return {
            formData: {},
        };
    },
    watch: {
        'fromData.name': function (newVal) {
            this.validateField('name');
        }
    },

    methods: {
        getDataList: function () {
            const _this = this;
            axios.get(_this.urlGenaretor()).then(function (response) {
                _this.$store.commit("dataList", response.data.result);
            });
        },

            validateField(field) {
                this.$validator.validate(field, this.fromData[field]);
            },



            submitFromData: function (fromData = {}, optParms = {}, callback) {
            const _this = this;


            _this.$validator.validateAll().then((valid) => {

                if (valid) {



                    if (_this.fromData.id) {

                        axios.put(`${_this.urlGenaretor()}/${_this.fromData.id}`, _this.fromData)
                            .then(function (response) {
                                _this.getDataList();
                                _this.closeModal();
                                _this.$toast.success("Data Update successfully!");

                            })
                            .catch(function (error) {
                                console.error('Error updating category:', error);
                                _this.$toast.error("Data Updateing Unsuccessfully!");

                            });
                    } else {
                        axios.post(_this.urlGenaretor(), fromData)
                            .then(function (res) {
                                if (parseInt(res.data.status) === 2000) {
                                    if (optParms.modalForm === undefined) {
                                        _this.closeModal();
                                    }
                                    if (optParms.reloadList === undefined) {
                                        _this.getDataList();
                                    }
                                    if (typeof callback === "function") {
                                        callback(res.data.result);
                                    }
                                    _this.$toast.success("Data Added successfully!");
                                } else if (parseInt(res.data.status) === 3000) {
                                    console.log(res.data.result);
                                } else {
                                    console.log("Unexpected status code");
                                }
                            })
                            .catch(error => {
                                this.$validator.errors.clear();
                                if (error.response && error.response.data.errors) {
                                    Object.entries(error.response.data.errors).forEach(([name, messages]) => {
                                        messages.forEach(message => {
                                            this.$validator.errors.add({
                                                name: name,
                                                message: message
                                            });
                                        });
                                    });
                                }
                                this.$toast.error('Validation Failed');
                            });
                    }
                }
            }).catch(function (error) {
                console.error('Validation failed:', error);
                _this.$toast.error('Validation Failed');
            });
        },


        CategoryDatadelete(data) {
            const _this = this;
            axios
                .delete(`${baseUrl}/${this.$route.meta.dataUrl}/${data.id}`)

                .then((response) => {
                    _this.getDataList();
                    _this.$toast.success("Data Delete successfully!");
                })
                .catch((error) => {
                    console.error("Error deleting category:", error);
                    _this.$toast.error("Data Delete Unsuccessfully!");
                });
        },
    },
};
