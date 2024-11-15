<script setup>
import { ref } from 'vue';
import Layout from '../Layout.vue';

const test = ref('haha')
</script>

<template>
    <Layout>
        <h2>User Home {{ test }}</h2>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, aspernatur voluptas hic ut ipsum commodi, pariatur fugit, impedit ab corrupti a expedita ullam quo at optio molestiae repellat veniam nemo.
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis commodi, necessitatibus laudantium corrupti quod aspernatur sunt. Minus adipisci aliquam enim. Quis quidem possimus ipsum quod itaque eum assumenda esse dicta!
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto perspiciatis odio veniam dolores ab ipsam cupiditate sed nostrum laborum suscipit eos a ex distinctio ullam ipsum, veritatis iure unde beatae.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti excepturi dolore voluptate ducimus commodi, praesentium neque reprehenderit tenetur veniam voluptates aliquid provident ullam ipsam nemo at sunt odit dolorum temporibus.
    </Layout>
</template>

<style scoped>
h2 {
    color: blue;
}
</style>