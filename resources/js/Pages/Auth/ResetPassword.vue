<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import { reactive } from 'vue';
import Layout from '../Layout.vue';

const page = usePage()
const user = reactive(page.props.auth.user)
const toast = useToast()

const form = useForm({
    password: '',
    password_confirmation: ''
})

const resetForm = () => {
    form.password = ''
    form.password_confirmation = ''
}

const onSubmit = async () => {
    try {
        await form.patch(`/api/password/reset/${user.id}`)
    } catch (error) {
        console.error(error)
        toast.error(error.message)
    }
}
</script>

<template>
    <Layout>
         <div class="flex flex-col justify-center items-center gap-y-20">
            <h1 class="text-3xl">Reset Password</h1>
            <el-card class="w-7/12">
                <template #header>Reset Password</template>
                <el-form :model="form" label-width="auto" label-position="top">
                    <el-form-item label="Password">
                        <el-input v-model="form.password" type="password" autocomplete="off" show-password />
                        <el-alert v-if="form.errors.password" :title="form.errors.password" type="error" :closable="false" />
                    </el-form-item>
                    <el-form-item label="Confirm Password">
                        <el-input v-model="form.password_confirmation" type="password" autocomplete="off" show-password />
                        <el-alert v-if="form.errors.password_confirmation" :title="form.errors.password_confirmation" type="error" :closable="false" />
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">Reset</el-button>
                        <el-button @click="resetForm">Clear</el-button>
                    </el-form-item>
                </el-form>
            </el-card>
        </div>
    </Layout>
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