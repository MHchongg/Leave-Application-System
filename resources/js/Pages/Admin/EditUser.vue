<script setup>
import Layout from '../Layout.vue';
import { useToast } from 'vue-toastification';
import { useForm } from '@inertiajs/vue3';

const { user } = defineProps(['user'])
const toast = useToast()

// do not use same name with ref
const form = useForm({
    name: user.name,
    gender: user.gender,
    contactNo: user.contactNo,
    department: user.department,
})

const resetForm = () => {
    form.name = ''
    form.gender = 'male'
    form.contactNo = ''
    form.department = ''
}

const onSubmit = async () => {
    try {
        await form.put(`/api/admin/users/${user.id}`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}
</script>

<template>
    <Layout>
        <el-card class="flex flex-col">
            <template #header>Edit user</template>

            <el-form :model="form" label-width="auto" label-position="left" class="w-full">
                <el-form-item label="Name" required>
                    <el-input v-model="form.name" />
                    <el-alert v-if="form.errors.name" :title="form.errors.name" type="error" :closable="false" />
                </el-form-item>

                <el-form-item label="Contact Number" required>
                    <el-input v-model="form.contactNo" />
                     <el-alert v-if="form.errors.contactNo" :title="form.errors.contactNo" type="error" :closable="false" />
                </el-form-item>

                <el-form-item label="Gender" required>
                    <el-radio-group v-model="form.gender">
                        <el-radio value="male">Male</el-radio>
                        <el-radio value="female">Female</el-radio>
                    </el-radio-group>
                    <el-alert v-if="form.errors.gender" :title="form.errors.gender" type="error" :closable="false" />
                </el-form-item>

                <el-form-item label="Department" required>
                    <el-select v-model="form.department" placeholder="please select user's department">
                        <el-option label="IT" value="IT" />
                        <el-option label="Marketing" value="Marketing" />
                        <el-option label="Accounting" value="Accounting" />
                        <el-option label="Sales" value="Sales" />
                        <el-option label="HR" value="HR" />
                        <el-option label="Administration" value="Administration" />
                        <el-option label="Customer Service" value="Customer Service" />
                    </el-select>
                    <el-alert v-if="form.errors.department" :title="form.errors.department" type="error" :closable="false" />
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Update</el-button>
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