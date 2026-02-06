<template>
    <h1 class="h3 mb-3">Posts / Create</h1>

    <my-alert :setup="alert" @clear="() => (alert = {})"></my-alert>

    <v-toolbar color="light" class="mb-5">
        <v-spacer></v-spacer>
        <v-btn color="success" :loading="isProcessing" @click="create">
            <v-icon icon="mdi-plus" color="white"></v-icon>
            Create
        </v-btn>
    </v-toolbar>

    <v-form
        ref="form"
        v-model="valid"
        :disabled="isProcessing"
        @submit.prevent="create"
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
    import { useFeaturedMedia } from "@/composables/useFeaturedMedia";
    import { useCategories } from "@/composables/useCategories";

    export default {
        props: {
            cats: {
                type: Object,
                required: false,
                default() {
                    return {};
                },
            },
        },
        setup(props) {
            // Use composables
            const media = useFeaturedMedia();
            const categories = useCategories(props.cats);

            // Initialize subcategories
            categories.loadAllSubCategories();

            return {
                // Media composable
                ...media,
                // Categories composable
                ...categories,
            };
        },
        data() {
            return {
                editor: ClassicEditor,
                editorData: "",
                errors: {},
                alert: {},
                valid: false,
                processing: false,
                record: {
                    title: "",
                    slug: "",
                    body: "",
                    excerpt: "",
                    active: true,
                    featured: false,
                    category: [],
                },
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: null,
            };
        },
        computed: {
            isProcessing() {
                return this.processing || this.categoriesLoading;
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

            async create() {
                this.processing = true;
                this.errors = {};
                this.alert = {};

                if (await this.validate()) {
                    this.payload = await this.getPayload();

                    return axios
                        .post(`/api/admin/posts`, this.payload, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then((response) => {
                            this.processing = false;
                            this.alert = { message: "Post created successfully" };
                            const newPostId = response.data.id;
                            window.location.href = `/admin/posts/${newPostId}/edit`;
                        })
                        .catch(({ response }) => {
                            if (response) {
                                this.processing = false;
                                this.errors = response.data?.errors;
                                this.alert = {
                                    title: "Validation Errors",
                                    ...response?.data,
                                };
                            }
                        });
                } else {
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
                const combinedCategories = this.getCombinedCategories();

                const payload = {
                    title: this.record.title,
                    slug: this.record.slug,
                    active: this.record.active ? 1 : 0,
                    featured: this.record.featured ? 1 : 0,
                    excerpt: this.record.excerpt,
                    body: this.editorData,
                };

                // Apply media fields from composable
                this.applyMediaToPayload(payload);

                let formData = new FormData();

                // Populate formData with non-media fields
                for (let key in payload) {
                    if (key !== "image_featured" && key !== "gif_featured") {
                        formData.append(key, payload[key]);
                    }
                }

                // Append media using composable helper
                this.appendMediaToFormData(formData, payload);

                // Append categories
                for (let i = 0; i < combinedCategories.length; i++) {
                    formData.append("categories[]", combinedCategories[i]);
                }

                return formData;
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
