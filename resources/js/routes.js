// importare vue e vue-router
import Vue from "vue";
import VueRouter from "vue-router";


// iniettare VueRouter dentro Vue
Vue.use(VueRouter);

// importazione componenti delle pagine
import Home from './components/pages/Home';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import Posts from './components/pages/Posts';
import PostDetail from './components/pages/PostDetail';
import Error404 from './components/pages/Error404';

// inizializzare la classe del router che conterrà tutte le rotte
const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            path: '/contatti',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/blog',
            name: 'blog',
            component: Posts
        },
        {
            path: '/detail/:slug',
            name: 'detail',
            component: PostDetail
        },
        {
            // il percorso 404 deve essere messo in fondo alle rotte
            path: '*',
            component: Error404
        },
    ]
});

// esportiamo la classe router

export default router;


