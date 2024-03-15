<template>
    <h6 v-if="isPublished" class="small">(published)</h6>
    <h1 class="h3 mb-3">Posts / Detail: {{ record.title }}</h1>

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
        <v-expansion-panels v-model="panel" :class="['mb-8', getSeoWidth]">
            <v-expansion-panel>
                <v-expansion-panel-title> SEO Meta </v-expansion-panel-title>
                <v-expansion-panel-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="record.detail.seo_meta.title"
                                    label="SEO Title"
                                    clearable
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="record.detail.seo_meta.description"
                                    label="SEO Description"
                                    clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="record.detail.seo_meta.keywords"
                                    label="SEO Keywords"
                                    clearable
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="record.detail.seo_meta.author"
                                    label="SEO Author"
                                    clearable
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-expansion-panel-text>
            </v-expansion-panel>
        </v-expansion-panels>

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
                                    @input="handleShortcode"
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
                            <div class="card flex-basis-0 flex-grow-1">
                                <div class="card-body">
                                    <v-text-field
                                        v-model="publishDate"
                                        name="published Date"
                                        type="date"
                                        label="Published Date"
                                        clearable
                                        cursor
                                    ></v-text-field>
                                </div>
                            </div>

                            <div class="card flex-basis-0 flex-grow-1">
                                <div class="card-body">
                                    <v-select
                                        v-model="publishHour"
                                        :items="hours"
                                        label="Published Hour"
                                        name="published_hour"
                                    ></v-select>
                                </div>
                            </div>
                        </div>

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
                publishHour: null,
                publishDate: null,
                hours: [
                    "12am",
                    "1am",
                    "2am",
                    "3am",
                    "4am",
                    "5am",
                    "6am",
                    "7am",
                    "8am",
                    "9am",
                    "10am",
                    "11am",
                    "12pm",
                    "1pm",
                    "2pm",
                    "3pm",
                    "4pm",
                    "5pm",
                    "6pm",
                    "7pm",
                    "8pm",
                    "9pm",
                    "10pm",
                    "11pm",
                ],
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
                panel: [],

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
            getSeoWidth() {
                // if panel is set to 0, then make add the css class w-50, else be nothing
                let width = this.panel === 0 ? "w-100" : "w-25";
                console.log(width);
                return width;
            },
            panelClasses() {
                // Always apply 'mb-8' and conditionally apply 'w-50' based on the panel state
                return {
                    "mb-8": true,
                    "w-50": !this.panel.includes(0),
                };
            },
        },
        watch: {
            subCategoriesApiUrl(newUrl) {
                this.fetchSubCategories(newUrl);
            },
        },
        created() {
            this.publishDate = this.convertToDatePickerFormat(
                this.record.published_at
            );

            this.publishHour = this.convertToHourFormat(this.record.published_at);

            this.mainCategories = ["All", ...this.cats];

            this.subCategories = this.getSubCategories();

            this.selectedMainCategory = this.record.categories.find(
                (category) => category.parent_id === null
            ).name;

            this.selectedSubCategories = this.record.categories
                .filter((category) => category.parent_id !== null)
                .map((category) => category.name);

            this.getFeaturedImage();
            this.getFeaturedGif();

            this.editorData = this.record.body;
        },
        methods: {
            convertToHourFormat(dateTimeStr) {
                // Split the date string to get the time part
                const timePart = dateTimeStr.split(" ")[1];
                if (!timePart) return "";

                // Extract the hour part from the time
                let hour = parseInt(timePart.split(":")[0], 10);
                const isPM = hour >= 12;

                // Convert to 12-hour format and add AM/PM
                hour = hour % 12;
                hour = hour === 0 ? 12 : hour; // Convert 0 to 12 for 12AM

                return `${hour}${isPM ? "pm" : "am"}`;
            },
            convertToDatePickerFormat(dateTimeStr) {
                // Parse the date string and create a Date object
                const months = {
                    Jan: "01",
                    Feb: "02",
                    Mar: "03",
                    Apr: "04",
                    May: "05",
                    Jun: "06",
                    Jul: "07",
                    Aug: "08",
                    Sep: "09",
                    Oct: "10",
                    Nov: "11",
                    Dec: "12",
                };
                const parts = dateTimeStr.split(/-| |:/);
                const year = parts[2];
                const month = months[parts[0]];
                const day = parts[1].padStart(2, "0");

                // Construct the date in YYYY-MM-DD format
                const formattedDate = `${year}-${month}-${day}`;

                return formattedDate;
            },

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

            handleShortcode(event) {
                let content = event.editor.getData();

                const shortcodeReplacements = {
                    "[blockquote]": '<blockquote class="dt-quote">',
                    "[/blockquote]": "</blockquote>",
                };

                // Replace shortcodes with HTML tags
                Object.keys(shortcodeReplacements).forEach((shortcode) => {
                    const html = shortcodeReplacements[shortcode];
                    content = content.split(shortcode).join(html);
                });

                event.editor.setData(content);
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

            convertTo24Hour(hour12) {
                if (!hour12) return "";

                const [hour, period] = hour12.match(/\d+|\D+/g);
                let hour24 = parseInt(hour, 10);

                if (period.toLowerCase() === "pm" && hour24 < 12) {
                    hour24 += 12;
                } else if (period.toLowerCase() === "am" && hour24 === 12) {
                    hour24 = 0;
                }

                // Return the hour in "HH:MM:SS" format
                return `${hour24.toString().padStart(2, "0")}:00:00`;
            },

            formatDateForCarbon(dateString) {
                // Trim the string to a standard datetime format (YYYY-MM-DD HH:MM:SS)
                const trimmedDateString = dateString
                    .split(":")
                    .slice(0, 3)
                    .join(":");

                const date = new Date(trimmedDateString);

                // Check for invalid dates
                if (isNaN(date.getTime())) {
                    return null; // or return an appropriate fallback
                }

                const year = date.getFullYear();
                const month = (date.getMonth() + 1).toString().padStart(2, "0"); // Months are zero-indexed
                const day = date.getDate().toString().padStart(2, "0");
                const hours = date.getHours().toString().padStart(2, "0");
                const minutes = date.getMinutes().toString().padStart(2, "0");
                const seconds = date.getSeconds().toString().padStart(2, "0");

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
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

                // Convert 12-hour format to 24-hour format
                const hour24 = this.convertTo24Hour(this.publishHour);

                // Combine publishDate and publishHour
                const publishedAt =
                    this.publishDate && hour24
                        ? `${this.publishDate} ${hour24}`
                        : null;

                // Extract SEO meta data
                const seoMeta = this.record.detail.seo_meta || {};

                // limit payload fields
                const payload = {
                    id: this.record.id,
                    title: this.record.title,
                    slug: this.record.slug,
                    active: this.record.active ? 1 : 0,
                    featured: this.record.featured ? 1 : 0,
                    excerpt: this.record.excerpt,
                    body: this.editorData,
                    published_at: publishedAt,
                    // seo
                    seo_title: seoMeta.title || "",
                    seo_description: seoMeta.description || "",
                    seo_keywords: seoMeta.keywords || "",
                    seo_author: seoMeta.author || "",
                };

                this.formatDateForCarbon(payload.published_at);

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
    .v-expansion-panels {
        transition: width 0.3s ease-in-out;
    }
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
