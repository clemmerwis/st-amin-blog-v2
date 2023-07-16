<template>
    <h1 class="h3 mb-3">Posts / List</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <easy-data-table
                        class="data-table"
                        :headers="headers"
                        :items="posts || []"
                        :sort-by="options.sortBy"
                        :sort-type="options.sortType"
                        :rows-per-page="options.rowsPerPage"
                        :search-value="search.terms"
                        :loading="busy"
                        alternating
                        @click-row="rowClick"
                    >
                        <template #item-published_at="item">
                            {{ convertedTime(item.published_at) }}
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
                        text: "Slug",
                        value: "slug",
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
                        text: "Published At",
                        value: "published_at",
                        sortable: true,
                    },
                ],

                search: {
                    terms: "",
                },
                busy: true,
            };
        },

        created() {
            this.busy = false;
        },

        methods: {
            rowClick(record) {
                window.open(`/admin/posts/${record.id}/edit`);
            },
            convertedTime(time) {
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
                const convertedTime = `${convertedHour}:${minute
                    .toString()
                    .padStart(2, "0")}${period}`;

                // Combine the formatted date and converted time with separator
                return `${datePart} @ ${convertedTime}`;
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
