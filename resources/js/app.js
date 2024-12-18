import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import Toast, { POSITION } from "vue-toastification"
import 'vue-toastification/dist/index.css'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ElementPlus)
            .use(Toast, {
                position: POSITION.TOP_CENTER,
                timeout: 3500,
                newestOnTop: true,
            })
            .mount(el)
    },
})