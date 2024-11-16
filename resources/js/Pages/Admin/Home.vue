<script setup>
import Layout from '../Layout.vue';
import { Link } from '@inertiajs/vue3';

const filterStatus = (value, row) => {
  return row.status === value
}

const filterType = (value, row) => {
  return row.type === value
}  

defineProps(['leaves'])
</script>

<template>
    <Layout>
        <el-container direction="vertical" class="gap-y-4 items-center">
            <h1 class="text-center text-3xl">All Leaves</h1>

            <el-table :data="leaves.data" class="w-full mb-6">
                <el-table-column label="Applicant" width="180">
                    <template #default="scope">
                        <el-tooltip
                            class="box-item"
                            effect="dark"
                            :content="scope.row.user.email"
                            placement="top-start"
                        >
                            <el-button link tag="a" :href="`/admin/users/${scope.row.user.id}/show`">{{ scope.row.user.name }}</el-button>
                        </el-tooltip>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="tag"
                    label="Type"
                    width="100"
                    :filters="[
                        { text: 'Sick Leave', value: 'Sick Leave' },
                        { text: 'Annual Leave', value: 'Annual Leave' },
                        { text: 'Unpaid Leave', value: 'Unpaid Leave' },
                        { text: 'Maternity Leave', value: 'Maternity Leave' },
                        { text: 'Bereavement Leave', value: 'Bereavement Leave' },
                        { text: 'Others', value: 'Others' },
                    ]"
                    :filter-method="filterType"
                    filter-placement="bottom-end"
                    >
                    <template #default="scope">
                        <div>{{ scope.row.type }}</div>
                    </template>
                </el-table-column>
                <el-table-column prop="date" label="Applied Date" sortable width="180">
                    <template #default="scope">
                        <div>{{ scope.row.created_at.split("T")[0] }}</div>
                    </template>
                </el-table-column>
                <el-table-column prop="date" label="Leave Date" sortable width="180">
                    <template #default="scope">
                        <div>{{ scope.row.date }}</div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="tag"
                    label="Status"
                    width="100"
                    :filters="[
                        { text: 'Pending', value: 'Pending' },
                        { text: 'Approved', value: 'Approved' },
                        { text: 'Rejected', value: 'Rejected' },
                    ]"
                    :filter-method="filterStatus"
                    filter-placement="bottom-end"
                    >
                    <template #default="scope">
                        <el-tag v-if="scope.row.status === 'Pending'" type="warning">{{ scope.row.status }}</el-tag>
                        <el-tag v-else-if="scope.row.status === 'Approved'" type="success">{{ scope.row.status }}</el-tag>
                        <el-tag v-else="scope.row.status === 'Rejected'" type="danger">{{ scope.row.status }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="Operations">
                    <template #default="scope">
                        <el-button size="small" type="primary" tag="a" :href="`/leave/${scope.row.id}/show`" round>
                            View
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>

            <div class="flex space-x-1">
              <div v-for="link in leaves.links">
                <Link v-if="link.url && link.active" :href="link.url" v-html="link.label" class="rounded-md border py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 border-slate-800 text-white bg-slate-800" />
                <Link v-else-if="link.url" :href="link.url" v-html="link.label" class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800" />
                <span v-else v-html="link.label" class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all text-slate-600 pointer-events-none opacity-50 shadow-none ml-2" ></span>
              </div>
            </div>
        </el-container>
    </Layout>
</template>