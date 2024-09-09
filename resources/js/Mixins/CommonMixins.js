import axios from "axios";

export default {
    data(){
        return{


        }
    },
    watch: {
        'errors': {
            handler: function (eachError, oldVal) {
                const _this = this;
                $(".validation_error").remove();
                $(".is-invalid").removeClass('is-invalid');
                $.each(eachError.items, function (index, eachField){
                    var target = $("[name='" + eachField.field + "']");
                    $(target).parent().append("<span class='validation_error'>"+eachField.msg+"</span>")
                    $(target).addClass('is-invalid');
                });
            },
            deep: true
        }
    },
    methods : {
        openModal : function (modalId = 'myModal',fromData={}){
            const _this = this;
            $(`#${modalId}`).modal('show');
            _this.$store.commit('fromData', fromData);


        },
        closeModal : function (modalId = 'myModal', fromData={}){
            const _this=this;
            $(`#${modalId}`).modal('hide');
            _this.$store.commit('fromData',{})
        },
        urlGenaretor:function(customUrl = false){
            const _this=this;
            if (customUrl){
                return `${baseUrl}/${customUrl}`;

            }
            return `${baseUrl}/${_this.$route.meta.dataUrl}`

        },
        openEditModal(category) {

            let cat = Object.assign({}, category);
            this.$store.commit('fromData', cat);

            this.openModal('myModal', this.fromData)

        },


        DeleteToster:function () {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                isConfirmed:true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            })

        }
    },


    computed :{
        fromData(){
            return this.$store.state.fromData;
        },
        dataList(){
            return this.$store.state.dataList;
        }

    }
}



