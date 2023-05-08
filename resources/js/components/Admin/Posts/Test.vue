<template>
    <p>Testing</p>
</template>
 
<script>
export default {
    data() {
        return {
            loading: true,

            // ia data table
            posts: [],
            serverOptions: {
                page: 1,
                rowsPerPage: 10,
                sortBy: '',
                sortType: 'desc',
            },
            serverItemsLength: 0,
            rowsPerPageOptions: {
                rowItems: [10,25,50,100],
            },
            headers: [
                    {
                        text: 'Id',
                        value: 'id',
                        sortable: true
                    },
                    {
                        text: 'Title',
                        value: 'title',
                        sortable: true
                    },
                    {
                        text: 'Slug',
                        value: 'slug',
                        sortable: true
                    },
                    {
                        text: 'Active',
                        value: 'active',
                        sortable: true
                    },
                    {
                        text: 'Featured',
                        value: 'featured',
                        sortable: true
                    },
                    {
                        text: 'Published At',
                        value: 'published_at',
                        sortable: true
                    },
                ],
        }
    },
    created() {
        this.loadFromServer();
    },
    methods: {
        async loadFromServer(page) {
            this.loading = true
            // Defaults to page one after search
            if (page) {
                this.serverOptions.page = page;
            }
            let query = `page=${this.serverOptions.page}`;
            query = query + `&limit=${this.serverOptions.rowsPerPage}`

            let self = this;
            await axios.get(`/api/admin/posts?${query}`).then(({ data }) => {
                self.posts = data
            }).catch(({ response }) => {
                console.error(response)
            })
        }
    }
}
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
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
 