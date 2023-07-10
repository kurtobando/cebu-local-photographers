<template>
    <LayoutTheFold>
        <Meta title="Events" />
        <template v-slot:header>
            <h1 class="text-4xl font-bold text-center leading-relaxed">Upcoming Events</h1>
        </template>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
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
import PageLayoutPublic from '@/Layouts/PageLayoutPublic.vue';
import LayoutTheFold from '@/Layouts/LayoutTheFold.vue';
import Meta from '@/Components/Meta/Meta.vue';
import CardEvent from '@/Components/CardEvent/CardEvent.vue';

const events = [
    {
        id: 1,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
    {
        id: 2,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
    {
        id: 3,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
    {
        id: 4,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
    {
        id: 5,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
    {
        id: 6,
        title: 'Artificial Light Portrait Photography',
        date: 'May 28, Sunday',
        time: '10AM - 4PM',
        location: 'Family Park, Talamban',
    },
];
defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
