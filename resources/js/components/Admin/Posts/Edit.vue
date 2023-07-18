<template>
    <h1 class="h3 mb-3">Posts / Detail</h1>

    <div class="my-grid">
        <div class="area-one">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Title</h5>
                        </div>
                        <div class="card-body">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Input"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Slug</h5>
                        </div>
                        <div class="card-body">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Input"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="area-two">
            <div class="d-flex justify-content-end gap-3">
                <div class="card flex-basis-0 flex-grow-1">
                    <div class="card-body">
                        <v-switch
                            v-model="active"
                            color="success"
                            label="Active"
                        ></v-switch>
                    </div>
                </div>

                <div class="card flex-basis-0 flex-grow-1">
                    <div class="card-body">
                        <v-switch
                            v-model="featured"
                            color="primary"
                            label="Featured"
                        ></v-switch>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                record: this.post || {},
                active: true,
                featured: false,
            };
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
            "... ... ... two"
            "one one one one";
        grid-template-columns: repeat(3, 1fr) 2fr;
        grid-row-gap: 0.5rem;
        grid-column-gap: 1rem;
    }

    .area-one {
        grid-area: one;
    }
    .area-two {
        grid-area: two;
    }

    @media (max-width: 768px) {
        .my-grid {
            grid-template-areas:
                "one one one one one one one one"
                "... ... ... ... ... ... two two";
        }
    }
</style>
