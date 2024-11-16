<script setup>
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast()

const form = useForm({
  email: '',
  password: '',
})

const resetForm = () => {
    form.email = ''
    form.password = ''
}

const onSubmit = async () => {
    try {
        await form.post('/api/login')
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}
</script>

<template>
    <div class="w-full min-h-screen flex flex-col justify-center items-center gap-y-20 bg-slate-200">
        <h1 class="text-3xl">Leave Application System</h1>
        <el-card class="w-7/12">
            <template #header>Login</template>
            <el-form :model="form" label-width="auto" label-position="top">
                <el-form-item label="Email">
                    <el-input v-model="form.email" type="email" />
                    <el-alert v-if="form.errors.email" :title="form.errors.email" type="error" :closable="false" />
                </el-form-item>
                <el-form-item label="Password">
                    <el-input v-model="form.password" type="password" autocomplete="off" show-password />
                    <el-alert v-if="form.errors.password" :title="form.errors.password" type="error" :closable="false" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Login</el-button>
                    <el-button @click="resetForm">Clear</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<style scoped>
.el-alert {
  margin-top: 8px;
}

@media screen and (max-width:800px) {
    .el-card {
      width: 95%;
    }
}
</style>