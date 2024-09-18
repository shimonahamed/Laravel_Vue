const helper = function (store, router) {
    router.beforeEach((to, from, next) => {
        store.state.updateId = '';
        store.state.formType = 1;
        store.state.fromData = {};
        // const Permissions = userPermissions();
        // const requiredPermission = to.meta.requiredPermission;

        // if ( requiredPermission) {
        //     if ( Permissions.includes(requiredPermission)) {
        //         next();
        //     } else {
        //         next('/not-authorized');
        //     }
        // } else {
        //     next();
        // }
         next(true);
    });
};
// function userPermissions() {
//
//     return [];
// }
export default helper;