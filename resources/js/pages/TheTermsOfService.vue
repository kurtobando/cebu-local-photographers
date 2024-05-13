<template>
    <Meta title="Terms of Service" />
    <PageLayoutPublic>
        <section class="mx-auto flex w-full flex-col gap-2 p-8 py-20 text-sm lg:w-1/2">
            <h1>Terms of Service</h1>

            <p>
                By accessing and using {{ app.name }} website, services, or products (the "Service"), you agree to
                comply with and be bound by the following terms and conditions of use. Please read these Terms of
                Service carefully before accessing or using the Service.
            </p>

            <h2>Use of the Service</h2>

            <p>
                You must be at least 18 years old or have the legal authority to enter into these Terms of Service to
                use the Service. You agree to use the Service only for lawful purposes and in accordance with these
                terms and conditions.
            </p>

            <h2>User Accounts</h2>

            <p>
                Some features of the Service may require you to create an account. You are responsible for maintaining
                the confidentiality of your account and password and for restricting access to your account. You agree
                to accept responsibility for all activities that occur under your account or password.
            </p>

            <h2>Intellectual Property</h2>

            <p>
                All content included on the Service, such as text, graphics, logos, button icons, images, audio clips,
                digital downloads, data compilations, and software, is the property of {{ app.name }} or its content
                suppliers and is protected by copyright laws.
            </p>

            <h2>Limitation of Liability</h2>

            <p>
                {{ app.name }} shall not be liable for any direct, indirect, incidental, special, or consequential
                damages resulting from the use or inability to use the Service or for any content posted on the Service
                by you or by {{ app.name }}.
            </p>

            <h2>Changes to Terms of Service</h2>

            <p>
                {{ app.name }} reserves the right to modify or replace these Terms of Service at any time. Any changes
                will be effective immediately upon posting the updated terms on the Service. Your continued use of the
                Service after any such changes constitutes your acceptance of the new terms.
            </p>

            <h2>Contact Us</h2>

            <p>
                If you have any questions about these Terms of Service, please contact us at
                <a
                    class="underline"
                    href="mailto:{{ app.email.support }}">
                    {{ app.email.support }}
                </a>
            </p>
        </section>
    </PageLayoutPublic>
</template>

<script setup lang="ts">
import useApp from '@/composables/useApp';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';

const app = useApp();
</script>

<style scoped>
h1,
h2 {
    @apply mt-4 font-bold;
}
h1 {
    @apply text-2xl;
}
h2 {
    @apply text-xl;
}
ul,
ol {
    list-style: disc;
    margin-left: 1rem;
}
p {
    @apply leading-relaxed;
}
</style>
