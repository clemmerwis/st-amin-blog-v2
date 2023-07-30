<template>
    <h6 v-if="isPublished" class="small">(published)</h6>
    <h1 class="h3 mb-3">Posts / Detail</h1>

    <my-alert :setup="alert" @clear="() => (alert = {})"></my-alert>

    <v-toolbar color="light" class="mb-5">
        <v-spacer></v-spacer>
        <v-btn color="info" :loading="isProcessing" @click="update">
            <v-icon icon="mdi-plus" color="white"></v-icon>
            Update
        </v-btn>
    </v-toolbar>

    <v-form
        ref="form"
        v-model="valid"
        :disabled="isProcessing"
        @submit.prevent="update"
    >
        <div class="my-grid">
            <div class="area-one">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Title</h5>
                            </div>
                            <div class="card-body">
                                <v-text-field
                                    v-model="record.title"
                                    name="title"
                                    clearable
                                    :rules="[rules.required]"
                                    required
                                ></v-text-field>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Slug</h5>
                            </div>
                            <div class="card-body">
                                <v-text-field
                                    v-model="record.slug"
                                    name="slug"
                                    clearable
                                    :rules="[rules.required]"
                                    required
                                ></v-text-field>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Excerpt</h5>
                            </div>
                            <div class="card-body">
                                <v-textarea
                                    v-model="record.excerpt"
                                    name="excerpt"
                                    clearable
                                ></v-textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="area-two">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Featured Image</h5>
                            </div>
                            <div class="card-body">
                                <v-file-input
                                    :key="featuredImg.length"
                                    v-model="featuredImg"
                                    name="image_featured"
                                    accept="image/*"
                                    clearable
                                    placeholder="Click to upload file"
                                    prepend-icon="mdi-image"
                                    :loading="isProcessing"
                                    @change="updateFeaturedImage($event)"
                                    @click:clear="clearFileInput"
                                >
                                </v-file-input>
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <v-btn
                                            v-if="urlFeaturedImg"
                                            class="no-underline mt-5"
                                            :href="urlFeaturedImg"
                                            target="_blank"
                                            color="info"
                                            size="x-small"
                                        >
                                            View Image
                                        </v-btn>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="d-md-flex justify-content-md-end gap-md-3">
                            <div
                                class="card flex-basis-0 flex-grow-1 vuetify-switch"
                            >
                                <div class="card-body">
                                    <v-switch
                                        v-model="record.active"
                                        name="active"
                                        color="success"
                                        label="Active"
                                    ></v-switch>
                                </div>
                            </div>

                            <div
                                class="card flex-basis-0 flex-grow-1 vuetify-switch"
                            >
                                <div class="card-body">
                                    <v-switch
                                        v-model="record.featured"
                                        name="featured"
                                        color="primary"
                                        label="Featured"
                                    ></v-switch>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-form>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: false,
                default() {
                    return {};
                },
            },
        },
        data() {
            return {
                errors: {},
                alert: {},
                valid: false,
                processing: false,
                record: this.post || {},
                featuredImg: [],
                urlFeaturedImg: null,
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: null,
            };
        },
        created() {
            this.getFeaturedImage();
        },
        computed: {
            isProcessing() {
                return this.processing;
            },
            isPublished() {
                return this.record.published_at !== null;
            },
        },
        methods: {
            async validate() {
                const { valid } = await this.$refs.form.validate();

                return valid;
            },
            reset() {
                this.$refs.form.reset();
            },
            resetValidation() {
                this.$refs.form.resetValidation();
            },

            async update() {
                this.processing = true;
                // reset validations
                this.errors = {};
                this.alert = {};

                // build payload
                this.payload = await this.getPayload();
                try {
                } catch (error) {}
                // check form
                if (this.validate()) {
                    // submit form
                    return axios
                        .post(`/api/admin/posts/${this.record.id}`, this.payload, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then(() => {
                            this.processing = false;

                            // alert user
                            this.alert = { message: "Post updated successfully" };

                            // this.reset();
                            this.resetValidation();

                            // fetch featured image after the next DOM update
                            this.$nextTick(() => {
                                this.getFeaturedImage();
                            });
                            // Reload the page
                            // window.location.reload();
                        })
                        .catch(({ response }) => {
                            if (response) {
                                this.processing = false;

                                // field validation errors (server-side)
                                this.errors = this.errors?.errors;

                                // alert user
                                this.alert = {
                                    title: "Validation Errors",
                                    ...response?.data,
                                };
                            }
                        });
                } else {
                    // trigger alert
                    this.alert = {
                        title: "Validation Errors",
                        message: "Form Errors are Present",
                        errors: true,
                    };

                    this.processing = false;

                    return false;
                }
            },
            async getPayload() {
                // limit payload fields
                const payload = {
                    id: this.record.id,
                    title: this.record.title,
                    slug: this.record.slug,
                    active: this.record.active ? 1 : 0,
                    featured: this.record.featured ? 1 : 0,
                    excerpt: this.record.excerpt,
                };

                // clear the media
                if (!this.urlFeaturedImg && this.featuredImg.length === 0) {
                    payload.image_featured = "clear";
                }

                // new image
                if (!this.urlFeaturedImg && this.featuredImg.length !== 0) {
                    payload.image_featured = this.featuredImg;
                }

                let formData = new FormData();

                // populate formData
                for (let key in payload) {
                    // append image
                    if (key === "image_featured" && payload[key]) {
                        if (payload[key] !== "clear") {
                            formData.append(key, payload[key][0]);
                        } else {
                            formData.append(key, payload[key]);
                        }
                    } else {
                        // append properties
                        formData.append(key, payload[key]);
                    }
                }

                return formData;
            },

            updateFeaturedImage(event) {
                this.urlFeaturedImg = null;
                this.featuredImg = Array.from(event.target.files);
            },
            clearFileInput() {
                this.urlFeaturedImg = null;
                this.featuredImg = [];
                console.log("ran");
            },

            getFeaturedImage() {
                this.processing = true;

                return axios
                    .get(`/api/featured-image/${this.record.id}`)
                    .then((response) => {
                        const featuredImg = [response.data.featuredImg];
                        // set Laravel Media image name to match normal js file object name
                        for (let i = 0; i < featuredImg.length; i++) {
                            if (featuredImg[i].file_name) {
                                featuredImg[i].name = featuredImg[i].file_name;
                            }
                        }
                        this.featuredImg = featuredImg;

                        let urlFeaturedImg = response.data.urlFeaturedImg;
                        urlFeaturedImg = urlFeaturedImg.replace("localhost", "");
                        urlFeaturedImg = urlFeaturedImg.replace("127.0.0.1", "");

                        this.urlFeaturedImg = urlFeaturedImg;

                        this.processing = false;
                    })
                    .catch(({ response }) => {
                        this.processing = false;

                        // field validation errors (server-side)
                        this.errors = this.errors?.errors;

                        // alert user
                        this.alert = {
                            title: "Featured Image Error",
                            ...response?.data,
                        };
                    });
            },
        },
    };
</script>

<style scoped>
    .flex-basis-0 {
        flex-basis: 0px;
    }

    .fit-content {
        max-width: fit-content;
    }

    .my-grid {
        display: grid;
        grid-template-areas:
            "two   two   two   two"
            "one   one   one   one";
        grid-template-columns: repeat(4, 1fr);
        grid-row-gap: 0.5rem;
        grid-column-gap: 1rem;
    }

    .area-one {
        grid-area: one;
    }
    .area-two {
        grid-area: two;
    }
    .area-three {
        grid-area: three;
    }

    .area-two .vuetify-switch {
        max-width: 200px;
    }

    .vuetify-switch .card-body {
        padding: 0 1.2em;
    }

    @media (max-width: 768px) {
        .my-grid {
            grid-template-areas:
                "two ..."
                "one one";
            grid-template-columns: minmax(auto, max-content) 1fr;
        }
    }
</style>
