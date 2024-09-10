

export const mutations={
    dataList(state,data){
        state.dataList = data;
    },
    fromData(state ,data){
        state.fromData=data;
    },
    updateId(state ,data){
        state.updateId=data;
    },
    formType(state ,data){
        state.formType=data;
    },
    requireData(state ,data){
        state.requireData=data;
    }
}