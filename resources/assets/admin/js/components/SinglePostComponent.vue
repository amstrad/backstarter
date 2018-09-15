<template>
    <div class="SinglePostComponent">
        <vue-snotify/>

        <div>

            <form v-on:submit.prevent="" class="form-horizontal" role="form" method="post"
                  enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-8">
                        <div class="card-box ">
                            <div class="form-group row">
                                <label for="name" class="col-3 col-form-label">Name</label>
                                <div class="col-9">
                                    <input v-model="post.name" type="text" class="form-control" id="name"
                                           placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idcategory" class="col-3 col-form-label">Category</label>
                                <div class="col-9">
                                    <select id="idcategory" class="form-control" v-model="post.idcategory">
                                        <option v-for="categorie in categories" :value="categorie.id">{{ categorie.name
                                            }}
                                        </option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">Description</label>
                                <div class="col-9">
                                    <div class="">
                                        <vue-editor v-model="post.description"></vue-editor>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="active" class="col-3 col-form-label">State</label>
                                <div class="col-9">

                                    <toggle-button

                                            :sync="true"
                                            v-model="this.switch"
                                            :labels="true"
                                            :width=70
                                            :height=32
                                            @change="modifyActive"
                                    />


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box">


                            <picture-input
                                    ref="pictureInput"
                                    width="600"
                                    height="600"
                                    margin="16"
                                    accept="image/jpeg,image/png"
                                    size="10"
                                    button-class="btn"
                                    :prefill="post.image"
                                    :custom-strings="{
                                        upload: '<h1>Uploaded</h1>',
                                        drag: '<h2><i class=\'ti-cloud-up ti\'></i></h2> Drag Image Here'
                                    }"
                                    @change="onChangeImage"
                            >
                            </picture-input>

                            <input class="d-none" type="file" id="pictureInput" name="pictureInput">


                            <button v-on:click="save()" class="m-t-20 btn-block  btn btn-info waves-effect">
                                Save <i class="ti ti-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</template>

<script>


    export default {
        name: "SinglePostComponent",
        components: {},
        data() {
            return {
                id: null,
                post: {},
                switch: false,
                categories: [],
                file: '',
                showPreview: false,
                imagePreview: '',
                endpoint: '#',

            };
        },

        created() {

            if (this.$route.params.id) {
                this.id = this.$route.params.id;
            }

            this.fetch(this.id);
        },

        methods: {
            fetch(id = null) {
                axios.get(this.endpoint + this.id)
                    .then(({data}) => {
                        if (data.post) {
                            this.post = data.post;
                            this.switch = this.post.active == 1 ? true : false;
                        }

                        this.categories = data.categories;


                    });
            },
            save() {

                let me = this;
                let formData = new FormData();

                formData.append('id', this.post.id);
                formData.append('name', this.post.name);
                formData.append('description', this.post.description);
                formData.append('active', this.post.active);
                formData.append('idcategory', this.post.idcategory);

                formData.append('image', this.file);

                axios.post(this.endpoint,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function (response) {
                    const delay = 2000;
                    setTimeout(() => {

                        me.$router.go(-1);

                    }, delay);

                    //notification
                    me.$snotify.success('Item Saved!', {
                        timeout: 1000,
                        showProgressBar: true,
                        closeOnClick: true,
                        pauseOnHover: false,

                    });

                }).catch(function (error) {
                    me.$snotify.error('Opss, please modify data and try again');
                });
            },

            modifyActive(state) {

                if (state.value == true) {
                    this.post.active = 1;
                } else {
                    this.post.active = 0;
                }
            },

            /*
                   Handles a change on the file upload
                 */
            onChangeImage(image) {
                console.log('New picture selected!')
                if (image) {
                    console.log('Picture loaded.')
                    this.file = this.$refs.pictureInput.file
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            }


        },

        computed: {}
    }
</script>

<style scoped>

</style>