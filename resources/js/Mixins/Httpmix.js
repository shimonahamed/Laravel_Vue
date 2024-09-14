import axios from "axios";
import {Validator} from "vee-validate";
import {Toast} from "vue-toastification";


export default {
    data() {
        return {};
    },


    methods: {
        getDataList: function () {
            const _this = this;
            axios.get(_this.urlGenaretor())
                .then(function (res) {
                    if (parseInt(res.data.status) === 2000) {
                        _this.$store.commit("dataList", res.data.result);

                    }
                    if (parseInt(res.data.status) === 5000) {

                    }
                });
        },

        getRequiredData: function (array) {
            const _this = this;
            _this.httpReq('post', _this.urlGenaretor('api/required_data'), array, {}, function (retData) {
                $.each(retData.result, function (eachItem, value) {
                    _this.$set(_this.requireData, eachItem, value);
                });
            });
        },

        httpReq: function (method, url, data = {}, params = {}, callback = false) {

            axios({
                method: method,
                url: url,
                data: data,
                params: params
            }).then(function (res) {
                if (parseInt(res.data.result) === 5000) {
                    return;

                }
                if (parseInt(res.data.result) === 3000) {
                    return;

                }
                if (typeof callback === 'function') {
                    callback(res.data);
                }
            })

        },
        submitFromData: function (fromData = {}, optParms = {}, callback) {
            const _this = this;
            let method = (_this.formType === 2) ? 'put' : 'post';
            let url = (_this.formType === 2) ? `${_this.urlGenaretor()}/${_this.updateId}` : _this.urlGenaretor();
            _this.$validator.validateAll().then(valid => {
                if (valid) {
                    axios({
                        method: method,
                        url: url,
                        data: fromData

                    }).then(function (res) {
                        if (parseInt(res.data.status) === 2000) {

                            if (optParms.modalForm === undefined) {
                                _this.closeModal();
                            }
                            if (optParms.reloadList === undefined) {
                                _this.getDataList();
                            }
                            if (typeof callback === 'function') {
                                callback(res.data.result);
                            }
                            _this.$toast.success("Category  successfully!");

                        } else if (parseInt(res.data.status) === 3000) {
                            $.each(res.data.result, function (index, errorValue) {
                                _this.$validator.errors.add({
                                    id: index,
                                    field: index,
                                    name: index,
                                    msg: errorValue[0],
                                });
                            })

                        } else {
                            console.log('toster');
                        }
                    });
                }
            });
        },
        CategoryDatadelete: function(id , index) {
            const _this = this;

            _this.DeleteToster(function (isConfirmedelete) {
                let url=`${_this.urlGenaretor()}/${id}`;
                _this.httpReq('delete',url,{},{},function (retData) {
                    _this.getDataList();
                    _this.$toast.success("Data Delete successfully!");


                })
            })

        },





    },

}
