
<template>
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img
                            src="assets/img/kaiadmin/logo_light.svg"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="20"
                    />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item" v-for="(menu, mindex) in Config.menus" :key="mindex">
                        <template v-if="menu.sub_menus.length > 0">
                            <a :data-bs-toggle="'collapse'" :href="'#collapse' + mindex">
                                <i class="fas fa-tags"></i>
                                <p>{{ menu.name }}</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" :id="'collapse' + mindex">
                                <ul class="nav nav-collapse">
                                    <li v-for="(subMenu, sindex) in menu.sub_menus" :key="sindex">
                                        <router-link class="nav-link" :to="subMenu.link">
                                            <i class="fas fa-th-list"></i>{{ subMenu.name }}
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </template>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sideMenu",
        mounted() {
            this.getConfigurations();
        },
        methods: {
            getConfigurations() {
                const url = this.urlGenaretor('api/configurations');
                this.httpReq('get', url, {}, {}, (retData) => {
                    this.$store.commit('Config', retData.result);
                    this.$store.commit('permissions', retData.result.permissions);
                });
            }
        }
    };
</script>

<style scoped></style>

