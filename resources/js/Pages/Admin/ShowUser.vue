<script setup>
import Layout from '../Layout.vue';
import { UserFilled, Male, Female, Message, Phone, OfficeBuilding, List } from '@element-plus/icons-vue'
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
        <div class="flex justify-center">
            <el-card class="w-5/6">
                <template #header>
                    <div class="card-header">
                        <el-avatar>{{ user.name }}</el-avatar>
                        <span class="ml-3">{{ user.name }}</span>
                    </div>
                </template>
                <div class="space-y-5">
                    <p>
                        <el-icon><UserFilled /></el-icon>
                        Name: {{ user.name }}
                    </p>
                    
                    <p>
                        <el-icon v-if="user.gender === 'male'"><Male /></el-icon>
                        <el-icon v-else><Female /></el-icon>
                        Gender: {{ user.gender }}
                    </p>
                    
                    <p>
                        <el-icon><Message /></el-icon>
                        Email: <a :href="`mailto:${user.email}`" class="text-blue-400 underline">{{ user.email }}</a>
                    </p>
                    
                    <p>
                        <el-icon><Phone /></el-icon>
                        Contact Number: <a :href="`tel:+6${user.contactNo}`" class="text-blue-400 underline">{{ user.contactNo }}</a>
                    </p>
                    
                    <p>
                        <el-icon><OfficeBuilding /></el-icon>
                        Department: {{ user.department }}
                    </p>

                    <p>
                        <el-icon><List /></el-icon>
                        Total Pending Leaves: 5
                    </p>
                </div>

                <template #footer>
                    <el-button type="success" tag="a" :href="`/admin/users/${user.id}/edit`">Edit</el-button>
                    <el-button type="danger" @click="deleteUser(user.id)"  plain>Delete</el-button>
                </template>
            </el-card>
        </div>
    </Layout>
</template>

<style scoped>
.el-avatar {
    background-color: mediumseagreen;
}
</style>