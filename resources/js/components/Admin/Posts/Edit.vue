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
                                <v-text-field
                                    v-model="record.image_path"
                                    clearable
                                ></v-text-field>
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
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: {},
            };
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
            update() {
                this.processing = true;
                // reset validations
                this.errors = {};
                this.alert = {};

                this.payload = this.record;

                // check form
                if (this.validate()) {
                    let formData = new FormData();

                    // shorten
                    let files = this.payload.image_path;

                    // populate formData
                    for (let key in this.payload) {
                        // append files (set to skip for now)
                        if (key === "image_path" && false) {
                            if (files !== null || !files.length < 1) {
                                // each image needs a unique key
                                for (let i = 0; i < files.length; i++) {
                                    formData.append(
                                        "featured_image_attachments[]",
                                        files[i],
                                        files[i].name
                                    );
                                }
                            }
                        } else {
                            // append form properties
                            formData.append(key, this.payload[key]);
                        }
                    }

                    for (const entry of formData.entries()) {
                        const [key, value] = entry;
                        console.log(`Key: ${key}, Value: ${value}`);
                    }

                    // submit form
                    return axios
                        .put(`/api/admin/posts/${this.payload.id}`, formData, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then(() => {
                            this.processing = false;

                            // alert user
                            this.alert = {
                                message: "Challenge created successfully",
                            };

                            // this.reset();
                            // this.resetValidation();

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
