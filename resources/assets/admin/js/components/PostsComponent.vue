<template>

    <div class="row">

        <vue-snotify/>


        <div class="col-xl-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row  m-b-30 ">
                            <div class="col-md-3">
                                <h4 class="header-title m-t-10"> Posts</h4>
                            </div>
                            <div class="col-md-8">
                                <form class="app-search" s>
                                    <input v-on:input="fetch"  v-model="search" type="text" placeholder="Search..."
                                           class="form-control">
                                    <button type="submit"><i class="fa fa-search"></i></button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">


                            <router-link tag="a" :to="{ name: 'SinglePost'}" class="btn btn-primary inline">
                                Create New <i class="ti ti-plus"></i>
                            </router-link>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table mb-0 table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in rows">
                            <td>{{ row.id }}</td>
                            <td>
                                <router-link tag="a" :to="{ name: 'SinglePost', params: { id: row.id } }"
                                             class="waves-effect  text-blue">
                                    {{ row.name }}
                                </router-link>
                            </td>
                            <td>
                                <div v-if="row.active==1">
                                    <span class="badge badge-success">Active</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Not Active</span>
                                </div>
                            </td>
                            <td>{{ row.category }}</td>
                            <td>{{ row.created_at }}</td>
                            <td>
                                <router-link tag="button" :to="{ name: 'SinglePost', params: { id: row.id } }"
                                             class="btn btn-icon btn-sm  waves-effect waves-light btn-primary">
                                    <i class="dripicons-document-edit"></i>
                                </router-link>

                                <button @click="removeItem(row.id )"
                                        class="btn btn-sm btn-icon waves-effect waves-light btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>

                            </td>
                        </tr>

                        </tbody>
                    </table>


                </div>
            </div>

            <nav aria-label="">
                <paginate
                        v-model="page"
                        :page-count="pageCount"
                        :click-handler="fetch"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'"
                        :page-class="'page-item waves-effect'"
                        :prev-link-class="'page-link waves-effect'"
                        :next-link-class="'page-link waves-effect'"
                        :page-link-class="'page-link waves-effect' "
                >
                </paginate>
            </nav>

        </div><!-- end col -->


    </div>

</template>

<script>
    export default {
        name: "PostsComponent",

        data() {
            return {
                rows: [],
                page: 1,
                pageCount: 1,
                search: '',
                endpoint: 'posts'
            };
        },

        created() {

            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint,{
                    params: {
                        'page' : page,
                        'search': this.search
                    }
                })
                    .then(({data}) => {
                        this.rows = data.posts.data;
                        this.pageCount = data.pagination.last_page;
                    });
            },
            removeItem(id = null){
                if(id > 0){
                    this.$snotify.confirm('Remove #ID:'+id+' ?', 'Confirm deletion', {
                        timeout: 10000,
                        showProgressBar: true,
                        type: 'error',
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons: [
                            {
                                text: 'Yes', action: (toast) => {

                                    axios.post('posts/delete', {
                                        'id': id,
                                    })
                                        .then(({data}) => {
                                            this.page = 1;
                                            this.fetch(1);
                                    });

                                this.$snotify.remove(toast.id);
                                }
                            },
                            {
                                text: 'No', action: (toast) => {
                                console.log('Clicked: No');
                                this.$snotify.remove(toast.id);
                            },
                                bold: true
                            },
                        ]
                    });
                }
            },
        },

        computed: {

        }
    }
</script>
