<template>
    <LayoutTheFold>
        <Meta title="Events" />
        <template v-slot:header>
            <h1 class="text-center text-4xl font-bold leading-relaxed">Upcoming Events</h1>
        </template>
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <CardEvent
                v-for="event in events"
                :key="event.id"
                :date="event.date"
                :location="event.location"
                :time="event.time"
                :title="event.title" />
        </div>
    </LayoutTheFold>
</template>

<script lang="ts" setup>
import CardEvent from '@/Components/CardEvent/CardEvent.vue';
import Meta from '@/Components/Meta/Meta.vue';
import LayoutTheFold from '@/Layouts/LayoutTheFold.vue';
import PageLayoutPublic from '@/Layouts/PageLayoutPublic.vue';

const events = [
    {
        date: 'May 28, Sunday',
        id: 1,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
    {
        date: 'May 28, Sunday',
        id: 2,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
    {
        date: 'May 28, Sunday',
        id: 3,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
    {
        date: 'May 28, Sunday',
        id: 4,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
    {
        date: 'May 28, Sunday',
        id: 5,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
    {
        date: 'May 28, Sunday',
        id: 6,
        location: 'Family Park, Talamban',
        time: '10AM - 4PM',
        title: 'Artificial Light Portrait Photography',
    },
];
defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
