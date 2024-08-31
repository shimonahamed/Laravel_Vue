import Home from "../views/Home.vue";
import About from "../views/About.vue";

const route = [
    {
        path : '/admin/home',
        name : 'home',
        component : Home
    },
    {
        path : '/admin/about',
        name : 'about',
        component : About
    },
];
export default route;
