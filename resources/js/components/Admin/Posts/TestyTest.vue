<template>
    <easy-data-table
        class="data-table"
        :headers="headers"
        :items="tableData || []"
        :sort-by="options.sortBy"
        :sort-type="options.sortType"
        :rows-per-page="options.rowsPerPage"
        :search-value="search.terms"
        :loading="busy"
        alternating
        @click-row="rowClick"
    ></easy-data-table>
</template>

<script>
    import EasyDataTable from "vue3-easy-data-table";

    export default {
        components: {
            EasyDataTable,
        },
        props: {
            tableData: {
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
                        text: "Name",
                        value: "name",
                        sortable: true,
                    },
                ],

                search: {
                    terms: "",
                },

                records: this.tableData?.records || [],
                busy: true,
            };
        },

        created() {
            this.busy = false;
        },

        computed: {
            records() {
                return this.data?.records || [];
            },
        },

        methods: {
            rowClick(record) {
                window.open(`/team_up/challenge/${record.id}`);
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
</style>
