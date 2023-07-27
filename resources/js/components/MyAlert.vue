<template>
    <section v-if="show" class="mb-3">
        <v-alert
            variant="tonal"
            density="compact"
            :color="color"
            border="start"
            :border-color="color"
            :title="title"
            :icon="icon"
            :text="text"
            @clear="close"
        >
            <template #close>
                <v-btn @click="close">X</v-btn>
            </template>
        </v-alert>
    </section>
</template>

<script>
    export default {
        props: {
            setup: {
                type: Object,
                default() {
                    return {};
                },
            },
        },

        emits: ["clear"],

        data() {
            return {
                show: false,
                title: "Error",
                text: "",
                color: "danger",
                icon: "mdi-alert",
            };
        },

        created() {
            this.show = !!(this.setup?.title || this.setup?.message);
        },

        updated() {
            this.show = !!this.setup?.message;
            this.text = this.setup?.message;

            // (re)set
            if (!this.setup.errors) {
                this.title = this.setup?.title || "Success";
                this.color = "success";
                this.icon = "mdi-check-circle";
            } else {
                this.title = this.setup?.title || "Error";
                this.color = "danger";
                this.icon = "mdi-alert";
            }
        },

        methods: {
            close() {
                this.$emit("clear", true);
            },
        },
    };
</script>
