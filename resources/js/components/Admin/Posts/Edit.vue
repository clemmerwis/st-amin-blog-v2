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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Body</h5>
                            </div>
                            <div class="card-body">
                                <ckeditor
                                    v-model="editorData"
                                    :editor="editor"
                                ></ckeditor>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
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
                                            size="small"
                                        >
                                            View Image
                                        </v-btn>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Featured GIF</h5>
                            </div>
                            <div class="card-body">
                                <v-file-input
                                    :key="featuredGif.length"
                                    v-model="featuredGif"
                                    name="gif_featured"
                                    accept="image/gif"
                                    clearable
                                    placeholder="Click to upload file"
                                    prepend-icon="mdi-image"
                                    :loading="isProcessing"
                                    @change="updateFeaturedGif($event)"
                                    @click:clear="clearGifInput"
                                >
                                </v-file-input>
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <v-btn
                                            v-if="urlFeaturedGif"
                                            class="no-underline mt-5"
                                            :href="urlFeaturedGif"
                                            target="_blank"
                                            color="info"
                                            size="small"
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

                        <div class="d-md-flex justify-content-md-end gap-md-3">
                            <div class="card flex-basis-0 flex-grow-1">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        Main Category
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <v-select
                                        v-model="selectedMainCategory"
                                        :items="mainCategories"
                                        item-value="id"
                                        item-text="name"
                                        label="Main Category"
                                        @change="handleMainCategoryChange"
                                    ></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div
                                class="card-header d-flex flex-row w-100 justify-content-between"
                            >
                                <h5 class="card-title mb-0">Sub Categories</h5>
                            </div>

                            <div v-if="isProcessing" class="loading-indicator">
                                Loading...
                            </div>

                            <div v-else>
                                <div
                                    v-for="(
                                        chunk, chunkIndex
                                    ) in subCategoriesChunks"
                                    :key="chunkIndex"
                                >
                                    <div
                                        class="d-md-flex flex-row justify-content-md-end gap-md-3"
                                    >
                                        <div
                                            v-for="subCategory in chunk"
                                            :key="subCategory.id"
                                            class="flex-basis-0 flex-grow-1"
                                        >
                                            <v-checkbox
                                                v-model="selectedSubCategories"
                                                :label="subCategory.name"
                                                :value="subCategory.name"
                                            ></v-checkbox>
                                        </div>
                                    </div>
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
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
    export default {
        props: {
            post: {
                type: Object,
                required: false,
                default() {
                    return {};
                },
            },
            cats: {
                type: Object,
                required: false,
                default() {
                    return {};
                },
            },
        },
        data() {
            return {
                editor: ClassicEditor,
                editorData: "",
                errors: {},
                alert: {},
                valid: false,
                processing: false,
                record: this.post || {},
                featuredImg: [],
                urlFeaturedImg: null,
                featuredGif: [],
                urlFeaturedGif: null,
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: null,

                // for category selector dropdown
                selectedMainCategory: "",
                selectedSubCategories: [""],
                mainCategories: [],
                subCategories: [],
            };
        },
        computed: {
            isProcessing() {
                return this.processing;
            },
            isPublished() {
                return this.record.published_at !== null;
            },
            subCategoriesApiUrl() {
                return `/api/categories/${this.selectedMainCategory}/children`;
            },
            subCategoriesChunks() {
                if (!Array.isArray(this.subCategories)) {
                    return [];
                }

                const chunkSize = 4;
                return this.subCategories.reduce((resultArray, item, index) => {
                    const chunkIndex = Math.floor(index / chunkSize);

                    if (!resultArray[chunkIndex]) {
                        resultArray[chunkIndex] = [];
                    }

                    resultArray[chunkIndex].push(item);

                    return resultArray;
                }, []);
            },
        },
        watch: {
            subCategoriesApiUrl(newUrl) {
                this.fetchSubCategories(newUrl);
            },
        },
        created() {
            this.mainCategories = ["All", ...this.cats];

            this.subCategories = this.getSubCategories();

            this.selectedMainCategory = this.record.category.find(
                (category) => category.parent_id === null
            ).name;

            this.selectedSubCategories = this.record.category
                .filter((category) => category.parent_id !== null)
                .map((category) => category.name);

            this.getFeaturedImage();
            this.getFeaturedGif();

            this.editorData = this.record.body;
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

            handleMainCategoryChange() {
                this.fetchSubCategories(this.subCategoriesApiUrl);
            },

            async fetchSubCategories(url) {
                this.processing = true;

                try {
                    const response = await axios.get(url);
                    this.subCategories = response.data;
                } catch (error) {
                    console.error("Failed to fetch subcategories:", error);
                } finally {
                    this.processing = false;
                }
            },

            async getSubCategories() {
                try {
                    const response = await axios.get("/api/categories/sub");
                    return response.data;
                } catch (error) {
                    console.error("Failed to fetch subcategories:", error);
                    return [];
                }
            },

            // TODO clear subcategories that don't belong to selectedMainCategory when submitting
            async update() {
                this.processing = true;
                // reset validations
                this.errors = {};
                this.alert = {};

                // check form
                if (await this.validate()) {
                    // build payload
                    this.payload = await this.getPayload();

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
                let combinedCategories = [
                    this.selectedMainCategory,
                    ...this.selectedSubCategories,
                ];

                // limit payload fields
                const payload = {
                    id: this.record.id,
                    title: this.record.title,
                    slug: this.record.slug,
                    active: this.record.active ? 1 : 0,
                    featured: this.record.featured ? 1 : 0,
                    excerpt: this.record.excerpt,
                    body: this.editorData,
                };

                // set image_featured to clear so the backend will clear the media on the model
                if (!this.urlFeaturedImg && this.featuredImg.length === 0) {
                    payload.image_featured = "clear";
                }

                // new image
                if (!this.urlFeaturedImg && this.featuredImg.length !== 0) {
                    payload.image_featured = this.featuredImg;
                }

                // set gif_featured to clear so the backend will clear the media on the model
                if (!this.urlFeaturedGif && this.featuredGif.length === 0) {
                    payload.gif_featured = "clear";
                }

                // new gif
                if (!this.urlFeaturedGif && this.featuredGif.length !== 0) {
                    payload.gif_featured = this.featuredGif;
                }

                let formData = new FormData();

                // populate formData
                for (let key in payload) {
                    // append image_featured
                    if (key === "image_featured" && payload[key]) {
                        if (payload[key] !== "clear") {
                            formData.append(key, payload[key][0]);
                        } else {
                            formData.append(key, payload[key]);
                        }
                    }
                    // append gif_featured
                    else if (key === "gif_featured" && payload[key]) {
                        if (payload[key] !== "clear") {
                            formData.append(key, payload[key][0]);
                        } else {
                            formData.append(key, payload[key]);
                        }
                    } else {
                        // append other properties
                        formData.append(key, payload[key]);
                    }
                }

                // append array of category names to formData
                for (let i = 0; i < combinedCategories.length; i++) {
                    formData.append("categories[]", combinedCategories[i]);
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
            },

            updateFeaturedGif(event) {
                this.urlFeaturedGif = null;
                this.featuredGif = Array.from(event.target.files);
            },
            clearGifInput() {
                this.urlFeaturedGif = null;
                this.featuredGif = [];
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
                        let urlObj = new URL(urlFeaturedImg);
                        this.urlFeaturedImg =
                            urlObj.pathname +
                            (urlObj.search || "") +
                            (urlObj.hash || "");

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

            getFeaturedGif() {
                this.processing = true;

                return axios
                    .get(`/api/featured-gif/${this.record.id}`)
                    .then((response) => {
                        const featuredGif = [response.data.featuredGif];
                        // set Laravel Media image name to match normal js file object name
                        for (let i = 0; i < featuredGif.length; i++) {
                            if (featuredGif[i].file_name) {
                                featuredGif[i].name = featuredGif[i].file_name;
                            }
                        }
                        this.featuredGif = featuredGif;

                        let urlFeaturedGif = response.data.urlFeaturedGif;
                        let urlObj = new URL(urlFeaturedGif);
                        this.urlFeaturedGif =
                            urlObj.pathname +
                            (urlObj.search || "") +
                            (urlObj.hash || "");

                        this.urlFeaturedGif = urlFeaturedGif;

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
        grid-area: thr;
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
