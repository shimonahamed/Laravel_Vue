<template>
    <div class="wrapper">
        <div class="main-panel">

            <topMenu></topMenu>
            <sideMenu></sideMenu>
            <div class="container">
                <router-view></router-view>
            </div>

            <Footer></Footer>
        </div>
    </div>
</template>
<script>
    import Footer from "./compnents/Footer.vue";
    import sideMenu from "./compnents/sideMenu.vue";
    import topMenu from "./compnents/topMenu.vue";

    export default {
        name: "App",
        components: {Footer, sideMenu, topMenu},

        mounted() {

        },
    };
</script>
<style scoped></style>
