<script setup>
import Layout from '../Layout.vue';
import { router, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import { computed } from 'vue';

const page = usePage()
const user = computed(() => page.props.auth.user)

const toast = useToast()

const deleteLeave = async (id) => {
    try {
        await router.delete(`/api/leave/${id}`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}

const approveLeave = async (id) => {
    try {
        await router.patch(`/api/leave/${id}/approve`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}

const rejectLeave = async (id) => {
    try {
        await router.patch(`/api/leave/${id}/reject`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}

defineProps(['leave'])
</script>

<template>
    <Layout>
        <div class="flex justify-center">
            <el-card class="w-5/6">
                <template #header>
                    <div class="card-header">
                        <span class="ml-3">Leave</span>
                    </div>
                </template>
                <div class="space-y-5">
                    <p>
                        Applicant: <a :href="`mailto:${leave.applicant}`" class="text-blue-400 underline">{{ leave.applicant }}</a>
                    </p>

                    <p>
                        Leave Type: {{ leave.type }}
                    </p>

                    <p>
                        Leave Date: {{ leave.date }}
                    </p>

                    <p>
                        Applied Date: {{ leave.created_at.split("T")[0] }}
                    </p>

                    <div v-if="leave.reason">
                        <p>Reason:</p>
                        <el-input 
                            v-model="leave.reason"
                            :rows="2"
                            type="textarea"
                            disabled
                        />
                    </div>

                    <p>
                        Status:
                        <el-tag v-if="leave.status === 'Pending'" type="warning">{{ leave.status }}</el-tag>
                        <el-tag v-else-if="leave.status === 'Approved'" type="success">{{ leave.status }}</el-tag>
                        <el-tag v-else="leave.status === 'Rejected'" type="danger">{{ leave.status }}</el-tag>
                    </p>
                </div>

                <template #footer>
                    <el-button v-show="leave.can_delete" v-if="leave.status !== 'Approved'" type="danger" @click="deleteLeave(leave.id)" plain>Delete</el-button>
                
                    <el-button v-if="user.role === 'admin' && leave.status === 'Pending'" type="success" @click="approveLeave(leave.id)">Approve</el-button>
                    <el-button v-if="user.role === 'admin' && leave.status === 'Pending'" type="danger" @click="rejectLeave(leave.id)" plain>Reject</el-button>
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