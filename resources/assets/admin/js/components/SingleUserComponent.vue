<template>
    <div class="SingleitemComponent">
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
                                    <input v-model="item.name" type="text" class="form-control" id="name"
                                           placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idrol" class="col-3 col-form-label">Rol</label>
                                <div class="col-9">
                                    <select id="idrol" class="form-control" v-model="item.idrol">
                                        <option v-for="rol in roles" :value="rol.id">{{ rol.name
                                            }}
                                        </option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">Description</label>
                                <div class="col-9">
                                    <div class="">
                                        <vue-editor v-model="item.description"></vue-editor>
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
                                    :prefill="item.image"
                                    :custom-strings="{
                                        upload: '<h1>Uploaded</h1>',
                                        drag: '<h2><i class=\'ti-cloud-up ti\'></i></h2> Drag Image Here'
                                    }"
                                    @change="onChangeImage"
                            >
                            </picture-input>

                            <input class="d-none" type="file" id="pictureInput" name="pictureInput">


                            <button v-on:click="save()" class=" col-md-7 m-t-20 btn-block  btn btn-info waves-effect">
                                Save <i class="ti ti-check"></i>
                            </button>

                            <button v-on:click="$router.go(-1);"
                                    class="col-md-4  m-t-20 btn-block  btn btn-pink waves-effect">
                                Cancel <i class="dripicons-backspace"></i>
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
        name: "SingleUserComponent",
        components: {},
        data() {
            return {
                id: null,
                item: {},
                switch: false,
                roles: [],
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
                        if (data.item) {
                            this.item = data.item;
                            this.switch = this.item.active == 1 ? true : false;
                        }

                        this.categories = data.categories;


                    });
            },
            save() {

                let me = this;
                let formData = new FormData();

                formData.append('id', this.item.id);
                formData.append('name', this.item.name);
                formData.append('description', this.item.description);
                formData.append('active', this.item.active);
                formData.append('idcategory', this.item.idcategory);

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
                    this.item.active = 1;
                } else {
                    this.item.active = 0;
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
                }
            }


        },

        computed: {}
    }
</script>

<style scoped>

</style>