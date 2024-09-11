import axios from "axios";

export default {
    data() {
        return {}
    },
    watch: {
        'errors': {
            handler: function (eachError, oldVal) {
                const _this = this;
                $(".validation_error").remove();
                $(".is-invalid").removeClass('is-invalid');
                $.each(eachError.items, function (index, eachField) {
                    var target = $("[name='" + eachField.field + "']");
                    $(target).parent().append("<span class='validation_error'>" + eachField.msg + "</span>")
                    $(target).addClass('is-invalid');
                });
            },
            deep: true
        }
    },
    methods: {
        openModal: function (modalId = false, fromData = {}, callback = false) {
            const _this = this;
            let modal_id = modalId ? modalId : 'myModal';
            $(`#${modal_id}`).modal('show');
            _this.$store.commit('fromData', fromData);

            if (typeof callback == 'function') {
                callback(true)
            }


        },
        closeModal: function (modalId = 'myModal', fromData = {}) {
            const _this = this;
            $(`#${modalId}`).modal('hide');
            _this.$store.commit('fromData', {});
            _this.$store.commit('updateId', '');
            _this.$store.commit('formType', 1);
        },
        urlGenaretor: function (customUrl = false) {
            const _this = this;
            if (customUrl) {
                return `${baseUrl}/${customUrl}`;

            }
            return `${baseUrl}/${_this.$route.meta.dataUrl}`

        },
        openEditModal(data, id) {

            this.$store.commit('updateId', id);
            this.$store.commit('formType', 2);

            this.openModal(false, data)

        },


        DeleteToster: function (callback=false,confirmMessage=null,confirmTitle=null) {
            const _this=this;
            let message=confirmMessage ? confirmMessage : "You won't be able to revert this!";
            let title = confirmTitle ?? "Are you sure?";

            _this.$swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                isConfirmed:true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'


        }).then((result)=>{
                if(typeof callback === 'function'){
                    callback (result.isConfirmed)

                }
            });

        }
    },


    computed: {
        fromData() {
            return this.$store.state.fromData;
        },
        dataList() {
            return this.$store.state.dataList;
        },
        requireData() {
            return this.$store.state.requireData;
        },
        updateId() {
            return this.$store.state.updateId;
        },
        formType() {
            return this.$store.state.formType;
        }

    }
}



