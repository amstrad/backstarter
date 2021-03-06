
/**
 DOCS:
 Notifications



 */


import './bootstrap';
import Vue from 'vue'; // Importing Vue Library
import VueRouter from 'vue-router'; // importing Vue router library
import Paginate from 'vuejs-paginate'
import Snotify from 'vue-snotify' //https://github.com/artemsky/vue-snotify/
import 'vue-snotify/styles/material.css'
import ToggleButton from 'vue-js-toggle-button' // https://github.com/euvl/vue-js-toggle-button
import VueEditor from 'vue2-editor';
import PictureInput from 'vue-picture-input'; //https://github.com/alessiomaffeis/vue-picture-input
//components
import DashboardComponent from './components/DashboardComponent';
import PostsComponent from './components/PostsComponent';
import SinglePostComponent from './components/SinglePostComponent';
import UserComponent from './components/UsersComponent';
import SingleUserComponent from './components/SingleUserComponent';

Vue.component('paginate', Paginate); // paginator
Vue.component('picture-input', PictureInput); // image drag drop
Vue.use(VueRouter); //routes
Vue.use(Snotify); //notifications
Vue.use(ToggleButton); //touch switch instead of checkbox
Vue.use(VueEditor); // rich text editor


Vue.config.productionTip = false


const router = new VueRouter({
    mode: 'history',
    routes: [
        //dashboard
        {
            path: '/admin',
            name: 'DashboardComponent',
            component: DashboardComponent
        },
        //posts
        {
            path: '/admin/posts/:page?',
            name: 'ListPosts',
            component: PostsComponent,
        },
        {
            path: '/admin/posts/single/:id?',
            name: 'SinglePost',
            component: SinglePostComponent,
        },
        //users
        {
            path: '/admin/users/:page?',
            name: 'ListUsers',
            component: UserComponent,
        },
        {
            path: '/admin/users/single/:id?',
            name: 'SingleUser',
            component: SingleUserComponent,
        },
    ],
});


const app = new Vue({
    el: '#app',
    router,
    data: {
        menu: 0,
        pagination: [],
        app_url: window.location.origin + '/admin/',
    },
    created() {
        let me = this;
    },
    components: {
        DashboardComponent,
        PostsComponent,
        SinglePostComponent,
        UserComponent,
        SingleUserComponent
    }
});
