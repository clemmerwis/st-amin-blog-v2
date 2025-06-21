<template>
    <h1 class="h3 mb-3">Posts / List</h1>

    <div class="row">
        <div class="col-auto mt-2">
            <v-btn
                class="no-underline"
                color="info"
                target="_blank"
                :loading="busy"
                :href="`/admin/posts/create`"
            >
                Create Post
            </v-btn>
        </div>
        <div class="col-md-6 ml-auto">
            <v-toolbar
                style="background-color: hsla(0deg, 0%, 100%, 0.5)"
                class="px-2 mb-3"
            >
                <v-select
                    v-model="selectedCategory"
                    :items="allCategories"
                    item-value="name"
                    item-text="name"
                    label="Filter by Category"
                    @change="onCategoryChange"
                ></v-select>
            </v-toolbar>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <easy-data-table
                        class="data-table"
                        :headers="headers"
                        :items="filteredPosts || []"
                        :sort-by="options.sortBy"
                        :sort-type="options.sortType"
                        :rows-per-page="options.rowsPerPage"
                        :search-value="search.terms"
                        :loading="busy"
                        alternating
                        @click-row="rowClick"
                    >
                        <template #item-updated_at="item">
                            {{ convertedTime(item.updated_at) }}
                        </template>
                    </easy-data-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EasyDataTable from "vue3-easy-data-table";

    export default {
        components: {
            EasyDataTable,
        },
        props: {
            posts: {
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
                options: {
                    page: 1,
                    pageCount: 0,
                    rowsPerPage: 15,
                    sortBy: "",
                    sortType: "desc",
                },

                headers: [
                    {
                        text: "ID",
                        value: "id",
                        sortable: true,
                    },
                    {
                        text: "Title",
                        value: "title",
                        sortable: true,
                    },
                    {
                        text: "Category",
                        value: "category",
                        sortable: true,
                    },
                    {
                        text: "Active",
                        value: "active",
                        sortable: true,
                    },
                    {
                        text: "Featured",
                        value: "featured",
                        sortable: true,
                    },
                    {
                        text: "Published",
                        value: "published_at",
                        sortable: true,
                    },
                    {
                        text: "Updated At",
                        value: "updated_at",
                        sortable: true,
                    },
                ],

                // for category selector dropdown
                selectedCategory: "All", // initially no category is selected
                allCategories: null,

                search: {
                    terms: "",
                },
                busy: true,
            };
        },

        computed: {
            filteredPosts() {
                if (this.selectedCategory && this.selectedCategory !== "All") {
                    const filtered = this.posts.filter((post) => {
                        const matches = post.category === this.selectedCategory;
                        return matches;
                    });

                    return filtered;
                } else {
                    return this.posts;
                }
            },
        },

        created() {
            this.allCategories = ["All", ...this.cats];
            this.busy = false;
        },

        methods: {
            rowClick(record) {
                window.open(`/admin/posts/${record.id}/edit`);
            },
            convertedTime(time) {
                if (!time) {
                    return "N/A";
                }

                // Split the date and time
                const dateTimeParts = time.split(" ");
                const datePart = dateTimeParts[0];
                const militaryTime = dateTimeParts[1];

                // Convert the military time to normal time format
                const timeParts = militaryTime.split(":");
                const hour = parseInt(timeParts[0]);
                const minute = parseInt(timeParts[1]);

                const period = hour >= 12 ? "PM" : "AM";
                const convertedHour = hour % 12 === 0 ? 12 : hour % 12;

                // Combine the formatted date and converted time with separator
                return `${datePart} ${convertedHour}:${minute
                    .toString()
                    .padStart(2, "0")} ${period}`;
            },
        },
    };
</script>

<style>
    .sr-only {
        position: absolute;
        left: -10000px;
        top: auto;
        width: 1px;
        height: 1px;
        overflow: hidden;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding-left: 0;
    }

    div.dataTables_paginate {
        margin: 0;
        text-align: right;
        white-space: nowrap;
    }

    div.dataTables_paginate ul.pagination {
        justify-content: flex-end;
        margin: 2px 0;
        white-space: nowrap;
    }

    .page-link {
        padding: 0.3rem 0.75rem;
    }

    .page-link {
        background-color: #fff;
        border: 1px solid #dee2e6;
        color: #6c757d;
        display: block;
        position: relative;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
            border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .page-item.disabled .page-link {
        background-color: #fff;
        border-color: #dee2e6;
        color: #6c757d;
        pointer-events: none;
    }

    .page-item:first-child .page-link {
        border-bottom-left-radius: 0.2rem;
        border-top-left-radius: 0.2rem;
    }

    .page-item.active .page-link {
        background-color: #3b7ddd;
        border-color: #3b7ddd;
        z-index: 3;
        color: white;
    }

    .page-item:not(:first-child) .page-link {
        margin-left: -1px;
    }

    tbody tr:nth-child(odd) {
        --bs-table-accent-bg: var(--bs-table-striped-bg);
    }

    tbody tr {
        cursor: pointer;
    }
</style>