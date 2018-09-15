let app_routes = [
    {
        path: '/admin',
        name: 'DashboardComponent',
        component: DashboardComponent
    },
    {
        path: '/admin/posts',
        name: 'ListPosts',
        component: PostsComponent,
    },
    {
        path: '/admin/posts/single/:id?',
        name: 'SinglePost',
        component: SinglePostComponent,
    }
];
