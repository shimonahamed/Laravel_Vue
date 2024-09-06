import axios from "axios";
import { Validator } from "vee-validate";
import { Toast } from "vue-toastification";

export default {
    data() {
        return {};
    },

    methods: {
        getDataList: function () {
            const _this = this;
            axios.get(_this.urlGenaretor()).then(function (response) {
                _this.$store.commit("dataList", response.data.result);
            });
        },

        openEditModal(data) {
            this.$store.commit("fromData", data.result);
            this.openModal("myModal", "show");
        },

        submitFromData: function (fromData = {}, optParms = {}, callback) {
            const _this = this;
            _this.$validator.validateAll().then((valid) => {
                if (valid) {
                    axios
                        .post(_this.urlGenaretor(), fromData)
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
                                _this.$toast.success(
                                    "Data Added successfully!"
                                );
                            } else if (parseInt(res.data.status) === 3000) {
                                console.log(res.data.result);
                            } else {
                                console.log("toster");
                            }
                        });
                }
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
