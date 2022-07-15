<template>
    <div class="container"></div>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            email: "",
            name: "",
            message: "",
            success: false,
        };
    },

    methods: {
        sendContactRequest() {
            axios
                .post("/api/leads", {
                    email: this.email,
                    name: this.name,
                    message: this.message,
                })
                .then((resp) => {
                    console.log(resp);
                });
        },
    },
};
</script>

<style></style>
