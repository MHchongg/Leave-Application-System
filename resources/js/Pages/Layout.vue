<script setup>
import { ArrowDownBold } from '@element-plus/icons-vue'
import { Link } from "@inertiajs/vue3"
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()
const user = computed(() => page.props.auth.user)
</script>

<template>
  <el-container class="layout-container flex flex-col min-h-screen">
    <el-container>
      <el-header class="text-right text-xs flex justify-between items-center">
        <h1 class="font-bold text-xl">Leave Application System</h1>
        <div class="w-12">
          <el-dropdown class="w-full">
            <div class="flex justify-between items-center w-full">
              <span>{{ user.name }}</span>
              <el-icon><ArrowDownBold /></el-icon>
            </div>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item>
                  <el-link href="/">
                    Home
                  </el-link>
                </el-dropdown-item>
                <el-dropdown-item>
                  <el-link href="/profile" v-if="user.role === 'user'">
                    Profile
                  </el-link>
                </el-dropdown-item>
                <el-dropdown-item>
                  <Link href="/api/logout" method="post" as="button" type="button">Log Out</Link>
                </el-dropdown-item>
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </div>
      </el-header>

      <el-main class="bg-slate-200 flex-grow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <slot />
        </div>
      </el-main>

      <el-footer class="mt-auto font-bold flex items-center justify-center">
        Developed by Chong MH
      </el-footer>
    </el-container>
  </el-container>
</template>

<style scoped>
.layout-container .el-header {
  position: relative;
  background-color: white;
}

.layout-container .el-menu {
  border-right: none;
}

.layout-container .el-footer {
  background-color: white;
}
</style>