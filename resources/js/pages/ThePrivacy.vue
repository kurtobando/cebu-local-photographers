<template>
    <Meta title="Privacy" />
    <PageLayoutPublic>
        <section class="mx-auto flex w-full flex-col gap-2 p-8 py-20 text-sm lg:w-1/2">
            <h1>Privacy Policy</h1>

            <p>
                This Privacy Policy describes how {{ app.name }} ("we", "us", or "our") collects, uses, and shares
                information when you use our website {{ app.url }} (the "Service").
            </p>

            <h2>Information We Collect</h2>

            <p>
                We may collect personal information that you provide directly to us when you use our Service. This may
                include:
            </p>
            <ul>
                <li>Name</li>
                <li>Email address</li>
            </ul>

            <p>We may also collect certain information automatically when you visit our website, including:</p>
            <ul>
                <li>Your IP address</li>
                <li>Your browser type</li>
                <li>Your operating system</li>
                <li>Information about your usage of the Service</li>
            </ul>

            <h2>How We Use Your Information</h2>

            <p>We may use the information we collect for various purposes, including to:</p>
            <ul>
                <li>Provide, maintain, and improve our Service</li>
                <li>Communicate with you about our products, services, and promotions</li>
                <li>Respond to your inquiries and provide customer support</li>
                <li>Detect, prevent, and address technical issues</li>
            </ul>

            <h2>Sharing Your Information</h2>

            <p>
                We may share your personal information with third parties who provide services on our behalf or with
                whom we have partnered to offer a particular product or service. We may also share your information in
                the following circumstances:
            </p>
            <ul>
                <li>In response to a subpoena or similar investigative demand</li>
                <li>To protect our rights, property, or safety, or the rights, property, or safety of others</li>
                <li>With your consent or at your direction</li>
            </ul>

            <h2>Data Security</h2>

            <p>
                We take reasonable measures to help protect your personal information from loss, theft, misuse, and
                unauthorized access, disclosure, alteration, and destruction.
            </p>

            <h2>Changes to This Privacy Policy</h2>

            <p>
                We may update this Privacy Policy from time to time. If we make material changes, we will notify you by
                posting the updated policy on this page.
            </p>

            <h2>Contact Us</h2>

            <p>
                If you have any questions about this Privacy Policy, please contact us at
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
