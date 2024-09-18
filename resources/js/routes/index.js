import Home from "../views/Home.vue";
import About from "../views/About.vue";

import categoryCompnent from "../views/Product/categoryCompnent";
import subcategoryCompnent from "../views/Product/subcategoryCompnent";
import product from "../views/Product/product"

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
    {
        // v-if="permissions.includes('')"

        path :  '/admin/product/category',
        name : 'category',
        component : categoryCompnent,
        meta: {
            pagetitle: 'Category',
            dataUrl: 'api/categories',
        }
    },
    {
        path : '/admin/product/sub_category',
        name : 'sub_category',
        component : subcategoryCompnent,
        meta:{pagetitle:'Sub-Caategory',dataUrl:'api/subcategories',
        }

    },{
        path : '/admin/product/product',
        name : 'product',
        component : product,
        meta:{pagetitle:'Product Table',dataUrl:'api/product',
        }

    },
];
export default route;
