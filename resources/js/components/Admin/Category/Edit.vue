<template>
    <h1 class="h3 mb-3">Category / Detail</h1>

    <my-alert :setup="alert" @clear="() => (alert = {})"></my-alert>

    <v-toolbar color="light" class="mb-5">
        <v-spacer></v-spacer>
        <v-btn color="info" :loading="isProcessing" @click="update">
            <v-icon icon="mdi-plus" color="white"></v-icon>
            Update
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        props: {
            category: {
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
                record: this.category || {},
                rules: {
                    required: (value) => !!value || "Required",
                },
                payload: null,
            };
        },
    };
</script>
