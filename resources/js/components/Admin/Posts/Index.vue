<template>
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Posts</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Always responsive</h5>
                        <h6 class="card-subtitle text-muted">Across every breakpoint, use <code>.table-responsive</code> for horizontally scrolling
                            tables.</h6>
                    </div>
                    <div id="datatables-buttons_wrapper" class="table-responsive table-hover">
                        <table class="table mb-0 dt-bootstrap5 no-footer">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Publish Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr v-for="(post, index) in posts.data" :key="index">
                                    <th scope="row">{{ post.id }}</th>
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.slug }}</td>
                                    <td>{{ post.active }}</td>
                                    <td>{{ post.featured }}</td>
                                    <td>{{ post.published_at }}</td>
                                    <td class="table-action">
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'index',
        data () {
            return {
                posts: {
                    type: Object,
                    default: null
                }
            }
        },
        mounted () {
            this.list()
    },
        methods: {
            async list (page = 1) {
                await axios.get(`/api/admin/posts?page=${page}`).then(({ data }) => {
                    this.posts = data
                }).catch(({ response }) => {
                    console.error(response)
                })
            }
        }
    }
</script>

<style>
    .sr-only {
        position:absolute;
        left:-10000px;
        top:auto;
        width:1px;
        height:1px;
        overflow:hidden;
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
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
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
