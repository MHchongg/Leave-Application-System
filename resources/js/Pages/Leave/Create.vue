<script setup>
import Layout from '../Layout.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import dayjs from 'dayjs';

const toast = useToast()

const tomorrow = dayjs().add(1, 'day').format('YYYY-MM-DD')

const form = useForm({
    type: 'Sick Leave',
    date: tomorrow,
    reason: null
})

const disabledDate = (time) => {
  return time.getTime() < dayjs()
}

const resetForm = () => {
    form.date = tomorrow
    form.type = 'Sick Leave',
    form.reason = null
}

const onSubmit = async () => {
    try {
        form.date = dayjs(form.date).format('YYYY-MM-DD')
        await form.post('/api/leave/store')
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}
</script>

<template>
    <Layout>
        <el-card class="flex flex-col">
            <template #header>New Leave</template>

            <el-form :model="form" label-width="auto" label-position="left" class="w-full">
                <el-form-item label="Leave Type" required>
                    <el-select v-model="form.type" placeholder="please leave type">
                        <el-option label="Sick Leave" value="Sick Leave" />
                        <el-option label="Annual Leave" value="Annual Leave" />
                        <el-option label="Unpaid Leave" value="Unpaid Leave" />
                        <el-option label="Maternity Leave" value="Maternity Leave" />
                        <el-option label="Bereavement Leave" value="Bereavement Leave" />
                        <el-option label="Others" value="Others" />
                    </el-select>
                    <el-alert v-if="form.errors.type" :title="form.errors.type" type="error" :closable="false" />
                </el-form-item>

                <el-form-item label="Leave Date" required>
                    <el-date-picker
                        v-model="form.date"
                        type="date"
                        placeholder="Pick a day"
                        :disabled-date="disabledDate"
                    />
                    <el-alert v-if="form.errors.date" :title="form.errors.date" type="error" :closable="false" />
                </el-form-item>

                <el-form-item v-show="form.type === 'Others'" label="Reason" required>
                    <el-input
                        v-model="form.reason"
                        :autosize="{ minRows: 2, maxRows: 4 }"
                        type="textarea"
                        placeholder="Please input your reason"
                    />
                    <el-alert v-if="form.errors.reason" :title="form.errors.reason" type="error" :closable="false" />
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Apply</el-button>
                    <el-button @click="resetForm">Clear</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </Layout>
</template>

<style scoped>
.el-alert {
    margin-top: 8px;
}
</style>