<template>
    <div>
        <top-nav-bar></top-nav-bar>
        <div id="layoutSidenav">
            <side-nav-bar></side-nav-bar>
            <div id="layoutSidenav_content">
                <main>
                    <router-view></router-view>
                </main>
                <Footer></Footer>
            </div>
        </div>
    </div>
</template>
<script>
import Footer from "./compnents/footer.vue";
import SideNavBar from "./compnents/sideMenu.vue";
import TopNavBar from "./compnents/topMenu.vue";

export default {
    name: "App",
    components: { Footer, SideNavBar, TopNavBar },
    mounted() {},
};
</script>
<style scoped></style>
