<script setup>
import Layout from '../Layout.vue';
import Profile from '../Profile.vue';
import { router } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast()

const deleteUser = async (id) => {
    try {
        router.delete(`/admin/users/${id}`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}

defineProps(['user'])
</script>

<template>
    <Layout>
        <Profile :user="user">
            <el-button type="danger" @click="deleteUser(user.id)"  plain>Delete</el-button>
        </Profile>
    </Layout>
</template>

<style scoped>
.el-avatar {
    background-color: mediumseagreen;
}
</style>