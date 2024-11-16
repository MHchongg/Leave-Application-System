<script setup>
import Layout from '../Layout.vue';
import { Link } from '@inertiajs/vue3';

defineProps(['users'])
</script>

<template>
    <Layout>
        <el-container direction="vertical" class="gap-y-1.5 items-center">
            <h1 class="text-center text-3xl">All users</h1>

            <Link href="/admin/users/create" as="button" type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 self-end">Add user</Link>

            <el-table :data="users.data" class="w-full mb-6">
                <el-table-column label="Name" width="180">
                    <template #default="scope">
                        <div>{{ scope.row.name }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Email" width="180">
                    <template #default="scope">
                        <div>{{ scope.row.email }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Department" width="180">
                    <template #default="scope">
                        <div>{{ scope.row.department }}</div>
                    </template>
                </el-table-column>
                <el-table-column label="Operations">
                    <template #default="scope">
                        <el-button size="small" type="primary" tag="a" :href="`/admin/users/${scope.row.id}/show`" round>
                            View
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>

            <div class="flex space-x-1">
              <div v-for="link in users.links">
                <Link v-if="link.url && link.active" :href="link.url" v-html="link.label" class="rounded-md border py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 border-slate-800 text-white bg-slate-800" />
                <Link v-else-if="link.url" :href="link.url" v-html="link.label" class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800" />
                <span v-else v-html="link.label" class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all text-slate-600 pointer-events-none opacity-50 shadow-none ml-2" ></span>
              </div>
            </div>
        </el-container>
    </Layout>
</template>