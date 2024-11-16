<script setup>
import Layout from '../Layout.vue';
import Profile from '../Profile.vue';
import { usePage } from '@inertiajs/vue3';
import { toRaw } from 'vue';

const { total_pending_leaves, message } = defineProps(['total_pending_leaves', 'message'])

const page = usePage()
let user = toRaw(page.props.auth.user)
user["total_pending_leaves"] = total_pending_leaves
</script>

<template>
    <Layout>
        <Profile :user="user">
            <el-button type="success" tag="a" href="/profile/edit">Edit Profile</el-button>
            <el-button type="warning" tag="a" href="/password/reset" plain>Reset Password</el-button>
        </Profile>
    </Layout>
</template>