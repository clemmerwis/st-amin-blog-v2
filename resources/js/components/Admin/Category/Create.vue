<template>
    <h1 class="h3 mb-3">Category / Create</h1>

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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Name</h5>
                    </div>
                    <div class="card-body">
                        <v-text-field
                            v-model="record.name"
                            name="name"
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
            <!-- Button to Add Parent ID Field -->
            <div v-if="record.parent_id === null">
                <v-btn color="info" size="small" @click="addParentId">
                    Convert this Main category into a Sub Category
                </v-btn>
            </div>
            <!-- Button to Remove Parent ID Field -->
            <div v-if="record.parent_id !== null" class="col-md-6">
                <v-btn color="info" size="small" @click="removeParentId">
                    Convert this Sub Category into a Main Category
                </v-btn>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Parent Category</h5>
                    </div>
                    <div v-if="mainCategories.length > 0" class="card-body">
                        <v-select
                            v-model="selectedCategory"
                            :items="mainCategoriesComputed"
                            label="Select a Category"
                        ></v-select>
                    </div>
                </div>
            </div>
        </div>
    </v-form>
</template>

<script>
    export default {
        data() {
            return {
                errors: {},
                alert: {},
                valid: false,
                processing: false,
                record: {
                    name: "",
                    slug: "",
                },
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: null,

                // for parent category selector dropdown
                selectedCategory: null,
                mainCategories: [],
            };
        },
        computed: {
            isProcessing() {
                return this.processing;
            },
            mainCategoriesComputed() {
                return this.mainCategories.map((cat) => cat.name);
            },
        },
        created() {
            this.mainCategories = this.getMainCategories();
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

            addParentId() {
                this.record.parent_id = "";
            },
            removeParentId() {
                this.record.parent_id = null;
            },
            // TODO clear subcategories that don't belong to selectedMainCategory when submitting
            async create() {
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
                        .post(`/api/admin/categories`, this.payload, {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then((response) => {
                            this.processing = false;

                            // alert user
                            this.alert = {
                                message: "Category created successfully",
                            };

                            // Redirect to the edit page
                            const newCategoryId = response.data.id;
                            window.location.href = `/admin/categories/${newCategoryId}/edit`;
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

            convertSelectedCategoryNameToId(categoryName) {
                if (this.record.parent_id !== null) {
                    const foundCategory = this.mainCategories.find(
                        (cat) => cat.name === categoryName
                    );
                    return foundCategory.id;
                } else {
                    return null;
                }
            },

            async getPayload() {
                // limit payload fields
                const payload = {
                    name: this.record.name,
                    slug: this.record.slug,
                    parent_id: this.convertSelectedCategoryNameToId(
                        this.selectedCategory
                    ),
                };

                let formData = new FormData();

                // populate formData
                for (let key in payload) {
                    formData.append(key, payload[key]);
                }

                return formData;
            },

            async getMainCategories() {
                let self = this;
                await axios
                    .get("/api/categories/main")
                    .then((response) => {
                        self.mainCategories = response.data.map((cat) => ({
                            id: cat.id,
                            name: cat.name,
                        }));

                        const foundCategory = this.mainCategories.find(
                            (cat) => cat.id === this.category.parent_id
                        );
                        this.selectedCategory = foundCategory.name;
                    })
                    .catch((error) => {
                        console.error("Error fetching main categories:", error);
                    });
            },
        },
    };
</script>