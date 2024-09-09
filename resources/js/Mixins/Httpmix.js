import axios from "axios";
import { Validator } from "vee-validate";
import { extend, validateAll, required } from 'vee-validate';
import { Toast } from "vue-toastification";


export default {
    data() {
        return {

        };
    },
    // watch: {
    //     'fromData.name': function (newVal) {
    //         this.validateField('name');
    //     }
    // },

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
                                _this.$toast.error("Data Updating Unsuccessfully!");
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
                                    $.each(res.data.result, function (index, errorValue) {
                                        _this.$validator.errors.add({
                                            id: index,
                                            field: index,
                                            name: index,
                                            msg: errorValue[0],
                                        });
                                    });
                                } else {
                                    console.log('toster');
                                }
                            });
                    }
                }
            });
        },

        handleValidationError: function (error) {
            if (error.response && error.response.data.result) {
                const errors = error.response.data.result;
                console.log(errors);
                Object.keys(errors).forEach(key => {
                    errors[key].forEach(message => {
                        this.$validator.errors.add({ field: key, msg: message });
                    });
                });
                this.$toast.error('Validation Failed');
            } else {
                console.error('Error:', error);
                this.$toast.error('An unexpected error occurred.');
            }
            },

        CategoryDatadelete(data) {
            const _this = this;

                axios.delete(`${_this.urlGenaretor()}/${data.id}`)

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
