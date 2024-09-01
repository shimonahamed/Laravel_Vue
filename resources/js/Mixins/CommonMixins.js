import axios from "axios";

export default {
    data(){
        return{
            dataList : {}
        }
    },
    methods : {
        openModal : function (modalId = 'myModal', status = 'show'){
            $(`#${modalId}`).modal(status);
        }
    }
}

